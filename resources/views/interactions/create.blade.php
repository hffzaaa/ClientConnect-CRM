<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interaction Tracking</title>
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
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class="bi bi-grid-fill"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('customers.index')}}">
                                <i class="bi bi-people-fill"></i> Customer Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('interactions.index')}}">
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
                    <h2 class="mb-4">Log Interaction</h2>
                    <form action="{{ route('interactions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Customer:</label>
                            <select name="customer_id" class="form-select" required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ ucwords(strtoupper($customer->name)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date_time" class="form-label">Date and Time:</label>
                            <input type="datetime-local" name="date_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="typeinteraction" class="form-label">Type of Interaction:</label>
                            <select name="typeinteraction" class="form-select" required>
                                <option value="meeting">Meeting</option>
                                <option value="call">Call</option>
                                <option value="email">Email</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes:</label>
                            <textarea name="notes" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Log Interaction</button>
                        <a href="{{ route('interactions.index') }}" class="btn btn-secondary ms-2">Back to Interactions</a>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>