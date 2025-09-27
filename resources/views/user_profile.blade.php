@extends('layouts.Guest')
@section('content')
<style>
    body {
        background: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .profile-dropdown {
    position: relative;
    margin-left: 8px;
}
.profile-circle {
    width: 55px !important;
    height: 55px !important;
    border-radius: 50%;
    background-color: #7fb6a4;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 10px !important;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05) !important;
}
.profile-circle:hover {
    background-color: #6ca192;
    transform: scale(1.1);
}
.profile-circle .profile-image {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

/* Also adjust navbar padding on profile page */
.navbar {
    padding: 12px 20px !important;
}
    
    .hero-section {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        text-align: center;
        padding: 40px 0;
        margin: 0;
    }
    
    .hero-section h1 {
        font-size: 2.5rem;
        margin: 0 0 10px 0;
        font-weight: 600;
    }
    
    .hero-section p {
        margin: 0;
        opacity: 0.9;
    }
    
    .profile-container {
        max-width: 800px;
        margin: 40px auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .profile-content {
        padding: 30px;
    }
    
    .profile-image-section {
    text-align: center;
    margin-bottom: 30px;
}
    
    .profile-image-container {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
    }
    .profile-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid #aad2c1;
    object-fit: cover;
    background-color: #f8f9fa;
    display: block;
}
    
  .profile-image-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid #aad2c1;
    background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: bold;
    color: white;
    margin: 0 auto;
}
    
    .upload-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        text-align: center;
    }
    
    .file-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        background: white;
    }
    
    .btn-upload {
        background: #2c5f54;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        width: 100%;
    }
    
    .btn-upload:hover {
        background: #1a4a42;
    }
    
    .profile-name {
        font-size: 2rem;
        color: #2c5f54;
        margin: 0 0 30px 0;
        text-align: center;
        font-weight: 600;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .info-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #aad2c1;
    }
    
    .info-label {
        font-size: 0.85rem;
        color: #666;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .info-value {
        font-size: 1.1rem;
        color: #2c5f54;
        font-weight: 600;
        word-wrap: break-word;
    }
    
    .btn-edit {
        background: #2c5f54;
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
    }
    
    .btn-edit:hover {
        background: #1a4a42;
        color: white;
        text-decoration: none;
    }

    .alert {
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
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
    
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .profile-container {
            margin: 20px;
        }
    }
</style>

<div class="hero-section">
    <div class="container">
        <h1>My Profile</h1>
        <p>Manage your personal information</p>
    </div>
</div>

<div class="profile-container">
    <div class="profile-content">
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

        <div class="row">
            <div class="col-md-4">
    <div class="profile-image-section">
        <div class="profile-image-container">
            @if(isset($userdata['profile_picture']) && $userdata['profile_picture'] && file_exists(public_path('images/profile_pictures/' . $userdata['profile_picture'])))
                <img id="profileImageDisplay" 
                     src="{{ asset('images/profile_pictures/' . $userdata['profile_picture']) }}?v={{ time() }}" 
                     alt="Profile Picture" 
                     class="profile-image">
            @else
                <div id="profileImagePlaceholder" class="profile-image-placeholder">
                    {{ strtoupper(substr($userdata['fname'] ?? 'U', 0, 1)) }}
                </div>
                <img id="profileImageDisplay" 
                     src="" 
                     alt="Profile Picture" 
                     class="profile-image" 
                     style="display: none;">
            @endif
        </div>
    </div>
    
    <div class="upload-section">
        <form action="{{ route('userProfileImageAction') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <input type="file" name="profile_image" id="profileImageInput" class="file-input" accept="image/*" required>
            <button type="submit" class="btn-upload">Update Picture</button>
        </form>
    </div>
</div>

            <div class="col-md-8">
                <h2 class="profile-name">{{ $userdata['fname'] ?? 'User Name' }}</h2>
                
                <div class="info-grid">
                    <div class="info-box">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $userdata['email'] ?? 'No email' }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Mobile Number</div>
                        <div class="info-value">{{ $userdata['mobile'] ?? 'No mobile' }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Gender</div>
                        <div class="info-value">{{ ucfirst($userdata['gender'] ?? 'Not specified') }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Education</div>
                        <div class="info-value">
                            {{ isset($userdata['edu']) ? str_replace(',', ', ', $userdata['edu']) : 'No education info' }}
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('userChangeProfile') }}" class="btn-edit">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('profileImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB');
            this.value = '';
            return;
        }
        
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Please select a valid image file (JPEG, PNG, JPG, GIF)');
            this.value = '';
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageDisplay = document.getElementById('profileImageDisplay');
            const placeholder = document.getElementById('profileImagePlaceholder');
            
            imageDisplay.src = e.target.result;
            imageDisplay.style.display = 'block';
            
            if (placeholder) {
                placeholder.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    }
});

// Form submission handling
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('profileImageInput');
    if (!fileInput.files[0]) {
        e.preventDefault();
        alert('Please select an image file first');
        return false;
    }
});
</script>
@endsection
