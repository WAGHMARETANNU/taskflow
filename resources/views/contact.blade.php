@extends('layouts.Guest')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
        margin-top: -20px;
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
    
    .contact-section {
        padding: 80px 0;
        background-color: #f8fffe;
    }
    
    .contact-container {
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .contact-info-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .contact-info-card:hover {
        border-color: #aad2c1;
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .section-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        border-radius: 2px;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding: 20px;
        background: #f8fffe;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .contact-item:hover {
        background: #eef7f6;
        transform: translateX(5px);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
    }
    
    .contact-details {
        flex-grow: 1;
    }
    
    .contact-label {
        font-size: 0.9rem;
        color: #7fb6a4;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }
    
    .contact-value {
        font-size: 1.2rem;
        color: #2c5f54;
        font-weight: 600;
        margin: 0;
    }
    
    .contact-form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .contact-form-card:hover {
        border-color: #aad2c1;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        font-size: 1rem;
        color: #2c5f54;
        font-weight: 500;
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
    }
    
    .form-control::placeholder {
        color: #9ca3af;
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        color: #2c5f54;
        font-weight: 600;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
        margin: 30px auto 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        background: linear-gradient(135deg, #7fb6a4, #6ca192);
        color: white;
    }
    
    .info-text {
        text-align: center;
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 40px;
    }
    
    .project-note {
        background: linear-gradient(135deg, #e8f4f0, #f0f8f5);
        border-left: 4px solid #aad2c1;
        padding: 20px;
        border-radius: 8px;
        margin-top: 30px;
        text-align: center;
    }
    
    .project-note p {
        margin: 0;
        color: #2c5f54;
        font-style: italic;
    }

    /* Alert Styles */
    .alert {
        border-radius: 10px;
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
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.2rem;
        }
        
        .contact-info-card,
        .contact-form-card {
            padding: 30px 20px;
        }
        
        .contact-item {
            flex-direction: column;
            text-align: center;
        }
        
        .contact-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1>Get in Touch</h1>
        <p>Have questions about the to-do app? We'd love to hear from you!</p>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section">
    <div class="container">
        <div class="contact-container">
            
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
                    <ul class="mb-0" style="list-style: none; padding-left: 0;">
                        @foreach($errors->all() as $error)
                            <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- Introduction -->
            <div class="info-text">
                <p>
                    Whether you have feedback about the app, found a bug, or just want to say hello, 
                    feel free to reach out. As this is a college project, your input helps me learn and improve!
                </p>
            </div>

            <!-- Contact Information -->
            <div class="contact-info-card">
                <h2 class="section-title">Contact Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Email Address</div>
                                <p class="contact-value">twaghmare871@rku.ac.in</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">Phone Number</div>
                                <p class="contact-value">+91 96648 52598</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="project-note">
                    <p>
                        <i class="bi bi-info-circle me-2"></i>
                        This is a student project created for learning purposes. Response times may vary based on academic schedule.
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-card">
                <h2 class="section-title">Send a Message</h2>
                <form class="contact-form" method="POST" action="{{ route('contactSubmit') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Your Name</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       placeholder="Enter your full name" 
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Your Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       placeholder="Enter your email address" 
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" 
                               class="form-control @error('subject') is-invalid @enderror" 
                               name="subject" 
                               placeholder="What is this about?" 
                               value="{{ old('subject') }}"
                               required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Your Message</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                  name="message" 
                                  rows="5" 
                                  placeholder="Tell me about your experience with the app, suggestions for improvement, or any questions you have..." 
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-send me-2"></i>
                        Send Message
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
