@extends('layouts.Guest')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 100px 0;
        text-align: center;
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
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        line-height: 1.2;
    }
    
    .hero-section .subtitle {
        font-size: 1.4rem;
        font-weight: 300;
        opacity: 0.95;
        margin-bottom: 10px;
    }
    
    .hero-section .tagline {
        font-size: 1rem;
        opacity: 0.8;
        font-style: italic;
        margin-bottom: 40px;
    }
    
    .cta-buttons {
        margin-top: 40px;
    }
    
    .btn-hero {
        padding: 15px 40px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        margin: 0 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-primary-hero {
        background: white;
        color: #2c5f54;
        border: 2px solid white;
    }
    
    .btn-primary-hero:hover {
        background: transparent;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .btn-secondary-hero {
        background: transparent;
        color: white;
        border: 2px solid white;
    }
    
    .btn-secondary-hero:hover {
        background: white;
        color: #2c5f54;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    /* Features Section */
    .features-section {
        padding: 100px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #ffffff 100%);
    }
    
    .section-title {
        font-size: 3rem;
        font-weight: 700;
        color: #2c5f54;
        text-align: center;
        margin-bottom: 20px;
        position: relative;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: #666;
        text-align: center;
        margin-bottom: 60px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .features-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        margin-top: 60px;
    }
    
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }
    
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(170, 210, 193, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .feature-card:hover::before {
        left: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: #aad2c1;
    }
    
    .feature-icon {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2.2rem;
        color: white;
        position: relative;
        z-index: 2;
    }
    
    .feature-card h3 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 15px;
        position: relative;
        z-index: 2;
    }
    
    .feature-card p {
        color: #666;
        line-height: 1.7;
        font-size: 1.1rem;
        position: relative;
        z-index: 2;
    }
    
    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #2c5f54 0%, #376666 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .stat-item {
        padding: 20px;
    }
    
    .stat-number {
        font-size: 3.5rem;
        font-weight: 700;
        display: block;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    /* Call to Action Section */
    .cta-section {
        background: linear-gradient(135deg, #f8fffe 0%, #aad2c1 100%);
        padding: 100px 0;
        text-align: center;
    }
    
    .cta-section h2 {
        font-size: 3rem;
        font-weight: 700;
        color: #2c5f54;
        margin-bottom: 20px;
    }
    
    .cta-section p {
        font-size: 1.3rem;
        color: #376666;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .btn-cta {
        background: linear-gradient(135deg, #2c5f54, #376666);
        color: white;
        font-weight: 600;
        padding: 18px 50px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        border: none;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        background: linear-gradient(135deg, #1a4a42, #2c5f54);
        color: white;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }
        
        .hero-section .subtitle {
            font-size: 1.2rem;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .section-title {
            font-size: 2.2rem;
        }
        
        .cta-section h2 {
            font-size: 2.2rem;
        }
        
        .btn-hero {
            display: block;
            margin: 10px auto;
            max-width: 250px;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Stay Organized & Productive</h1>
            <p class="subtitle">Manage your tasks effortlessly with our clean and intuitive interface</p>
            <p class="tagline">A student project showcasing modern web development</p>
            
            <div class="cta-buttons">
                <a href="{{ route('signup') }}" class="btn-hero btn-primary-hero">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Get Started
                </a>
                <a href="{{ route('aboutus') }}" class="btn-hero btn-secondary-hero">
                    <i class="bi bi-info-circle me-2"></i>
                    Learn More
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="features-container">
        <h2 class="section-title">Simple Task Management</h2>
        <p class="section-subtitle">
            Everything you need to organize your daily tasks in one clean, easy-to-use application
        </p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-plus-circle-fill"></i>
                </div>
                <h3>Easy to Use</h3>
                <p>Quickly add, edit, and delete tasks with our user-friendly interface. No complicated features, just what you need to stay organized.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h3>Track Progress</h3>
                <p>Mark tasks as complete and see your progress. View your completed tasks to feel accomplished about what you've achieved.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>
                <h3>Set Deadlines</h3>
                <p>Add due dates to your tasks so you never miss an important deadline. Stay on top of your schedule with clear date tracking.</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="container">
        <h2 style="font-size: 2.5rem; margin-bottom: 50px;">Built with Modern Technology</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">Laravel</span>
                <span class="stat-label">Backend Framework</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">Bootstrap</span>
                <span class="stat-label">Frontend Design</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">MySQL</span>
                <span class="stat-label">Database</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">PHP</span>
                <span class="stat-label">Programming Language</span>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="cta-section">
    <div class="container">
        <h2>Ready to Get Organized?</h2>
        <p>
            Start managing your tasks more effectively today. Create your account and experience 
            simple, clean task management built by a student, for students and everyone else.
        </p>
        <a href="{{ route('signup') }}" class="btn-cta">
            <i class="bi bi-arrow-right me-2"></i>
            Create Your Account
        </a>
    </div>
</div>
@endsection
