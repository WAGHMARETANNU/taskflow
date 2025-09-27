<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 50px;
        }

        /* Guest navigation styling - maximum spread across full width */
        .guest-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            flex: 1;
        }

        .guest-nav .navbar-nav {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            width: 100%;
            gap: 0;
            margin: 0;
            flex: 1;
            padding: 0 50px;
        }

        /* User navigation styling - centered with specific spacing */
        .user-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .user-nav .navbar-nav {
            display: flex;
            gap: 60px;
            margin: 0 auto;
        }

        .navbar-brand {
            margin-right: 50px;
            flex-shrink: 0;
        }

        .navbar-collapse {
            flex-grow: 1;
        }

        .footer {
            background-color: #aad2c1;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            bottom: 0;
        }

        .footer p {
            margin: 0 auto;
            text-align: center !important;
            display: block !important;
        }

        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .navbar {
            background-color: #aad2c1 !important;
            padding: 15px 20px;
            border-bottom: 2px solid #47608f;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand img {
            width: 60px;
            height: 40px;
            border-radius: 8px;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            font-size: 16px;
            font-weight: 500;
            color: #376666;
            transition: all 0.3s ease-in-out;
            text-transform: capitalize;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            white-space: nowrap;
            min-width: 100px;
            text-align: center;
        }

        .navbar-nav .nav-link:hover {
            color: #2c5f54;
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Welcome message styling */
        .welcome-section {
            background-color: #f8f9fa;
            padding: 15px 30px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 0;
        }

        .welcome-text {
            color: #2c5f54;
            font-weight: 600;
            font-size: 18px;
            margin: 0;
        }

        /* Profile dropdown styling */
        .profile-dropdown {
            position: relative;
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        .profile-circle {
            width: 52px;
            height: 55px;
            border-radius: 50%;
            background-color: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.15);
            margin: 0;
        }

        .profile-circle:hover {
            background-color: #5a6fd8;
            transform: scale(1.05);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 10px 20px;
            font-weight: 500;
            color: #2c5f54;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #2c5f54;
        }

        .dropdown-divider {
            margin: 5px 0;
        }

        /* Custom badge styles matching theme colors */
        .badge-theme-pending {
            background-color: #aad2c1 !important;
            color: #2c5f54 !important;
            font-weight: 500;
            padding: 6px 12px;
            font-size: 0.75rem;
            border-radius: 6px;
        }

        .badge-theme-completed {
            background-color: #7fb6a4 !important;
            color: white !important;
            font-weight: 500;
            padding: 6px 12px;
            font-size: 0.75rem;
            border-radius: 6px;
        }

        .badge-theme-warning {
            background-color: #f0ad4e !important;
            color: white !important;
            font-weight: 500;
            padding: 6px 12px;
            font-size: 0.75rem;
            border-radius: 6px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2c5f54, #376666);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c5f54;
            letter-spacing: -0.5px;
        }

        /* Even more spacing for larger screens */
        @media (min-width: 1200px) {
            .guest-nav .navbar-nav {
                padding: 0 100px;
            }
            
            .navbar .container-fluid {
                padding: 0 80px;
            }
        }

        /* Responsive navigation adjustments */
        @media (max-width: 768px) {
            .guest-nav .navbar-nav,
            .user-nav .navbar-nav {
                gap: 20px;
                flex-direction: column;
                padding: 0;
            }
            
            .welcome-section {
                text-align: center;
            }
            
            .navbar .container-fluid {
                padding: 0 20px;
            }
        }
    </style>
</head>

<body>
    <div class="main-content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <!-- Logo on the left -->
                <a class="navbar-brand d-flex align-items-center" href="{{ session('user') ? route('userDashboard') : route('index') }}">
                    <div class="logo-container">
                        <div class="logo-icon">
                            <i class="bi bi-check2-square"></i>
                        </div>
                        <span class="logo-text">TaskFlow</span>
                    </div>
                </a>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(session('user'))
                        <!-- Logged-in User Navigation -->
                        <div class="user-nav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userDashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userTaskList') }}">My Tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userAddTask') }}">Add Task</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userCompletedTask') }}">Completed</a>
                                </li>
                            </ul>
                        </div>
                    @elseif(session('admin'))
                        <!-- Admin Navigation -->
                        <div class="user-nav">
                            <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.contactMessages') }}">
        <i class="fas fa-envelope"></i>
        <span>Contact Messages</span>
        @php
            $unreadCount = DB::table('contact_messages')->whereNull('read_at')->count();
        @endphp
        @if($unreadCount > 0)
            <span class="badge badge-danger badge-counter">{{ $unreadCount }}</span>
        @endif
    </a>
</li>

                        </div>
                    @else
                        <!-- Guest Navigation - Full Width Spacing -->
                        <div class="guest-nav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('signup') }}">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('signin') }}">Login</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Profile Section (Right Corner) - Only for logged in users -->
                @if(session('user'))
                    <div class="profile-dropdown dropdown">
                        <div class="profile-circle" data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                try {
                                    $userdata = \App\Models\registrations::where('email', session('user'))->first();
                                } catch (Exception $e) {
                                    $userdata = null;
                                }
                            @endphp
                            @if($userdata && $userdata->profile_picture && file_exists(public_path('images/profile_pictures/' . $userdata->profile_picture)))
                                <img src="{{ asset('images/profile_pictures/' . $userdata->profile_picture) }}?v={{ time() }}" 
                                     alt="Profile" 
                                     class="profile-image">
                            @else
                                {{ strtoupper(substr($userdata->fname ?? session('username', 'U'), 0, 1)) }}
                            @endif
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">{{ session('username', 'User') }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('userProfile') }}">
                                <i class="bi bi-person me-2"></i>My Profile
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('userChangePassword') }}">
                                <i class="bi bi-key me-2"></i>Change Password
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('UserLogout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a></li>
                        </ul>
                    </div>
                @elseif(session('admin'))
                    <div class="profile-dropdown dropdown">
                        <div class="profile-circle" data-bs-toggle="dropdown" aria-expanded="false">
                            A
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Administrator</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('adminLogout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </nav>

        <!-- Welcome Section (Below Navbar) -->
        @if(session('user'))
            <div class="welcome-section">
                <p class="welcome-text">Welcome back, {{ session('username', 'User') }}! 👋</p>
            </div>
        @endif

        <div class="container my-5">
            @yield('content')
        </div>

        <footer class="footer fixed-bottom">
            <p>&copy; 2025 TaskFlow. All rights reserved.</p>
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
