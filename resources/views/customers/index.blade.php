<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
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
                            <a class="nav-link active" href="{{route('customers.index')}}">
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
                    <h2 class="mb-4">Customers</h2>
                    <a href="{{route('customers.create')}}" class="btn btn-primary mb-3">Add New Customer</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive pt-3 rounded">
                        <table class="table table-striped table-hover" id="customer-table">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="5">
                                        <form action="{{ route('customers.index') }}" method="GET" class="d-flex">
                                            <input type="text" id="search-input" name="search" class="form-control" placeholder="Search Customer Name" value="{{ request()->query('search') }}">
                                            <button type="submit" class="btn btn-primary ms-2">Search</button>
                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                <th style="width: 25%;">Name</th>
                                <th style="width: 25%;">Email</th>
                                <th style="width: 15%;">Phone Number</th>
                                <th style="width: 20%;">Address</th>
                                <th style="width: 15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td><a href="{{route('customers.show', $customer)}}" class="text-dark text-decoration-none" >{{ ucwords(strtolower($customer->name)) }}</a></td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ ucwords(strtolower($customer->address)) }}</td>
                                        <td>
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <script src="{{ asset('js/search.js') }}"></script>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
