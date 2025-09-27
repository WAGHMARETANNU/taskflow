@extends('layouts.Guest')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="hero-section mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="hero-title">Completed Tasks</h1>
                        <p class="hero-subtitle">View all your accomplished tasks</p>
                    </div>
                    <div class="col-lg-4 text-lg-end text-center mt-3 mt-lg-0">
                        <div class="achievement-badge">
                            <i class="bi bi-trophy me-2"></i>
                            <span>{{ count($task_result) }} Tasks Completed</span>
                        </div>
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

            <!-- Completed Tasks Card -->
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">
                                <i class="bi bi-check-circle me-2"></i>Completed Tasks
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
                                        <th class="text-center">Completed Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($task_result as $index => $task)
                                        <tr class="completed-row">
                                            <td class="text-center">
                                                <span class="task-number completed">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="task-title completed">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    {{ $task->task_name }}
                                                </div>
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
                                                <span class="badge badge-completed">
                                                    <i class="bi bi-check-circle me-1"></i>{{ $task->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="completion-date">
                                                    {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                                </span>
                                                @if(\Carbon\Carbon::parse($task->deadline)->lt(\Carbon\Carbon::parse($task->created_at)))
                                                    <br><small class="text-success">Early completion!</small>
                                                @elseif(\Carbon\Carbon::parse($task->deadline)->gt(now()))
                                                    <br><small class="text-success">On time</small>
                                                @else
                                                    <br><small class="text-warning">Late completion</small>
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
                                                       onclick="return confirm('Are you sure you want to delete this completed task?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                    <a href="{{ route('userMarkPendingTask', $task->id) }}" 
                                                       class="btn btn-sm btn-outline-warning" 
                                                       title="Mark as Pending"
                                                       onclick="return confirm('Are you sure you want to mark this task as pending again?')">
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                    </a>
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
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <h4 class="empty-state-title">No Completed Tasks Yet</h4>
                            <p class="empty-state-text">You haven't completed any tasks yet. Start working on your tasks to see them here!</p>
                            <div class="empty-state-actions">
                                <a href="{{ route('userTaskList') }}" class="btn btn-theme me-2">
                                    <i class="bi bi-list-task me-2"></i>View All Tasks
                                </a>
                                <a href="{{ route('userAddTask') }}" class="btn btn-outline-success">
                                    <i class="bi bi-plus-circle me-2"></i>Add New Task
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Motivational Message -->
            @if(count($task_result) > 0)
                <div class="motivation-card mt-4">
                    <div class="motivation-content">
                        <div class="motivation-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="motivation-text">
                            <h5>Great Job!</h5>
                            <p>You've successfully completed {{ count($task_result) }} task{{ count($task_result) > 1 ? 's' : '' }}. Keep up the excellent work!</p>
                        </div>
                    </div>
                </div>
            @endif
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

    .achievement-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 25px;
        color: white;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

   .btn-theme {
    background: #7fb6a4;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-theme:hover {
    background: #6ca192;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(127, 182, 164, 0.3);
}


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

    .completed-row:hover {
        background: rgba(0, 184, 148, 0.1);
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

   .task-number.completed {
    background: #7fb6a4;
}

    .task-title {
        font-weight: 600;
        color: #2c5f54;
        font-size: 1.1rem;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
    }

   .task-title.completed {
    color: #7fb6a4;
}
    .task-description {
        color: #6c757d;
        line-height: 1.4;
    }

    .completion-date {
        color: #2c5f54;
        font-weight: 500;
        font-size: 0.95rem;
    }

   .badge-completed {
    background: linear-gradient(135deg, #aad2c1, #7fb6a4);
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

    .btn-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-outline-warning:hover {
        background: #ffc107;
        color: white;
    }

    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-success:hover {
        background: #28a745;
        color: white;
        transform: translateY(-1px);
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

   .motivation-card {
    background: linear-gradient(135deg, #aad2c1, #7fb6a4);
    border-radius: 15px;
    padding: 2rem;
    color: white;
    box-shadow: 0 4px 15px rgba(170, 210, 193, 0.3);
}

    .motivation-content {
        display: flex;
        align-items: center;
        text-align: left;
    }

    .motivation-icon {
        font-size: 3rem;
        margin-right: 1.5rem;
        opacity: 0.8;
    }

    .motivation-text h5 {
        margin: 0 0 0.5rem 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .motivation-text p {
        margin: 0;
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

   .alert-success {
    background: #e8f5f0;
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

        .achievement-badge {
            display: block;
            margin-top: 1rem;
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

        .motivation-content {
            flex-direction: column;
            text-align: center;
        }

        .motivation-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }
</style>
@endsection
