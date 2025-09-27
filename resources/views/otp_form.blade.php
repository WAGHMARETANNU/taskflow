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
    
    .otp-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #ffffff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .otp-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .otp-card {
        background: white;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .otp-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    }
    
    .otp-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .otp-subtitle {
        font-size: 1.1rem;
        color: #666;
        text-align: center;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .form-control {
        width: 100%;
        padding: 15px 18px;
        font-size: 1.5rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background-color: #f8f9fa;
        color: #2c5f54;
        text-align: center;
        letter-spacing: 4px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Courier New', monospace;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #aad2c1;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(170, 210, 193, 0.1);
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
    
    .otp-info {
        background: linear-gradient(135deg, #e8f4f0, #f0f8f5);
        border-left: 4px solid #aad2c1;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .otp-info p {
        margin: 0;
        color: #2c5f54;
        font-weight: 600;
        font-size: 1.1rem;
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
            <h1>OTP Verification</h1>
            <p>Enter the verification code to reset your password</p>
        </div>
    </div>
</div>

<!-- OTP Section -->
<div class="otp-section">
    <div class="otp-container">
        <div class="otp-card">
            <h2 class="otp-title">Verify OTP</h2>
            <p class="otp-subtitle">
                Enter the 6-digit verification code to continue with password reset.
            </p>
            
            @if(session('otp_info'))
                <div class="otp-info">
                    <p>{{ session('otp_info') }}</p>
                </div>
            @endif
            
            <form action="{{ URL::to('/') }}/VerifyOTP" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="otp" class="form-label" style="color: #2c5f54; font-weight: 600;">Enter 6-Digit OTP</label>
                    <input type="text" class="form-control @error('otp') is-invalid @enderror" 
                           id="otp" name="otp" placeholder="000000" maxlength="6" 
                           value="{{ old('otp') }}" autocomplete="off">
                    @error('otp')
                        <div class="text-danger" style="text-align: center; margin-top: 10px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle me-2"></i>
                    Verify OTP
                </button>
            </form>
            
            <div class="back-link">
                <a href="{{ route('signin') }}">
                    <i class="bi bi-arrow-left me-2"></i>
                    Remember your password? Sign in here
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// OTP Input formatting
document.getElementById('otp').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 6) {
        this.value = this.value.slice(0, 6);
    }
});

// Auto-focus on OTP input
document.getElementById('otp').focus();
</script>
@endsection
