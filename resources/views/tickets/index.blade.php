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
                            <a class="nav-link {{ request()->routeIs('tickets.index') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
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
                    <h2 class="mb-4">Tickets</h2>
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Add New Ticket</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Filter Form -->
                    <form id="filterForm" method="GET" action="{{ route('tickets.index') }}" class="mb-4">
                        <div class="card" style="border: none;box-shadow: none;">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <!-- Filter for Status -->
                                    <div class="col text-center">
                                        <label class="form-label"><strong>Status:  </strong></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="statusOpen" value="open" {{ request('status') == 'open' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusOpen">Open</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="statusResolved" value="resolved" {{ request('status') == 'resolved' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusResolved">Resolved</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="statusInProgress" value="in-progress" {{ request('status') == 'in-progress' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusInProgress">In Progress</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="statusClosed" value="closed" {{ request('status') == 'closed' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusClosed">Closed</label>
                                        </div>
                                    </div>

                                    <!-- Filter for Priority -->
                                    <div class="col text-center">
                                        <label class="form-label"><strong>Priority:  </strong></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="priority" id="priorityHigh" value="high" {{ request('priority') == 'high' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="priorityHigh">High</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="priority" id="priorityMedium" value="medium" {{ request('priority') == 'medium' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="priorityMedium">Medium</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="priority" id="priorityLow" value="low" {{ request('priority') == 'low' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="priorityLow">Low</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col text-end">
                                        <button type="button" class="btn btn-secondary" id="clearFilterBtn">Clear Filters</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Table Headers -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Assigned</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td><a href="{{ route('tickets.show', $ticket->id) }}"  class="text-dark text-decoration-none">{{ ucwords(strtolower($ticket->customer->name)) }}</a></td>
                                        <td>{{ ucwords(strtolower($ticket->title)) }}</td>
                                        <td>{{ ucwords(strtolower($ticket->status)) }}</td>
                                        <td>{{ ucwords(strtolower($ticket->priority)) }}</td>
                                        <td>{{ $ticket->user ? $ticket->user->name : 'Unassigned' }}</td>
                                        <td>
                                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        // Auto-submit the form when a filter option is changed
        document.querySelectorAll('input[name="status"], input[name="priority"]').forEach(function(input) {
            input.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });

        // Clear filters and reload the page
        document.getElementById('clearFilterBtn').addEventListener('click', function() {
            // Clear all radio buttons
            document.querySelectorAll('input[name="status"], input[name="priority"]').forEach(function(input) {
                input.checked = false;
            });
            
            // Submit the form with no filters
            document.getElementById('filterForm').submit();
        });
    </script>
</body>
</html>
