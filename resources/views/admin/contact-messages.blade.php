@extends('layouts.Guest')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .messages-card {
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

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        margin: 0.125rem;
    }

    .btn-success {
        background: #28a745;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .btn-danger {
        background: #dc3545;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .message-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-read {
        background: #d1eddd;
        color: #2c5f54;
    }

    .status-unread {
        background: #fff3cd;
        color: #856404;
    }

    .action-buttons {
        display: flex;
        gap: 0.25rem;
        flex-wrap: wrap;
    }
</style>

<div class="admin-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h3 mb-0">Contact Messages</h1>
                <p class="mb-0">Manage customer inquiries and feedback</p>
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

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h3 class="text-primary">{{ $totalMessages ?? 0 }}</h3>
                    <p class="card-text">TOTAL MESSAGES</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h3 class="text-warning">{{ $unreadMessages ?? 0 }}</h3>
                    <p class="card-text">UNREAD MESSAGES</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Card -->
    <div class="messages-card">
        <div class="card-header">
            <h4 class="mb-0">
                <i class="bi bi-envelope me-2"></i>All Contact Messages
            </h4>
        </div>
        <div class="card-body p-0">
            @if($messages->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-envelope fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No messages found</h5>
                    <p class="text-muted">No contact messages have been received yet.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                            <tr class="{{ $message->read_at ? '' : 'table-warning' }}">
                                <td>{{ $message->id }}</td>
                                <td>
                                    <strong>{{ $message->name }}</strong>
                                </td>
                                <td>
                                    <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                        {{ $message->email }}
                                    </a>
                                </td>
                                <td>
                                    <strong>{{ $message->subject }}</strong>
                                </td>
                                <td>
                                    <div style="max-width: 200px;">
                                        {{ Str::limit($message->message, 50) }}
                                        @if(strlen($message->message) > 50)
                                            <button class="btn btn-link btn-sm p-0" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#messageModal{{ $message->id }}">
                                                Read more...
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <small>{{ \Carbon\Carbon::parse($message->created_at)->format('M d, Y') }}</small><br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($message->created_at)->format('h:i A') }}</small>
                                </td>
                                <td>
                                    @if($message->read_at)
                                        <span class="message-status status-read">
                                            <i class="bi bi-check-circle me-1"></i>Read
                                        </span>
                                    @else
                                        <span class="message-status status-unread">
                                            <i class="bi bi-circle me-1"></i>New
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if(!$message->read_at)
                                            <form action="{{ route('admin.markMessageRead', $message->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Mark as Read">
                                                    <i class="bi bi-check-circle me-1"></i>Mark Read
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.deleteMessage', $message->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.');" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Message">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Message Modal -->
                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Message from {{ $message->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Subject:</strong> {{ $message->subject }}</p>
                                            <p><strong>Email:</strong> {{ $message->email }}</p>
                                            <p><strong>Message:</strong></p>
                                            <p>{{ $message->message }}</p>
                                            <p><strong>Received:</strong> {{ \Carbon\Carbon::parse($message->created_at)->format('M d, Y h:i A') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                                               class="btn btn-primary">
                                                <i class="bi bi-envelope me-1"></i>Reply via Email
                                            </a>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($messages, 'links'))
                    <div class="d-flex justify-content-center p-3">
                        {{ $messages->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
