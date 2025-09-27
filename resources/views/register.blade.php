@extends('layouts.Guest')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        text-align: center;
        padding: 60px 0;
        margin-top: -20px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .hero-section p {
        font-size: 1.2rem;
        font-weight: 300;
        opacity: 0.9;
    }
    
    /* Register Section */
    .register-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #ffffff 100%);
        min-height: 100vh;
    }
    
    .register-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .register-card {
        background: white;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    }
    
    .register-card:hover {
        border-color: #aad2c1;
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(0,0,0,0.15);
    }
    
    .register-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .register-subtitle {
        font-size: 1.1rem;
        color: #666;
        text-align: center;
        margin-bottom: 40px;
        line-height: 1.6;
    }
    
    /* Form Styling */
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        font-size: 1rem;
        color: #2c5f54;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        position: relative;
    }
    
    .form-label::after {
        content: '*';
        color: #dc3545;
        margin-left: 4px;
    }
    
    .form-control {
        width: 100%;
        padding: 15px 18px;
        font-size: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background-color: #f8f9fa;
        color: #2c5f54;
        transition: all 0.3s ease;
        font-family: inherit;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #aad2c1;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(170, 210, 193, 0.1);
        transform: translateY(-1px);
    }
    
    .form-control::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }
    
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
    
    /* Select Styling */
    select.form-control {
        cursor: pointer;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    
    /* File Input Styling */
    input[type="file"].form-control {
        padding: 12px 18px;
        cursor: pointer;
    }
    
    input[type="file"].form-control::-webkit-file-upload-button {
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        margin-right: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    input[type="file"].form-control::-webkit-file-upload-button:hover {
        background: linear-gradient(135deg, #7fb6a4, #6ca192);
        transform: translateY(-1px);
    }
    
    /* Checkbox Styling */
    .form-check {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        border: 2px solid #aad2c1;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .form-check-input:checked {
        background-color: #aad2c1;
        border-color: #aad2c1;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(170, 210, 193, 0.2);
    }
    
    .form-check-label {
        color: #2c5f54;
        cursor: pointer;
        font-weight: 500;
    }
    
    /* Education Section */
    .education-section {
        background: #f8fffe;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e9ecef;
        margin-top: 10px;
    }
    
    /* Error Messages */
    .text-danger {
        font-size: 0.875rem;
        margin-top: 5px;
        font-weight: 500;
    }
    
    /* Submit Button */
    .btn-submit {
        background: linear-gradient(135deg, #2c5f54, #376666);
        color: white;
        font-weight: 600;
        padding: 18px 40px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 20px;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #1a4a42, #2c5f54);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    /* Already have account link */
    .login-link {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .login-link p {
        color: #666;
        margin-bottom: 10px;
    }
    
    .login-link a {
        color: #2c5f54;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .login-link a:hover {
        color: #aad2c1;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.2rem;
        }
        
        .register-card {
            padding: 30px 25px;
            margin: 20px;
        }
        
        .register-title {
            font-size: 1.8rem;
        }
        
        .form-control {
            padding: 12px 15px;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Create an Account</h1>
            <p>Join our community and start organizing your tasks today</p>
        </div>
    </div>
</div>

<!-- Register Section -->
<div class="register-section">
    <div class="register-container">
        <div class="register-card">
            <h2 class="register-title">Get Started</h2>
            <p class="register-subtitle">
                Create your account to access all features of our task management application.
                All fields are required to ensure the best experience.
            </p>
            
            <form action="{{ URL::to('/') }}/register_action" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                placeholder="Enter your full name" name="fname" value="{{ old('fname') }}">
                            @error('fname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter your email address" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Create a strong password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                placeholder="Confirm your password" name="confirm_password">
                            @error('confirm_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                placeholder="Enter your mobile number" name="mobile" value="{{ old('mobile') }}">
                            @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                name="profile_picture" accept="image/*">
                            @error('profile_picture')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Educational Qualification</label>
                            <div class="education-section">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="diploma" name="edu[]" value="Diploma">
                                            <label class="form-check-label" for="diploma">Diploma</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="graduate" name="edu[]" value="Graduate">
                                            <label class="form-check-label" for="graduate">Graduate</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="postgraduate" name="edu[]" value="Post Graduate">
                                            <label class="form-check-label" for="postgraduate">Post Graduate</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="doctorate" name="edu[]" value="Doctorate">
                                            <label class="form-check-label" for="doctorate">Doctorate</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('edu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-person-plus me-2"></i>
                    Create My Account
                </button>
            </form>
            
            <div class="login-link">
                <p>Already have an account?</p>
                <a href="{{ route('signin') }}">Sign in here</a>
            </div>
        </div>
    </div>
</div>
@endsection
    