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
    
    /* Login Section */
    .login-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #ffffff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .login-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .login-card {
        background: white;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    }
    
    .login-card:hover {
        border-color: #aad2c1;
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(0,0,0,0.15);
    }
    
    .login-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .login-subtitle {
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
    
    /* Remember Me Section */
    .remember-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    
    .remember-checkbox {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    
    .remember-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        border: 2px solid #aad2c1;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .remember-checkbox input[type="checkbox"]:checked {
        background-color: #aad2c1;
        border-color: #aad2c1;
    }
    
    .remember-checkbox input[type="checkbox"]:focus {
        box-shadow: 0 0 0 3px rgba(170, 210, 193, 0.2);
    }
    
    .remember-checkbox label {
        color: #2c5f54;
        cursor: pointer;
        font-weight: 500;
        user-select: none;
    }
    
    .forgot-password {
        color: #7fb6a4;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .forgot-password:hover {
        color: #2c5f54;
        text-decoration: underline;
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
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #1a4a42, #2c5f54);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    /* Register Link */
    .register-link {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .register-link p {
        color: #666;
        margin-bottom: 10px;
    }
    
    .register-link a {
        color: #2c5f54;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .register-link a:hover {
        color: #aad2c1;
    }
    
    /* Welcome Icon */
    .welcome-icon {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .welcome-icon i {
        font-size: 4rem;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.2rem;
        }
        
        .login-card {
            padding: 30px 25px;
            margin: 20px;
        }
        
        .login-title {
            font-size: 1.8rem;
        }
        
        .form-control {
            padding: 12px 15px;
        }
        
        .remember-section {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Login to Your Account</h1>
            <p>Access your tasks and stay organized with us</p>
        </div>
    </div>
</div>

<!-- Login Section -->
<div class="login-section">
    <div class="login-container">
        <div class="login-card">
            <div class="welcome-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            
            <h2 class="login-title">Welcome Back!</h2>
            <p class="login-subtitle">
                Please sign in to your account to continue managing your tasks and stay productive.
            </p>
            
            <!-- Replace the form section with this -->
<form method="POST" action="{{ route('verifyLogin') }}">
    @csrf
    
    <!-- Display Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0" style="list-style: none; padding-left: 0;">
                @foreach($errors->all() as $error)
                    <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="email" 
               class="form-control @error('email') is-invalid @enderror" 
               name="email" 
               id="email" 
               placeholder="Enter your email address"
               value="{{ old('email') }}" 
               required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" 
               class="form-control @error('password') is-invalid @enderror" 
               name="password" 
               id="password" 
               placeholder="Enter your password"
               required>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="remember-section">
        <div class="remember-checkbox">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>
        <a href="{{ route('forgotPwd') }}" class="forgot-password">Forgot Password?</a>
    </div>
    
    <button type="submit" class="btn-submit">
        <i class="bi bi-box-arrow-in-right me-2"></i>
        Sign In
    </button>
</form>

            
            <div class="register-link">
                <p>Don't have an account?</p>
                <a href="{{ route('signup') }}">Create one here</a>
            </div>
        </div>
    </div>
</div>
@endsection
