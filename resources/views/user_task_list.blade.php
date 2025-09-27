@extends('layouts.Guest')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="hero-section mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="hero-title">Task List</h1>
                        <p class="hero-subtitle">Manage and organize all your tasks</p>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center mt-3 mt-lg-0">
                        <a href="{{ route('userAddTask') }}" class="btn btn-theme btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>Add New Task
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Task Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-primary">
                            <i class="bi bi-list-task"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ count($task_result) }}</h3>
                            <p>Total Tasks</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-warning">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $task_result->where('status', 'Pending')->count() }}</h3>
                            <p>Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $task_result->where('status', 'Completed')->count() }}</h3>
                            <p>Completed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-info">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stats-content">
                            <h3>{{ $task_result->where('status', 'In Progress')->count() }}</h3>
                            <p>In Progress</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Tasks Card -->
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">
                                <i class="bi bi-list-ul me-2"></i>All Tasks
                            </h4>
                        </div>
                        <div class="col-auto">
                            <span class="badge badge-count">{{ count($task_result) }} Tasks</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($task_result && count($task_result) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Task Title</th>
                                        <th>Description</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($task_result as $index => $task)
                                        <tr>
                                            <td class="text-center">
                                                <span class="task-number">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="task-title">{{ $task->task_name }}</div>
                                                <small class="text-muted">
                                                    Created: {{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="task-description">
                                                    {{ Str::limit($task->task_description, 60) }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($task->status == 'Pending')
                                                    <span class="badge badge-pending">
                                                        <i class="bi bi-clock me-1"></i>{{ $task->status }}
                                                    </span>
                                                @elseif ($task->status == 'Completed')
                                                    <span class="badge badge-completed">
                                                        <i class="bi bi-check-circle me-1"></i>{{ $task->status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-progress">
                                                        <i class="bi bi-hourglass-split me-1"></i>{{ $task->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="deadline-date">
                                                    {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                                </span>
                                                @if(\Carbon\Carbon::parse($task->deadline)->isPast() && $task->status != 'Completed')
                                                    <br><small class="text-danger">Overdue</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('userEditTask', $task->id) }}" 
                                                       class="btn btn-sm btn-outline-primary" 
                                                       title="Edit Task">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('userDeleteTask', $task->id) }}" 
                                                       class="btn btn-sm btn-outline-danger" 
                                                       title="Delete Task"
                                                       onclick="return confirm('Are you sure you want to delete this task?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                    @if ($task->status == 'Pending')
                                                        <a href="{{ route('userMarkCompletedTask', $task->id) }}" 
                                                           class="btn btn-sm btn-outline-success" 
                                                           title="Mark as Complete">
                                                            <i class="bi bi-check-circle"></i>
                                                        </a>
                                                    @elseif ($task->status == 'Completed')
                                                        <a href="{{ route('userMarkPendingTask', $task->id) }}" 
                                                           class="btn btn-sm btn-outline-warning" 
                                                           title="Mark as Pending">
                                                            <i class="bi bi-arrow-counterclockwise"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-list-task"></i>
                            </div>
                            <h4 class="empty-state-title">No Tasks Found</h4>
                            <p class="empty-state-text">You haven't created any tasks yet. Start by adding your first task!</p>
                            <a href="{{ route('userAddTask') }}" class="btn btn-theme">
                                <i class="bi bi-plus-circle me-2"></i>Create Your First Task
                            </a>
                        </div>
                    @endif
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
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(170, 210, 193, 0.3);
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        color: white;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        margin: 5px 0 0 0;
        opacity: 0.9;
        color: white;
    }

    .btn-theme {
        background: #2c5f54;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-theme:hover {
        background: #1a4a42;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(44, 95, 84, 0.3);
    }

    .stats-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.5rem;
    }

    .stats-content h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c5f54;
        margin: 0;
    }

    .stats-content p {
        color: #6c757d;
        margin: 0;
        font-size: 0.9rem;
    }

    .bg-primary { background: #007bff !important; }
    .bg-success { background: #28a745 !important; }
    .bg-warning { background: #ffc107 !important; }
    .bg-info { background: #17a2b8 !important; }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        background: white;
    }

    .card-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: none;
        padding: 1.5rem;
    }

    .badge-count {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8f9fa;
        border: none;
        font-weight: 600;
        color: #2c5f54;
        padding: 15px 10px;
    }

    .table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: rgba(170, 210, 193, 0.1);
        transform: translateY(-1px);
    }

    .table tbody td {
        padding: 15px 10px;
        vertical-align: middle;
        border: none;
    }

    .task-number {
        background: #aad2c1;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .task-title {
        font-weight: 600;
        color: #2c5f54;
        font-size: 1.1rem;
        margin-bottom: 2px;
    }

    .task-description {
        color: #6c757d;
        line-height: 1.4;
    }

    .deadline-date {
        color: #2c5f54;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .badge-pending {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .badge-completed {
        background: linear-gradient(135deg, #00b894, #00a085);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .badge-progress {
        background: linear-gradient(135deg, #fdcb6e, #e17055);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .btn-group .btn {
        margin: 0 2px;
        border-radius: 6px !important;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background: #007bff;
        color: white;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background: #dc3545;
        color: white;
    }

    .btn-outline-success {
        border-color: #28a745;
        color: #28a745;
    }

    .btn-outline-success:hover {
        background: #28a745;
        color: white;
    }

    .btn-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-outline-warning:hover {
        background: #ffc107;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #aad2c1;
        margin-bottom: 1rem;
    }

    .empty-state-title {
        color: #2c5f54;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        color: #6c757d;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

    .alert-success {
        background: #d1eddd;
        color: #2c5f54;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-section {
            padding: 1.5rem;
            text-align: center;
        }
        
        .btn-group {
            flex-direction: column;
        }
        
        .btn-group .btn {
            margin: 2px 0;
        }
        
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .stats-card {
            justify-content: center;
            text-align: center;
        }
        
        .stats-icon {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection
