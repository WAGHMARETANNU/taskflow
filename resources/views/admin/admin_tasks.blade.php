@extends('layouts.Guest')


@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .tasks-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .card-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 15px 15px 0 0;
        border: none;
    }

    .task-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-completed {
        background: #d1eddd;
        color: #2c5f54;
    }

    .status-pending {
        background: #ffecb3;
        color: #8a6914;
    }

    .task-priority {
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .priority-high {
        background: #ffebee;
        color: #c62828;
    }

    .priority-medium {
        background: #fff3e0;
        color: #ef6c00;
    }

    .priority-low {
        background: #e8f5e8;
        color: #2e7d32;
    }
</style>

<div class="admin-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h3 mb-0">Task Management</h1>
                <p class="mb-0">View and manage all user tasks</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('adminDashboard') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Tasks Card -->
    <div class="tasks-card">
        <div class="card-header">
            <h4 class="mb-0">
                <i class="bi bi-list-task me-2"></i>All Tasks ({{ $tasks->total() ?? count($tasks) }})
            </h4>
        </div>
        <div class="card-body p-0">
            @if($tasks->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-list-task fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No tasks found</h5>
                    <p class="text-muted">No tasks have been created yet.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>
                                    <strong>{{ $task->task_name }}</strong>
                                </td>
                                <td>
                                    <div style="max-width: 200px;">
                                        {{ Str::limit($task->task_description, 50) }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $task->user_name ?? 'Unknown' }}</strong><br>
                                        <small class="text-muted">{{ $task->user_email ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="task-status {{ $task->status === 'Completed' ? 'status-completed' : 'status-pending' }}">
                                        <i class="bi bi-{{ $task->status === 'Completed' ? 'check-circle' : 'clock' }} me-1"></i>
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($task->deadline)
                                        <small>{{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</small>
                                        @if(\Carbon\Carbon::parse($task->deadline)->isPast() && $task->status !== 'Completed')
                                            <br><span class="badge bg-danger">Overdue</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No deadline</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($tasks, 'links'))
                    <div class="d-flex justify-content-center p-3">
                        {{ $tasks->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
