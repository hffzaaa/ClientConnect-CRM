<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                            <a class="nav-link active" href="{{route('dashboard')}}">
                                <i class="bi bi-grid-fill"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('customers.index')}}">
                                <i class="bi bi-people-fill"></i> Customer Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('interactions.index')}}">
                                <i class="bi bi-interaction"></i> Interaction Tracking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tickets.index')}}">
                                <i class="bi bi-ticket-fill"></i> Helpdesk Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('reports.index')}}">
                                <i class="bi bi-ticket-fill"></i> Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 container mt-4">
                    <h2 class="mb-4">Welcome {{ Auth::user()->name }},</h2>

                    <div class="row">
                        <!-- Total Customers -->
                        <div class="col-md-6 mb-6">
                            <div class="card text-center">
                                <div class="card-header">
                                    Total Customers
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalCust }}</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Follow-Ups -->
                        <div class="col-md-6 mb-6">
                            <div class="card text-center">
                                <div class="card-header">
                                    Pending Follow-Ups
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pending }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <!-- Active Tickets Chart on the left -->
                    <div class="col-md-6 mb-6">
                        <div class="card">
                            <div class="card-header text-center">
                                Active Tickets
                            </div>
                            <div class="card-body">
                                <canvas id="pie" width="400" height="200"></canvas>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script src="{{ asset('resources/js/pie.js') }}"></script>
                                <script>
                                    const ticketinfo = @json($ticketinfo); // Pass PHP data to JS
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Interactions and User Activity Stats stacked on the right -->
                    <div class="col-md-6">
                        <!-- Recent Interactions -->
                        <div class="card mb-4">
                            <div class="card-header text-center">
                                Recent Interactions
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($recent as $interaction)
                                        <li class="list-group-item">
                                                {{ ucwords($interaction->customer->name) }}- {{ $interaction->created_at->format('d M Y H:i') }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- User Activity Stats -->
                        <div class="card">
                            <div class="card-header text-center">
                                User Activity Stats
                            </div>
                            <div class="card-body">
                                <canvas id="bar" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script>
                var createdTickets = {{ $createdTickets }};
                var resolvedTickets = {{ $resolvedTickets }};
                var interactedTickets = {{ $interactedTickets }};
            </script>
            <script src="{{ asset('js/pie.js') }}"></script>
            <script src="{{ asset('js/bar.js') }}"></script>
        </div>
    </div>
</body>
</html>
