@extends('layouts.Guest')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #aad2c1 0%, #7fb6a4 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .users-card {
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

    .btn-danger {
        background: #dc3545;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .btn-warning {
        background: #ffc107;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: all 0.3s ease;
        color: #212529;
    }

    .btn-warning:hover {
        background: #e0a800;
        transform: translateY(-1px);
    }

    .btn-success {
        background: #28a745;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #2c5f54;
        border: none;
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-active {
        background: #d1eddd;
        color: #2c5f54;
    }

    .status-inactive {
        background: #f8d7da;
        color: #721c24;
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
                <h1 class="h3 mb-0">User Management</h1>
                <p class="mb-0">Manage all registered users</p>
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

    <!-- Users Card -->
    <div class="users-card">
        <div class="card-header">
            <h4 class="mb-0">
                <i class="bi bi-people me-2"></i>All Registered Users ({{ $users->total() ?? count($users) }})
            </h4>
        </div>
        <div class="card-body p-0">
            @if($users->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-people fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No users found</h5>
                    <p class="text-muted">No users have registered yet.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if($user->profile_picture && file_exists(public_path('images/profile_pictures/' . $user->profile_picture)))
                                        <img src="{{ asset('images/profile_pictures/' . $user->profile_picture) }}" 
                                             alt="Profile" class="profile-img">
                                    @else
                                        <div class="profile-img bg-secondary d-flex align-items-center justify-content-center text-white">
                                            {{ strtoupper(substr($user->fname, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $user->fname }}</strong>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile ?? 'N/A' }}</td>
                                <td>
                                    <span class="user-status {{ $user->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                                        <i class="bi bi-{{ $user->status === 'Active' ? 'check-circle' : 'x-circle' }} me-1"></i>
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td>
                                    <small>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Status Toggle Button -->
                                        @if($user->status === 'Active')
                                            <form action="{{ route('admin.toggleUserStatus', $user->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to deactivate {{ $user->fname }}?');" 
                                                  style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="Inactive">
                                                <button type="submit" class="btn btn-warning btn-sm" title="Deactivate User">
                                                    <i class="bi bi-pause-circle me-1"></i>Deactivate
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.toggleUserStatus', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="Active">
                                                <button type="submit" class="btn btn-success btn-sm" title="Activate User">
                                                    <i class="bi bi-play-circle me-1"></i>Activate
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('adminDeleteUser', $user->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete {{ $user->fname }}? This action cannot be undone.');" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete User">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($users, 'links'))
                    <div class="d-flex justify-content-center p-3">
                        {{ $users->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
