@extends('layouts.Guest')

@section('content')
<style>
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .admin-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .admin-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin: 0;
    }

    .admin-subtitle {
        opacity: 0.9;
        margin: 5px 0 0 0;
    }

    .stats-row {
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.3s ease;
        border-left: 4px solid;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .stat-card.users {
        border-left-color: #4e73df;
    }

    .stat-card.messages {
        border-left-color: #f6c23e;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: #2c5f54;
        margin: 0;
    }

    .stat-label {
        color: #666;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
    }

    .stat-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 2rem;
        opacity: 0.3;
    }

    .quick-actions {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .action-btn {
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        color: #2c5f54;
        padding: 1rem 2rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        margin: 0.5rem;
        border: none;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: white;
        text-decoration: none;
    }

    .recent-activity {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .activity-item {
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #aad2c1, #7fb6a4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
    }
</style>

<div class="admin-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-title">TaskFlow Admin Dashboard</h1>
                <p class="admin-subtitle">Manage users, tasks, and system settings</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Statistics Cards  -->
    <div class="row stats-row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="stat-card users">
                <i class="bi bi-people stat-icon"></i>
                <h3 class="stat-number">{{ $totalUsers ?? 0 }}</h3>
                <p class="stat-label">Total Users</p>
            </div>
        </div>
        
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="stat-card messages">
                <i class="bi bi-envelope stat-icon"></i>
                <h3 class="stat-number">{{ $totalContactMessages ?? 0 }}</h3>
                <p class="stat-label">Contact Messages</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions  -->
    <div class="quick-actions">
        <h4 class="mb-4">Quick Actions</h4>
        <div class="text-center">
            <a href="{{ route('admin.users') }}" class="action-btn">
                <i class="bi bi-people me-2"></i>Manage Users
            </a>
            <a href="{{ route('admin.contactMessages') }}" class="action-btn">
                <i class="bi bi-envelope me-2"></i>Contact Messages
                @if(($unreadMessages ?? 0) > 0)
                    <span class="badge bg-danger ms-1">{{ $unreadMessages }}</span>
                @endif
            </a>
        </div>
    </div>

    <!-- System Overview  -->
    <div class="recent-activity">
        <h4 class="mb-4">System Overview</h4>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <strong>Active Users:</strong> {{ $activeUsers ?? 0 }} out of {{ $totalUsers ?? 0 }} total users
            </div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="bi bi-envelope"></i>
            </div>
            <div>
                <strong>Messages:</strong> {{ $unreadMessages ?? 0 }} unread out of {{ $totalContactMessages ?? 0 }} total
            </div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="bi bi-gear"></i>
            </div>
            <div>
                <strong>System Status:</strong> All services running normally
            </div>
        </div>
    </div>
</div>
@endsection
