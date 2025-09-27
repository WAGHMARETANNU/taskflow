<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Guest Routes (Public Routes)
Route::get('/', [GuestController::class, 'home'])->name('index');
Route::get('login', [GuestController::class, 'login'])->name('signin');
Route::get('register', [GuestController::class, 'register'])->name('signup');
Route::get('about', [GuestController::class, 'about'])->name('aboutus');
Route::get('contact', [GuestController::class, 'contact'])->name('contactus');
Route::post('contact', [GuestController::class, 'contact_submit'])->name('contactSubmit');
Route::get('forgotPassword', [GuestController::class, 'forgot_password'])->name('forgotPwd');
Route::post('register_action', [GuestController::class, 'register_action']);
Route::get('verifyAccount/{email}/{token}', [GuestController::class, 'verifyAccount'])->name('verifyemail');
Route::post('loginAuth', [GuestController::class, 'loginAuth'])->name('verifyLogin');
Route::get('logout', [GuestController::class, 'logout'])->name('logout');

// Forget Password Routes
Route::get('ForgotPassword', [GuestController::class, 'forgot_password'])->name('ForgotPassword');
Route::post('SendOTP', [GuestController::class, 'send_otp'])->name('SendOTP');
Route::get('OTPForm', [GuestController::class, 'otp_form'])->name('OTPForm');
Route::post('VerifyOTP', [GuestController::class, 'verify_otp'])->name('verify_otp');
Route::get('ResetPassword', [GuestController::class, 'new_password'])->name('ResetPassword');
Route::post('UpdatePassword', [GuestController::class, 'update_new_password'])->name('UpdatePassword');

// User Routes (Protected by user middleware)
Route::middleware(['user'])->group(function () {
    // Dashboard
    Route::get('userDashboard', [UserController::class, 'userDashboard'])->name('userDashboard');
    Route::get('UserLogout', [UserController::class, 'user_logout'])->name('UserLogout');
    
    // Task Management
    Route::get('userAddTask', [UserController::class, 'user_add_task'])->name('userAddTask');
    Route::post('userAddTask', [UserController::class, 'user_add_task_action'])->name('userAddTaskAction');
    Route::get('userTaskList', [UserController::class, 'user_task_list'])->name('userTaskList');
    Route::get('userEditTask/{id}', [UserController::class, 'user_edit_task'])->name('userEditTask');
    Route::post('userUpdateTask/{id}', [UserController::class, 'user_edit_task_action'])->name('userEditTaskAction');
    Route::get('userDeleteTask/{id}', [UserController::class, 'user_delete_task'])->name('userDeleteTask');
    Route::get('userCompletedTask', [UserController::class, 'user_completed_task'])->name('userCompletedTask');
    Route::get('/userMarkAsCompleted/{id}', [UserController::class, 'user_mark_completed_task'])->name('userMarkCompletedTask');
    Route::get('/userMarkAsPending/{id}', [UserController::class, 'user_mark_pending_task'])->name('userMarkPendingTask');
    
    // Profile Management
    Route::get('userProfile', [UserController::class, 'user_profile'])->name('userProfile');
    Route::get('userChangeProfile', [UserController::class, 'user_change_profile'])->name('userChangeProfile');
    Route::post('userProfileAction', [UserController::class, 'user_profile_action'])->name('userProfileAction');
    Route::post('userProfileImageAction', [UserController::class, 'user_profile_image_action'])->name('userProfileImageAction');
    
    // Password Management
    Route::get('userChangePassword', [UserController::class, 'user_change_password'])->name('userChangePassword');
    Route::post('userChangePassword', [UserController::class, 'user_change_password_action'])->name('userChangePasswordAction');
});

// Admin Routes (Protected by adminAuth middleware)
Route::middleware(['adminAuth'])->group(function () {
    // Dashboard
    Route::get('adminDashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('adminLogout', [AdminController::class, 'adminLogout'])->name('adminLogout');
    
    // User Management
    Route::get('admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
    Route::post('admin/toggle-user-status/{id}', [AdminController::class, 'toggleUserStatus'])->name('admin.toggleUserStatus');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('adminDeleteUser');
    
    // Contact Messages
    Route::get('/admin/contact-messages', [AdminController::class, 'viewContactMessages'])->name('admin.contactMessages');
    Route::post('/admin/contact-message/{id}/read', [AdminController::class, 'markMessageAsRead'])->name('admin.markMessageRead');
    Route::delete('/admin/contact-message/{id}', [AdminController::class, 'deleteMessage'])->name('admin.deleteMessage');
});
