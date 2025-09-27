@extends('layouts.Guest')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="hero-section mb-4">
                <h1 class="text-center mb-2">Change Password</h1>
                <p class="text-center text-muted">Password Compromised!! Change it here.</p>
            </div>

            <!-- Success/Error Messages -->
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
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Change Password Card -->
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-key me-2"></i>Change Password
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('userChangePasswordAction') }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="old_password" class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('old_password') is-invalid @enderror" 
                                               id="old_password" 
                                               name="old_password" 
                                               placeholder="Enter current password"
                                               required>
                                    </div>
                                    @error('old_password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-shield-lock"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('new_password') is-invalid @enderror" 
                                               id="new_password" 
                                               name="new_password" 
                                               placeholder="Enter new password"
                                               required>
                                    </div>
                                    @error('new_password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('confirm_password') is-invalid @enderror" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               placeholder="Confirm new password"
                                               required>
                                    </div>
                                    @error('confirm_password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Requirements -->
                                <div class="mb-4">
                                    <small class="text-muted">
                                        <strong>Password Requirements:</strong>
                                        <ul class="small mt-2">
                                            <li>At least 8 characters long</li>
                                            <li>Contains uppercase and lowercase letters</li>
                                            <li>Contains at least one number</li>
                                            <li>Contains at least one special character (#?!@$%^&*-)</li>
                                        </ul>
                                    </small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-theme btn-lg">
                                        <i class="bi bi-key me-2"></i>Change Password
                                    </button>
                                    <a href="{{ route('userProfile') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Profile
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        margin: 0 0 10px 0;
        font-weight: 600;
    }

    .hero-section p {
        margin: 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        background: white;
    }

    .card-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: none;
        padding: 1.5rem;
        text-align: center;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 8px;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus {
        border-color: #aad2c1;
        box-shadow: 0 0 0 0.2rem rgba(170, 210, 193, 0.25);
        background: white;
    }

    .input-group-text {
        background: #aad2c1;
        border: 2px solid #aad2c1;
        color: white;
        border-radius: 8px 0 0 8px;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 8px 8px 0;
    }

    .input-group .form-control:focus {
        border-left: 2px solid #aad2c1;
    }

    .btn-theme {
        background: #2c5f54;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .btn-theme:hover {
        background: #1a4a42;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(44, 95, 84, 0.3);
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
        transform: translateY(-1px);
    }

    .alert {
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 1.5rem;
        border: none;
    }

    .alert-success {
        background-color: #d1eddd;
        color: #2c5f54;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .small ul {
        margin: 0;
        padding-left: 1.2rem;
    }

    .small li {
        margin-bottom: 2px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 1.5rem;
        }
        
        .hero-section h1 {
            font-size: 2rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
    }

    /* Focus indicators for accessibility */
    .form-control:focus,
    .btn:focus {
        outline: 2px solid #aad2c1;
        outline-offset: 2px;
    }

    /* Animation for form submission */
    .btn-theme:active {
        transform: translateY(0);
    }
</style>

<script>
    // Real-time password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function() {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = this.value;
        
        if (confirmPassword && newPassword !== confirmPassword) {
            this.setCustomValidity('Passwords do not match');
            this.classList.add('is-invalid');
        } else {
            this.setCustomValidity('');
            this.classList.remove('is-invalid');
        }
    });

    // Password strength indicator (optional)
    document.getElementById('new_password').addEventListener('input', function() {
        const password = this.value;
        const strongPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,25}$/;
        
        if (password && strongPassword.test(password)) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else if (password) {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    });
</script>
@endsection
