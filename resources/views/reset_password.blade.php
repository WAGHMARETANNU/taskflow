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
    
    .reset-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #ffffff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .reset-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .reset-card {
        background: white;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .reset-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    }
    
    .reset-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .reset-subtitle {
        font-size: 1.1rem;
        color: #666;
        text-align: center;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .form-control {
        width: 100%;
        padding: 15px 18px;
        font-size: 1.1rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background-color: #f8f9fa;
        color: #2c5f54;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #aad2c1;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(170, 210, 193, 0.1);
    }
    
    .form-label {
        color: #2c5f54;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    
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
    
    .success-info {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border-left: 4px solid #28a745;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .success-info p {
        margin: 0;
        color: #155724;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .password-requirements {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: #666;
    }
    
    .password-requirements ul {
        margin: 5px 0 0 0;
        padding-left: 20px;
    }
    
    .back-link {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .back-link a {
        color: #2c5f54;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .back-link a:hover {
        color: #aad2c1;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Reset Password</h1>
            <p>Create a new secure password for your account</p>
        </div>
    </div>
</div>

<!-- Reset Password Section -->
<div class="reset-section">
    <div class="reset-container">
        <div class="reset-card">
            <h2 class="reset-title">Set New Password</h2>
            <p class="reset-subtitle">
                Please enter a strong password that you haven't used before.
            </p>
            
            @if(session('success'))
                <div class="success-info">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <form action="{{ route('UpdatePassword') }}" method="POST">
                @csrf
                
                <div class="password-requirements">
                    <strong>Password Requirements:</strong>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Contains uppercase and lowercase letters</li>
                        <li>Contains at least one number</li>
                        <li>Contains at least one special character (#?!@$%^&*-)</li>
                    </ul>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Enter new password" 
                           autocomplete="new-password">
                    @error('password')
                        <div class="text-danger" style="text-align: center; margin-top: 10px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" 
                           id="confirm_password" name="confirm_password" placeholder="Confirm new password" 
                           autocomplete="new-password">
                    @error('confirm_password')
                        <div class="text-danger" style="text-align: center; margin-top: 10px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-shield-check me-2"></i>
                    Update Password
                </button>
            </form>
            
            <div class="back-link">
                <a href="{{ route('signin') }}">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Sign In
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Password confirmation validation
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (password !== confirmPassword) {
        this.style.borderColor = '#dc3545';
    } else {
        this.style.borderColor = '#28a745';
    }
});
</script>
@endsection
