<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid pt-3 ps-4 pb-0">
            <a class="navbar-brand ps-4" href="#"><h4>ClientConnect</h4></a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Sidebar and content area -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar ps-4 pt-0">
                <div class="position-sticky">
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-grid-fill"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('customers.index') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                <i class="bi bi-people-fill"></i> Customer Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('interactions.index') ? 'active' : '' }}" href="{{ route('interactions.index') }}">
                                <i class="bi bi-interaction"></i> Interaction Tracking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tickets.index', 'tickets.create', 'tickets.edit') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
                                <i class="bi bi-ticket-fill"></i> Helpdesk Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                <i class="bi bi-ticket-fill"></i> Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 container mt-4">
                    <h2 class="mb-4">Update Ticket</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Customer:</label>
                            <p>{{ ucwords(strtoupper($ticket->customer->name)) }}</p>
                            <input type="hidden" name="customer_id" value="{{ $ticket->customer->id }}">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $ticket->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" required>{{ old('description', $ticket->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" class="form-select" required>
                                <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in progress" {{ old('status', $ticket->status) == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ old('status', $ticket->status) == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority:</label>
                            <select name="priority" class="form-select" required>
                                <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Assigned To:</label>
                            <select name="user_id" class="form-select">
                                <option value="">Unassigned</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($ticket->user_id == $user->id) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Ticket</button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary ms-2">Back to Ticket List</a>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>