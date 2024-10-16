<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
                            <a class="nav-link {{ request()->routeIs('tickets.index', 'tickets.show') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
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
                <div class="pt-3 pb-2 mb-3">
                    <div class="container mt-4">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h2 class="mb-4">Report Generation</h2>

                        <form action="{{ route('reports.generate') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer:</label>
                                <select name="customer_id" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ ucwords(strtolower($customer->name)) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="datefrom" class="form-label">Date From:</label>
                                <input type="date" name="datefrom" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="dateto" class="form-label">Date To:</label>
                                <input type="date" name="dateto" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" class="form-select">
                                    <option value="">All</option>
                                    <option value="open">Open</option>
                                    <option value="in progress">In Progress</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="format" class="form-label">Format:</label>
                                <select name="format" class="form-select" required>
                                    <option value="csv">CSV</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </form>
            
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>