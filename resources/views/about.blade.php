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
        margin-bottom: 10px;
    }
    
    .hero-section .subtitle {
        font-size: 1rem;
        opacity: 0.8;
        font-style: italic;
    }
    
    .section-padding {
        padding: 60px 0;
    }
    
    .section-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 40px;
        text-align: center;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        border-radius: 2px;
    }
    
    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 30px 25px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        border: 2px solid transparent;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        border-color: #aad2c1;
    }
    
    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.8rem;
        color: white;
    }
    
    .feature-card h4 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 12px;
    }
    
    .feature-card p {
        color: #666;
        line-height: 1.5;
        font-size: 0.95rem;
    }
    
    .project-info {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 50px 0;
        text-align: center;
    }
    
    .project-card {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        max-width: 800px;
        margin: 0 auto;
    }
    
    .project-card h3 {
        color: #2c5f54;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }
    
    .project-card p {
        color: #666;
        line-height: 1.7;
        font-size: 1.1rem;
        margin-bottom: 15px;
    }
    
    .tech-stack {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 25px;
    }
    
    .tech-badge {
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .cta-section {
        background: linear-gradient(135deg, #2c5f54 0%, #376666 100%);
        color: white;
        padding: 50px 0;
        text-align: center;
    }
    
    .cta-section h2 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .cta-section p {
        font-size: 1.1rem;
        margin-bottom: 25px;
        opacity: 0.9;
    }
    
    .btn-cta {
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        color: #2c5f54;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
    }
    
    .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        color: #1a4a42;
    }
    
    .bg-light-mint {
        background-color: #f8fffe;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1>Simple Task Management</h1>
        <p>A clean and easy-to-use to-do application for organizing your daily tasks</p>
        <p class="subtitle">Created as a college project for learning web development</p>
    </div>
</div>

<!-- Features Section -->
<div class="section-padding bg-light-mint">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-list-check" style="color: #aad2c1; margin-right: 15px;"></i>
            What You Can Do
        </h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <h4>Add Tasks</h4>
                    <p>Create new tasks with titles, descriptions, and due dates to keep track of what you need to do.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h4>Mark Complete</h4>
                    <p>Check off tasks when you're done and move them to your completed tasks list.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-list-ul"></i>
                    </div>
                    <h4>View Task Lists</h4>
                    <p>See all your pending tasks in one place and browse through your completed tasks.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-date"></i>
                    </div>
                    <h4>Set Due Dates</h4>
                    <p>Add deadlines to your tasks so you know when things need to be completed.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Project Info Section -->
<div class="project-info">
    <div class="container">
        <div class="project-card">
            <h3>About This Project</h3>
            <p>
                This to-do application was created as a college project to learn and practice web development skills. 
                It demonstrates the fundamentals of building a full-stack web application with user authentication, 
                database management, and responsive design.
            </p>
            <p>
                The goal was to create a simple, functional task management system that showcases clean code, 
                good design principles, and modern web development practices using Laravel and Bootstrap.
            </p>
            
            <h4 style="color: #2c5f54; margin: 25px 0 15px;">Built With:</h4>
            <div class="tech-stack">
                <span class="tech-badge">Laravel 10</span>
                <span class="tech-badge">PHP</span>
                <span class="tech-badge">MySQL</span>
                <span class="tech-badge">Bootstrap 5</span>
                <span class="tech-badge">HTML5</span>
                <span class="tech-badge">CSS3</span>
            </div>
        </div>
    </div>
</div>

<!-- Developer Section -->
<div class="section-padding">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-person-circle" style="color: #aad2c1; margin-right: 15px;"></i>
            Developer
        </h2>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #aad2c1, #7fb6a4); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; color: white; font-weight: bold; border: 4px solid white; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
                    TW
                </div>
                <h4 style="color: #2c5f54; margin-bottom: 10px;">Tannu Waghmare</h4>
                <p style="color: #7fb6a4; font-weight: 500; margin-bottom: 15px;">Student Developer</p>
                <p style="color: #666; line-height: 1.6;">
                    Computer Science student passionate about learning web development and creating useful applications. 
                    This project helped me understand full-stack development and user experience design.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="cta-section">
    <div class="container">
        <h2>Try It Out!</h2>
        <p>Sign up and start organizing your tasks with this simple to-do app</p>
        <a href="{{ route('signup') }}" class="btn-cta">
            <i class="bi bi-arrow-right me-2"></i>
            Create Account
        </a>
    </div>
</div>
@endsection
