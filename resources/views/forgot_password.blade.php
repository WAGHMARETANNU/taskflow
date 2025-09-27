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
    
    /* Forgot Password Section */
    .forgot-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #ffffff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .forgot-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .forgot-card {
        background: white;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .forgot-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    }
    
    .forgot-card:hover {
        border-color: #aad2c1;
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(0,0,0,0.15);
    }
    
    .forgot-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .forgot-subtitle {
        font-size: 1.1rem;
        color: #666;
        text-align: center;
        margin-bottom: 40px;
        line-height: 1.6;
    }
    
    /* Icon Section */
    .forgot-icon {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .forgot-icon i {
        font-size: 4rem;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
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
        margin-bottom: 20px;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #1a4a42, #2c5f54);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    /* Back to Login Link */
    .back-login {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .back-login a {
        color: #2c5f54;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .back-login a:hover {
        color: #aad2c1;
    }
    
    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, #e8f4f0, #f0f8f5);
        border-left: 4px solid #aad2c1;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }
    
    .info-box p {
        margin: 0;
        color: #2c5f54;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .info-box i {
        color: #aad2c1;
        margin-right: 8px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.2rem;
        }
        
        .forgot-card {
            padding: 30px 25px;
            margin: 20px;
        }
        
        .forgot-title {
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
            <h1>Forgot Your Password?</h1>
            <p>No worries! We'll help you reset it securely</p>
        </div>
    </div>
</div>

<!-- Forgot Password Section -->
<div class="forgot-section">
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-icon">
                <i class="bi bi-key"></i>
            </div>
            
            <h2 class="forgot-title">Reset Password</h2>
            <p class="forgot-subtitle">
                Enter your email address and we'll send you an OTP to reset your password.
            </p>
            
            <div class="info-box">
                <p>
                    <i class="bi bi-info-circle"></i>
                    You will receive a 6-digit OTP code on your registered email address. 
                    Please check your inbox and spam folder.
                </p>
            </div>
            
            <form action="{{ URL::to('/') }}/SendOTP" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Enter your registered email address" 
                           value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-send me-2"></i>
                    Send OTP
                </button>
            </form>
            
            <div class="back-login">
                <a href="{{ route('signin') }}">
                    <i class="bi bi-arrow-left"></i>
                    Remember your password? Sign in here
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
