@extends('layouts.Guest')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="hero-section mb-4">
                <h1 class="text-center mb-2">Edit Task</h1>
                <p class="text-center text-muted">Access your tasks and stay organized.</p>
                @if ($task)
                    <div class="text-center">
                        <small class="current-task">Currently editing: <strong>{{ $task->task_name }}</strong></small>
                    </div>
                @endif
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

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Edit Task Card -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-pencil-square me-2"></i>Update Task Details
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('userEditTaskAction', $task->id) }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Task Title -->
                                        <div class="mb-4">
                                            <label for="task_title" class="form-label">
                                                <i class="bi bi-card-text me-2"></i>Task Title *
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('task_title') is-invalid @enderror" 
                                                   id="task_title"
                                                   name="task_title" 
                                                   placeholder="Enter task title"
                                                   value="{{ old('task_title', $task->task_name) }}"
                                                   required>
                                            @error('task_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Task Description -->
                                        <div class="mb-4">
                                            <label for="task_description" class="form-label">
                                                <i class="bi bi-journal-text me-2"></i>Description *
                                            </label>
                                            <textarea class="form-control @error('task_description') is-invalid @enderror" 
                                                      id="task_description"
                                                      name="task_description" 
                                                      rows="4"
                                                      placeholder="Enter task description"
                                                      required>{{ old('task_description', trim($task->task_description)) }}</textarea>
                                            @error('task_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Task Status -->
                                        <div class="mb-4">
                                            <label for="task_status" class="form-label">
                                                <i class="bi bi-flag me-2"></i>Status *
                                            </label>
                                            <select class="form-select @error('task_status') is-invalid @enderror" 
                                                    id="task_status"
                                                    name="task_status" 
                                                    required>
                                                <option value="">Select Status</option>
                                                <option value="Pending" {{ old('task_status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="In Progress" {{ old('task_status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Completed" {{ old('task_status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                            @error('task_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Due Date -->
                                        <div class="mb-4">
                                            <label for="task_due_date" class="form-label">
                                                <i class="bi bi-calendar me-2"></i>Due Date *
                                            </label>
                                            <input type="date" 
                                                   class="form-control @error('task_due_date') is-invalid @enderror" 
                                                   id="task_due_date"
                                                   name="task_due_date" 
                                                   value="{{ old('task_due_date', $task->deadline) }}"
                                                   required>
                                            @error('task_due_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Task Info -->
                                        <div class="task-info">
                                            <h6><i class="bi bi-info-circle me-2"></i>Task Information</h6>
                                            <small class="text-muted">
                                                <strong>Created:</strong> {{ $task->created_at->format('M d, Y') }}<br>
                                                <strong>Last Updated:</strong> {{ $task->updated_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button type="submit" class="btn btn-theme btn-lg me-md-2">
                                                <i class="bi bi-check-circle me-2"></i>Update Task
                                            </button>
                                            <a href="{{ route('userTaskList') }}" class="btn btn-outline-secondary btn-lg me-md-2">
                                                <i class="bi bi-list me-2"></i>My Tasks
                                            </a>
                                            <a href="{{ route('userDashboard') }}" class="btn btn-outline-success btn-lg">
                                                <i class="bi bi-arrow-left me-2"></i>Dashboard
                                            </a>
                                        </div>
                                    </div>
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

    .hero-section {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(170, 210, 193, 0.3);
    }

    .hero-section h1 {
        font-size: 2.5rem;
        margin: 0 0 10px 0;
        font-weight: 600;
    }

    .hero-section p {
        margin: 0 0 10px 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .current-task {
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        background: white;
    }

    .card-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: none;
        padding: 1.5rem;
        text-align: center;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c5f54;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
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

    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.7;
    }

    .btn-theme {
        background: #2c5f54;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        min-width: 150px;
    }

    .btn-theme:hover {
        background: #1a4a42;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(44, 95, 84, 0.3);
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        min-width: 150px;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
        transform: translateY(-1px);
    }

    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        min-width: 150px;
    }

    .btn-outline-success:hover {
        background: #28a745;
        border-color: #28a745;
        color: white;
        transform: translateY(-1px);
    }

    .alert {
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 1.5rem;
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

    .task-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #aad2c1;
        margin-top: 1rem;
    }

    .task-info h6 {
        color: #2c5f54;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    /* Form validation states */
    .is-invalid {
        border-color: #dc3545 !important;
    }

    .is-valid {
        border-color: #28a745 !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 1.5rem;
            text-align: center;
        }
        
        .hero-section h1 {
            font-size: 2rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn-theme, 
        .btn-outline-secondary,
        .btn-outline-success {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .d-grid.gap-2.d-md-flex {
            gap: 0.5rem !important;
        }
    }

    /* Focus indicators for accessibility */
    .form-control:focus,
    .form-select:focus,
    .btn:focus {
        outline: 2px solid #aad2c1;
        outline-offset: 2px;
    }

    /* Animation for form submission */
    .btn-theme:active {
        transform: translateY(0);
    }

    /* Custom date input styling */
    input[type="date"] {
        position: relative;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        background: #aad2c1;
        color: white;
        border-radius: 3px;
        padding: 2px;
    }
</style>

<script>
    // Auto-focus on first input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('task_title').focus();
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const title = document.getElementById('task_title').value.trim();
        const description = document.getElementById('task_description').value.trim();
        const status = document.getElementById('task_status').value;
        const dueDate = document.getElementById('task_due_date').value;
        
        if (!title || !description || !status || !dueDate) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
    });

    // Character count for description
    const descriptionField = document.getElementById('task_description');
    descriptionField.addEventListener('input', function() {
        const maxLength = 500;
        const currentLength = this.value.length;
        
        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }
    });

    // Confirmation for navigation
    let formChanged = false;
    document.querySelectorAll('input, textarea, select').forEach(function(element) {
        element.addEventListener('change', function() {
            formChanged = true;
        });
    });

    document.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (formChanged && !confirm('You have unsaved changes. Are you sure you want to leave?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
