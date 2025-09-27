<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Registrations;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class AdminController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function adminDashboard()
    {
        // Get statistics for dashboard
        $totalUsers = Registrations::where('role', '!=', 'Admin')->count();
        $activeUsers = Registrations::where('role', '!=', 'Admin')->where('status', 'Active')->count();
        $totalTasks = DB::table('tasks')->count();
        $completedTasks = DB::table('tasks')->where('status', 'Completed')->count();
        $pendingTasks = DB::table('tasks')->where('status', 'Pending')->count();
        $totalContactMessages = DB::table('contact_messages')->count();
        $unreadMessages = DB::table('contact_messages')->whereNull('read_at')->count();
        
        return view('admin.admin_dashboard', compact(
            'totalUsers', 'activeUsers', 'totalTasks', 
            'completedTasks', 'pendingTasks', 'totalContactMessages', 'unreadMessages'
        ));
    }
    public function toggleUserStatus(Request $request, $id)
    {
        try {
            $user = Registrations::findOrFail($id);
            
            // Prevent changing admin status
            if ($user->role === 'Admin') {
                session()->flash('error', 'Cannot change admin user status');
                return redirect()->route('admin.users');
            }
            
            $newStatus = $request->status;
            
            // Validate status
            if (!in_array($newStatus, ['Active', 'Inactive'])) {
                session()->flash('error', 'Invalid status provided');
                return redirect()->route('admin.users');
            }
            
            $user->status = $newStatus;
            
            if ($user->save()) {
                $statusText = $newStatus === 'Active' ? 'activated' : 'deactivated';
                session()->flash('success', "User {$user->fname} has been {$statusText} successfully");
            } else {
                session()->flash('error', 'Failed to update user status');
            }
            
        } catch (Exception $e) {
            session()->flash('error', 'User not found or error occurred: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.users');
    }


    public function adminLogout()
    {
        session()->forget('admin');
        session()->flash('success', 'Admin logged out successfully');
        return redirect()->route('signin');
    }

    public function viewUsers()
    {
        $users = Registrations::where('role', '!=', 'Admin')
                              ->orderBy('created_at', 'desc')
                              ->paginate(15);
        
        return view('admin.admin_users', compact('users'));
    }

    public function deleteUser($id)
    {
        try {
            $user = Registrations::findOrFail($id);
            
            // Prevent deletion of admin users
            if ($user->role === 'Admin') {
                session()->flash('error', 'Cannot delete admin users');
                return redirect()->route('admin.users');
            }
            
            // Delete user's profile picture if exists
            if ($user->profile_picture && file_exists(public_path('images/profile_pictures/' . $user->profile_picture))) {
                unlink(public_path('images/profile_pictures/' . $user->profile_picture));
            }
            
            // Delete user's tasks
            DB::table('tasks')->where('user_email', $user->email)->delete();
            
            // Delete user
            $user->delete();
            
            session()->flash('success', 'User deleted successfully');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete user: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.users');
    }

    public function viewTasks()
    {
        $tasks = DB::table('tasks')
                   ->join('registration', 'tasks.registration_id', '=', 'registration.id')
                   ->select('tasks.*', 'registration.fname as user_name', 'registration.email as user_email')
                   ->orderBy('tasks.created_at', 'desc')
                   ->paginate(20);
        
        return view('admin.admin_tasks', compact('tasks'));
    }

    // Contact Messages Methods
    public function viewContactMessages()
    {
        $messages = DB::table('contact_messages')
                      ->orderBy('created_at', 'desc')
                      ->paginate(15);
        
        $totalMessages = DB::table('contact_messages')->count();
        $unreadMessages = DB::table('contact_messages')->whereNull('read_at')->count();
        
        return view('admin.contact-messages', compact('messages', 'totalMessages', 'unreadMessages'));
    }

    public function markMessageAsRead($id)
    {
        try {
            DB::table('contact_messages')
              ->where('id', $id)
              ->update(['read_at' => now()]);
            
            session()->flash('success', 'Message marked as read');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to mark message as read');
        }
        
        return redirect()->route('admin.contactMessages');
    }

    public function deleteMessage($id)
    {
        try {
            $deleted = DB::table('contact_messages')->where('id', $id)->delete();
            
            if($deleted) {
                session()->flash('success', 'Message deleted successfully');
            } else {
                session()->flash('error', 'Message not found');
            }
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete message');
        }
        
        return redirect()->route('admin.contactMessages');
    }
}
