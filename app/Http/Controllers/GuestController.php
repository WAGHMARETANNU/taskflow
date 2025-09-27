<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;
use function redirect;
use App\Models\Registrations;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreatedMail;
use App\Models\PasswordToken;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;




class GuestController extends Controller
{
    
    public function home()
{
    // Clear any existing sessions when visiting home
    session()->forget(['user', 'admin', 'username']);
    return view('index');
}
public function contact_submit(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
    ], [
        'name.required' => 'Name is required',
        'email.required' => 'Email is required',
        'email.email' => 'Please enter a valid email address',
        'subject.required' => 'Subject is required',
        'message.required' => 'Message is required',
    ]);

    try {
        //Store the contact message in database (if you created the table)
        DB::table('contact_messages')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        //For now, just show success message
        session()->flash('success', 'Thank you for your message! It has been received successfully.');
        
    } catch (\Exception $e) {
        session()->flash('error', 'Something went wrong. Please try again later.');
    }
    
    return redirect()->route('contactus');
}

    public function login()
    {
        // session()->remove('user');
        return view('login');
    }
    public function register()
    {
        return view('register');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
    public function forgot_password()
    {
        return view('forgot_password');
    }
    
public function send_otp(Request $request)
{
    // Validate email
    $rules = [
        'email' => 'required|email|exists:registration,email'
    ];
    
    $messages = [
        'email.required' => 'Email is required',
        'email.email' => 'Please enter a valid email address',
        'email.exists' => 'Email is not registered with us'
    ];
    
    $validator = Validator::make($request->all(), $rules, $messages);
    
    if ($validator->fails()) {
        return redirect()->route('forgotPwd')->withErrors($validator)->withInput();
    }
    
    // Generate 6-digit OTP
    $resetToken = rand(100000, 999999);
    
    // Get user details for email
    $user = Registrations::where('email', $request->email)->first();
    
    // Store email and OTP in session for verification
    session()->put('reset_email', $request->email);
    session()->put('reset_token', $resetToken);
    session()->put('otp_generated_at', now());
    
    // Send OTP via email using your Gmail SMTP configuration
    try {
        $data = [
            'name' => $user->fname,
            'otp' => $resetToken
        ];
        
        Mail::send('emails.otp_reset', $data, function($message) use ($request, $user) {
            $message->to($request->email, $user->fname);
            $message->subject('Password Reset OTP - To Do List App');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        
        session()->flash('otp_info', 'OTP has been sent to your email address.');
        
    } catch (Exception $e) {
        // Fallback - show OTP for college project demonstration
        session()->flash('otp_info', "Email service temporarily unavailable. Your OTP is: {$resetToken}");
    }
    
    // Redirect to OTP form page
    return redirect()->route('OTPForm');
}


public function otp_form()
{
    // Check if email and OTP are in session
    if (!session()->has('reset_email') || !session()->has('reset_token')) {
        session()->flash('error', 'Session expired. Please start the password reset process again.');
        return redirect()->route('forgotPwd');
    }
    
    return view('otp_form');
}
public function testEmail()
{
    try {
        Mail::raw('Test email from To Do List App', function($message) {
            $message->to('test@example.com');
            $message->subject('Test Email');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        
        return "Email sent successfully!";
    } catch (Exception $e) {
        return "Email failed: " . $e->getMessage();
    }
}

public function verify_otp(Request $request)
{
    // Validate OTP input
    $rules = [
        'otp' => 'required|digits:6'
    ];
    
    $messages = [
        'otp.required' => 'Please enter the OTP',
        'otp.digits' => 'OTP must be exactly 6 digits'
    ];
    
    $validator = Validator::make($request->all(), $rules, $messages);
    
    if ($validator->fails()) {
        return redirect()->route('OTPForm')->withErrors($validator)->withInput();
    }
    
    // Get stored values from session
    $email = session('reset_email');
    $storedOTP = session('reset_token');
    $otpGeneratedAt = session('otp_generated_at');
    
    if (!$email || !$storedOTP) {
        session()->flash('error', 'Session expired. Please start the password reset process again.');
        return redirect()->route('forgotPwd');
    }
    
    // Check if OTP is expired (10 minutes validity)
    if ($otpGeneratedAt && now()->diffInMinutes($otpGeneratedAt) > 10) {
        session()->flash('error', 'OTP has expired. Please request a new one.');
        return redirect()->route('forgotPwd');
    }
    
    // Verify OTP
    if ($request->otp != $storedOTP) {
        session()->flash('error', 'Invalid OTP. Please try again.');
        return redirect()->route('OTPForm');
    }
    
    // OTP is correct - clear OTP session data and set verified flag
    session()->forget(['reset_token', 'otp_generated_at']);
    session()->put('otp_verified', true);
    
    session()->flash('success', 'OTP verified successfully! Please set your new password.');
    return redirect()->route('ResetPassword');
}

    public function logout()
{
    session()->flush(); // Clear all session data
    return redirect()->route('index');
}
    public function register_action(Request $request)
{
    // Check if trying to register with protected admin email
    if ($this->isProtectedAdminEmail($request->email)) {
        session()->flash('error', 'This email address is not available for registration.');
        return redirect()->route('signup')->withInput();
    }

    $rules = [
        'fname' => 'required',
        'email' => 'required|email|unique:registration,email',
        'password' => [
            'required',
            'min:8',
            'max:25',
            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[#?!@$%^&*-]).{8,25}$/'
        ],
        'confirm_password' => 'required|same:password',
        'gender' => 'required',
        'mobile' => 'required|regex:/^[0-9]{10}+$/',
        'profile_picture' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        'edu' => 'required',
    ];
    
    $messages = [
        'fname.required' => 'Full Name is required',
        'email.required' => 'Email is required',
        'email.email' => 'Email must be a valid email address',
        'email.unique' => 'Email is already registered',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 8 characters', // Fixed minimum to 8
        'password.max' => 'Password must be less than 25 characters',
        'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character',
        'confirm_password.required' => 'Confirm Password is required',
        'confirm_password.same' => 'Password and Confirm Password must match',
        'gender.required' => 'Gender is required',
        'mobile.required' => 'Mobile Number is required',
        'mobile.regex' => 'Mobile Number must be a valid 10 digit number',
        'profile_picture.required' => 'Profile Picture is required',
        'profile_picture.mimes' => 'Profile Picture must be a file of type: jpeg, png, jpg, gif',
        'profile_picture.max' => 'Profile Picture must be less than 2MB',
        'edu.required' => 'Educational Qualification is required',
    ];
    
    $validatedData = $request->validate($rules, $messages);
    
    try {
        // Create directories if they don't exist
        $uploadPath = public_path('images/profile_pictures');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $register = new Registrations();
        $register->fname = $request->fname;
        $register->email = $request->email;
        $register->password = $request->password; // Consider hashing this in production
        $register->mobile = $request->mobile;
        $register->gender = $request->gender;
        
        // Handle education array properly
        $edu = $request->input('edu');
        if (is_array($edu)) {
            $register->edu = implode(',', $edu);
        } else {
            $register->edu = $edu;
        }
        
        // Handle profile picture upload with better naming
        $profile_pic = uniqid() . '_' . time() . '.' . $request->profile_picture->getClientOriginalExtension();
        $register->profile_picture = $profile_pic;
        $register->token = uniqid() . time();
        
        // SECURITY: Force all new registrations to be 'User' role only
        $register->role = 'User';
        $register->status = 'Active';
        
        // Save to database first
        if ($register->save()) {
            // Only move file after successful database save
            $request->profile_picture->move($uploadPath, $profile_pic);
            
            session()->flash('success', 'Registration Successful! You can now login with your credentials.');
            return redirect()->route('signin');
        } else {
            session()->flash('error', 'Registration Failed. Please try again.');
            return redirect()->route('signup')->withInput();
        }
        
    } catch (Exception $e) {
        session()->flash('error', 'Registration Failed: ' . $e->getMessage());
        return redirect()->route('signup')->withInput();
    }
}

// Add this protected method to your GuestController class
protected function isProtectedAdminEmail($email)
{
    $protectedEmails = [
        'tannuwaghmare15@gmail.com',  // Your admin email
        // Add more protected admin emails here if needed
    ];
    
    return in_array(strtolower($email), array_map('strtolower', $protectedEmails));
}

    public function verifyAccount($email, $token)
    {
        $register = Registrations::where('email', $email)->where('token', $token)->first();
        if ($register) {
            $register->status = 'Active';
            $register->token = '';
            if ($register->save()) {
                session()->flash('success', 'Account Verified Successfully');
                return redirect()->route('signin');
            } else {
                session()->flash('error', 'Account Verification Failed');
                return redirect()->route('signup');
            }
        } else {
            session()->flash('error', 'Invalid Verification Request');
            return redirect()->route('signup');
        }
    }

    public function loginAuth(Request $request)
{
    // Add debugging
    \Log::info('Login attempt for email: ' . $request->email);
    
    $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];
    
    $messages = [
        'email.required' => 'Email is required',
        'email.email' => 'Email must be a valid email address',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',
    ];
    
    $validator = Validator::make($request->all(), $rules, $messages);
    
    if ($validator->fails()) {
        \Log::info('Login validation failed', $validator->errors()->toArray());
        return redirect()->route('signin')->withErrors($validator)->withInput();
    }
    
    try {
        // Check if user exists
        $register = Registrations::where('email', $request->email)->first();
        
        if (!$register) {
            \Log::info('User not found for email: ' . $request->email);
            session()->flash('error', 'Invalid Email or Password');
            return redirect()->route('signin');
        }
        
        \Log::info('User found: ' . $register->email . ', Status: ' . $register->status);
        
        // Check password (assuming plain text - you should hash passwords in production)
        if ($register->password !== $request->password) {
            \Log::info('Password mismatch for email: ' . $request->email);
            session()->flash('error', 'Invalid Email or Password');
            return redirect()->route('signin');
        }
        
        // Check if account is active
        if ($register->status === 'Inactive') {
            \Log::info('Inactive account for email: ' . $request->email);
            session()->flash('error', 'Account is not verified. Please check your email.');
            return redirect()->route('signin');
        }
        
        // Login successful - set session based on role
        if ($register->role === 'Admin') {
            session()->put('admin', $register->email);
            session()->flash('success', 'Admin login successful');
            \Log::info('Admin login successful: ' . $register->email);
            return redirect()->route('adminDashboard');
        } else {
            session()->put('user', $register->email);
            session()->put('username', $register->fname);
            session()->flash('success', 'Login successful');
            \Log::info('User login successful: ' . $register->email);
            return redirect()->route('userDashboard');
        }
        
    } catch (Exception $e) {
        \Log::error('Login error: ' . $e->getMessage());
        session()->flash('error', 'Login failed. Please try again.');
        return redirect()->route('signin');
    }
}

public function new_password()
{
    // Check if OTP was verified
    if (!session()->has('reset_email') || !session()->has('otp_verified')) {
        session()->flash('error', 'Unauthorized access. Please verify OTP first.');
        return redirect()->route('forgotPwd');
    }
    
    return view('reset_password');
}
public function update_new_password(Request $request)
{
    // Check if user is authorized (OTP verified)
    if (!session()->has('reset_email') || !session()->has('otp_verified')) {
        session()->flash('error', 'Unauthorized access. Please start the password reset process again.');
        return redirect()->route('forgotPwd');
    }
    
    // Validate new password
    $rules = [
        'password' => [
            'required',
            'min:8',
            'max:25',
            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[#?!@$%^&*-]).{8,25}$/'
        ],
        'confirm_password' => 'required|same:password',
    ];
    
    $messages = [
        'password.required' => 'New password is required',
        'password.min' => 'Password must be at least 8 characters',
        'password.max' => 'Password must be less than 25 characters',
        'password.regex' => 'Password must contain uppercase, lowercase, number and special character',
        'confirm_password.required' => 'Password confirmation is required',
        'confirm_password.same' => 'Password and confirmation must match',
    ];
    
    $validator = Validator::make($request->all(), $rules, $messages);
    
    if ($validator->fails()) {
        return redirect()->route('ResetPassword')->withErrors($validator)->withInput();
    }
    
    $email = session('reset_email');
    
    try {
        // Update password in database
        $user = Registrations::where('email', $email)->first();
        if ($user) {
            $user->password = $request->password;
            $user->save();
            
            // Clear all session data
            session()->forget(['reset_email', 'otp_verified']);
            
            session()->flash('success', 'Password updated successfully! Please login with your new password.');
            return redirect()->route('signin');
        } else {
            session()->flash('error', 'User not found.');
            return redirect()->route('forgotPwd');
        }
        
    } 
    catch (Exception $e) {
        session()->flash('error', 'Failed to update password. Please try again.');
        return redirect()->route('ResetPassword');
    }
}

    }



