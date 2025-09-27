@extends('layouts.Guest')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="profile-header mb-4">
                <h2 class="text-center mb-2">Edit Profile</h2>
                <p class="text-center text-muted">Update your personal information</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Profile Picture Section -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Profile Picture</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="profile-picture-container mb-3">
                                @if(isset($userdata['profile_picture']) && $userdata['profile_picture'] && file_exists(public_path('images/profile_pictures/' . $userdata['profile_picture'])))
                                    <img id="profilePreview" 
                                         src="{{ asset('images/profile_pictures/' . $userdata['profile_picture']) }}?v={{ time() }}" 
                                         alt="Profile Picture" 
                                         class="profile-image-large">
                                @else
                                    <div id="profilePreview" class="profile-placeholder-large">
                                        {{ strtoupper(substr($userdata['fname'] ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <p class="text-muted small mb-3">JPG, PNG or GIF. Max size 2MB</p>
                            
                            <!-- Separate Profile Picture Upload Form -->
                            <form id="profilePictureForm" action="{{ route('userProfileImageAction') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" 
                                       id="profile_picture" 
                                       name="profile_image" 
                                       class="d-none" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                       
                                <button type="button" 
                                        class="btn btn-theme btn-sm" 
                                        onclick="document.getElementById('profile_picture').click()">
                                    <i class="bi bi-camera me-2"></i>Choose Photo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Details Section -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Account Details</h5>
                        </div>
                        <div class="card-body">
                            <!-- Main Profile Update Form -->
                            <form action="{{ route('userProfileAction') }}" method="POST">
                                @csrf
                                
                                <!-- Personal Information -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="fname" class="form-label">Full Name *</label>
                                        <input type="text" 
                                               class="form-control @error('fname') is-invalid @enderror" 
                                               id="fname" 
                                               name="fname" 
                                               value="{{ old('fname', $userdata['fname'] ?? '') }}" 
                                               required>
                                        @error('fname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               value="{{ $userdata['email'] ?? '' }}" 
                                               readonly>
                                        <small class="text-muted">Email cannot be changed</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="mobile" class="form-label">Mobile Number *</label>
                                        <input type="text" 
                                               class="form-control @error('mobile') is-invalid @enderror" 
                                               id="mobile" 
                                               name="mobile" 
                                               value="{{ old('mobile', $userdata['mobile'] ?? '') }}" 
                                               maxlength="10"
                                               required>
                                        @error('mobile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Gender *</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" 
                                                id="gender" 
                                                name="gender" 
                                                required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', strtolower($userdata['gender'] ?? '')) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', strtolower($userdata['gender'] ?? '')) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', strtolower($userdata['gender'] ?? '')) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Education *</label>
                                        <div class="d-flex flex-wrap gap-3 mt-2">
                                            @php
                                                $existingEdu = old('edu', explode(',', $userdata['edu'] ?? ''));
                                                $existingEdu = array_filter(array_map('trim', $existingEdu));
                                            @endphp
                                            
                                            <div class="form-check">
                                                <input type="checkbox" name="edu[]" value="10th" id="edu_10th" class="form-check-input"
                                                       {{ in_array('10th', $existingEdu) ? 'checked' : '' }}>
                                                <label for="edu_10th" class="form-check-label">10th</label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input type="checkbox" name="edu[]" value="12th" id="edu_12th" class="form-check-input"
                                                       {{ in_array('12th', $existingEdu) ? 'checked' : '' }}>
                                                <label for="edu_12th" class="form-check-label">12th</label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input type="checkbox" name="edu[]" value="Graduate" id="edu_graduate" class="form-check-input"
                                                       {{ in_array('Graduate', $existingEdu) ? 'checked' : '' }}>
                                                <label for="edu_graduate" class="form-check-label">Graduate</label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input type="checkbox" name="edu[]" value="Post Graduate" id="edu_pg" class="form-check-input"
                                                       {{ in_array('Post Graduate', $existingEdu) ? 'checked' : '' }}>
                                                <label for="edu_pg" class="form-check-label">Post Graduate</label>
                                            </div>
                                        </div>
                                        @error('edu')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Change Section -->
                                <hr class="my-4">
                                <h6 class="text-muted mb-3">Change Password (Optional)</h6>
                                
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" 
                                               class="form-control @error('new_password') is-invalid @enderror" 
                                               id="new_password" 
                                               name="new_password">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="new_password_confirmation" 
                                               name="new_password_confirmation">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('userProfile') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-theme">
                                        <i class="bi bi-check-circle me-2"></i>Save Changes
                                    </button>
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

    .profile-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .profile-image-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #aad2c1;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .profile-placeholder-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        font-weight: bold;
        margin: 0 auto;
        border: 4px solid #aad2c1;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .profile-picture-container {
        display: flex;
        justify-content: center;
    }

    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: none;
        border-radius: 10px;
        background: white;
    }

    .card-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        border-bottom: none;
        padding: 20px;
        font-weight: 600;
    }

    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #aad2c1;
        box-shadow: 0 0 0 0.2rem rgba(170, 210, 193, 0.25);
        background: white;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
    }

    .form-label {
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 8px;
        display: block;
    }

    .btn-theme {
        background: #2c5f54;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-theme:hover {
        background: #1a4a42;
        color: white;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }

    .form-check-input {
        border-color: #aad2c1;
    }

    .form-check-input:checked {
        background-color: #2c5f54;
        border-color: #2c5f54;
    }

    .form-check-input:focus {
        border-color: #aad2c1;
        box-shadow: 0 0 0 0.25rem rgba(170, 210, 193, 0.25);
    }

    .form-check-label {
        color: #2c5f54;
        font-weight: 500;
    }

    .form-check {
        margin-bottom: 0.5rem;
    }

    .alert-success {
        background-color: #d1eddd;
        border-color: #aad2c1;
        color: #2c5f54;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .text-muted {
        color: #6c757d !important;
    }

    hr {
        border-color: #aad2c1;
        opacity: 0.3;
    }

    @media (max-width: 768px) {
        .profile-container {
            margin: 20px;
        }
        
        .profile-header {
            padding: 1.5rem;
        }
        
        .card-header {
            padding: 15px;
        }
    }
</style>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('profilePreview');
                preview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="profile-image-large">`;
            }
            
            reader.readAsDataURL(input.files[0]);
            
            // Auto-submit the form when image is selected
            setTimeout(() => {
                if (confirm('Upload this profile picture?')) {
                    document.getElementById('profilePictureForm').submit();
                }
            }, 500);
        }
    }
</script>
@endsection
