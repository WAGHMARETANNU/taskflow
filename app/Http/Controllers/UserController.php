<?php

namespace App\Http\Controllers;

use App\Models\Registrations;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Exception;

class UserController extends Controller
{
    public function userDashboard()
    {
        $user = session()->get('user');
        $userdata = Registrations::where('email', $user)->first();
        $task_result = Task::where('registration_id', $userdata['id'])->where('status', 'Pending')->get();

        // Ensure task_result is always a collection
        if ($task_result->isEmpty()) {
            $task_result = collect(); // Empty collection instead of string
        }

        return view('user_dashboard', compact('task_result', 'userdata'));
    }

    public function user_logout()
    {
        session()->remove('user');
        return redirect()->route('signin');
    }

    public function user_add_task()
    {
        return view('user_add_task');
    }

    public function user_add_task_action(Request $request)
    {
        $user = session()->get('user');
        $userdata = Registrations::where('email', $user)->first();
        $task = new Task();
        $rules = [
            'task_title' => 'required',
            'task_description' => 'required',
            'task_status' => 'required',
            'task_due_date' => 'required'
        ];
        $messages = [
            'task_title.required' => 'Task Title is required',
            'task_description.required' => 'Task Description is required',
            'task_status.required' => 'Task Status is required',
            'task_due_date.required' => 'Task Due Date is required'
        ];
        $validated = $request->validate($rules, $messages);
        if (!$validated) {
            return redirect()->route('userAddTask')->withErrors($validated)->withInput();
        }
        $task->registration_id = $userdata->id;
        $task->task_name = $request->task_title;
        $task->task_description = $request->task_description;
        $task->status = 'Pending';
        $task->deadline = $request->task_due_date;
        if ($task->save()) {
            session()->flash('success', 'Task Added Successfully');
        } else {
            session()->flash('error', 'Error in adding Task.');
        }
        return redirect()->route('userDashboard');
    }

    public function user_task_list()
    {
        $user = session()->get('user');
        $userdata = Registrations::where('email', $user)->first();
        $task_result = Task::where('registration_id', $userdata->id)->get();
        return view('user_task_list', compact('task_result', 'userdata'));
    }

    public function user_edit_task($id)
    {
        $task = Task::find($id);
        return view('user_edit_task', compact('task'));
    }

    public function user_edit_task_action(Request $request, $id)
    {
        $task = Task::find($id);
        $rules = [
            'task_title' => 'required',
            'task_description' => 'required',
            'task_status' => 'required',
            'task_due_date' => 'required'
        ];
        $messages = [
            'task_title.required' => 'Task Title is required',
            'task_description.required' => 'Task Description is required',
            'task_status.required' => 'Task Status is required',
            'task_due_date.required' => 'Task Due Date is required'
        ];
        $validated = $request->validate($rules, $messages);
        if (!$validated) {
            return redirect()->route('userEditTask', $id)->withErrors($validated)->withInput();
        }
        $task->task_name = $request->task_title;
        $task->task_description = $request->task_description;
        $task->status = $request->task_status;
        $task->deadline = $request->task_due_date;
        if ($task->save()) {
            session()->flash('success', 'Task Updated Successfully');
        } else {
            session()->flash('error', 'Error in updating Task.');
        }
        return redirect()->route('userTaskList');
    }

    public function user_delete_task($id)
    {
        $task = Task::find($id);
        if ($task->delete()) {
            session()->flash('success', 'Task Deleted Successfully');
        } else {
            session()->flash('error', 'Error in deleting Task.');
        }
        return redirect()->route('userTaskList');
    }

    public function user_completed_task()
    {
        $user = session()->get('user');
        $userdata = Registrations::where('email', $user)->first();
        $task_result = Task::where('registration_id', $userdata->id)->where('status', 'Completed')->get();
        return view('user_completed_task', compact('task_result', 'userdata'));
    }

    public function user_mark_completed_task($id)
    {
        $task = Task::find($id);
        $task->status = 'Completed';
        if ($task->save()) {
            session()->flash('success', 'Task Marked as Completed Successfully');
        } else {
            session()->flash('error', 'Error in marking Task as Completed.');
        }
        return redirect()->route('userCompletedTask');
    }

    public function user_mark_pending_task($id)
    {
        $task = Task::find($id);
        $task->status = 'Pending';
        if ($task->save()) {
            session()->flash('success', 'Task Marked as Pending Successfully');
        } else {
            session()->flash('error', 'Error in marking Task as Pending.');
        }
        return redirect()->route('userTaskList');
    }

    public function user_change_password()
    {
        return view('user_change_password');
    }

    public function user_change_password_action(Request $request)
    {
        $user = session()->get('user');
        $userdata = Registrations::where('email', $user)->first();
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,25}$/',
            'confirm_password' => 'required|same:new_password'
        ];
        $messages = [
            'old_password.required' => 'Old Password is required',
            'new_password.required' => 'New Password is required',
            'new_password.min' => 'New Password must be at least 6 characters',
            'confirm_password.required' => 'Confirm Password is required',
            'confirm_password.same' => 'Confirm Password must be same as New Password'
        ];
        $validated = $request->validate($rules, $messages);
        if (!$validated) {
            return redirect()->route('userChangePassword')->withErrors($validated)->withInput();
        }
        if ($userdata->password == $request->old_password) {
            $userdata->password = $request->new_password;
            if ($userdata->save()) {
                session()->flash('success', 'Password Changed Successfully');
            } else {
                session()->flash('error', 'Error in changing Password.');
            }
        } else {
            session()->flash('error', 'Old Password is incorrect');
        }
        return redirect()->route('userChangePassword');
    }

    public function user_profile()
    {
        $user = session()->get('user');
        if (!$user) {
            return redirect()->route('signin');
        }
        
        // Add caching to prevent database queries on every load
        $userdata = \Cache::remember("user_profile_{$user}", 300, function() use ($user) {
            return Registrations::where('email', $user)->first();
        });
        
        if (!$userdata) {
            return redirect()->route('signin')->with('error', 'User not found');
        }
        
        return view('user_profile', compact('userdata'));
    }

    // Edit Profile Methods
    public function user_change_profile()
    {
        $email = session('user');
        if (!$email) {
            return redirect()->route('signin');
        }
        
        $userdata = Registrations::where('email', $email)->first();
        if (!$userdata) {
            session()->flash('error', 'User not found');
            return redirect()->route('signin');
        }
        
        // Convert to array for consistent access in blade template
        $userdata = $userdata->toArray();
        return view('user_edit_profile', compact('userdata'));
    }

    // Updated Profile Action Method (NO LNAME)
    public function user_profile_action(Request $request)
    {
        $userEmail = session('user');
        if (!$userEmail) {
            return redirect()->route('signin');
        }

        // Find the current user
        $user = Registrations::where('email', $userEmail)->first();
        if (!$user) {
            session()->flash('error', 'User not found');
            return redirect()->route('signin');
        }

        // Validate the form data (REMOVED LNAME)
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'gender' => 'required|in:male,female,other',
            'edu' => 'nullable|array',
            'edu.*' => 'string|in:10th,12th,Graduate,Post Graduate,PhD',
            
            // Password fields (optional)
            'current_password' => 'nullable|string|min:6',
            'new_password' => 'nullable|string|min:6|confirmed',
            'new_password_confirmation' => 'nullable|string|min:6',
        ], [
            'fname.required' => 'Full name is required',
            'mobile.required' => 'Mobile number is required',
            'mobile.digits' => 'Mobile number must be exactly 10 digits',
            'gender.required' => 'Please select a gender',
            'gender.in' => 'Please select a valid gender option',
            'new_password.confirmed' => 'Password confirmation does not match',
        ]);

        // Check if password change is requested
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Current password is incorrect'])
                    ->withInput();
            }
            
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
            }
        }

        // Update user data (REMOVED LNAME)
        $user->fname = $validatedData['fname'];
        $user->mobile = $validatedData['mobile'];
        $user->gender = $validatedData['gender'];
        
        // Handle education array
        if ($request->has('edu') && is_array($request->edu)) {
            $user->edu = implode(',', $request->edu);
        } else {
            $user->edu = null;
        }

        // Save changes
        if ($user->save()) {
            // Update session data if name changed
            if (session('username') !== $user->fname) {
                session(['username' => $user->fname]);
            }
            
            // Clear cache
            \Cache::forget("user_profile_" . $userEmail);
            
            session()->flash('success', 'Profile updated successfully!');
            return redirect()->route('userProfile');
        } else {
            session()->flash('error', 'Failed to update profile. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function user_profile_image_action(Request $request)
    {
        $userEmail = session()->get('user');
        $userdata = Registrations::where('email', $userEmail)->first();

        if (!$userdata) {
            return redirect()->route('userProfile')->with('error', 'User not found.');
        }

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'profile_image.required' => 'Profile Image is required',
            'profile_image.image' => 'Profile Image must be an image',
            'profile_image.mimes' => 'Profile Image must be a file of type: jpeg, png, jpg, gif, svg',
            'profile_image.max' => 'Profile Image must be less than 2MB'
        ]);

        // Define the image path
        $imagePath = 'images/profile_pictures/';
        // Delete the old profile image if it exists
        $old_file = $userdata->profile_picture;
        // Upload new image
        $imageName = uniqid() . $request->profile_image->getClientOriginalName();

        // Update database
        $userdata->profile_picture = $imageName;
        if ($userdata->save()) {
            $request->profile_image->move('images/profile_pictures/', $imageName);
            if ($old_file && File::exists($imagePath . $old_file)) {
                File::delete($imagePath . $old_file);
            }

            // Clear cache
            \Cache::forget("user_profile_" . $userEmail);
            
            session()->flash('success', 'Profile Image Updated Successfully');
        } else {
            session()->flash('error', 'Error in updating Profile Image.');
        }

        return redirect()->route('userProfile');
    }
}
