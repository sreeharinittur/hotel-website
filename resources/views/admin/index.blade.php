<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Google Fonts and Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body, html {
            height: 100%;
        }
        .brand-logo {
            font-weight: bold;
        }
        .brand-big {
            font-size: 1.5rem;
        }
        .brand-sm {
            font-size: 1rem;
        }
        .sidebar {
            height: 100vh;
        }
        .sidebar .user-view .name,
        .sidebar .user-view .email {
            display: block;
            margin-top: 5px;
        }
        .sidebar .collapsible-header i {
            margin-right: 15px;
        }
        .logout {
            cursor: pointer;
            color: white;
        }
        .nav-wrapper .brand-logo.center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .main-content {
            margin-left: 300px;
            padding: 20px;
        }
        .navbar-nav .nav-item .nav-link {
            color: #333;
            font-weight: 500;
            padding: 10px 15px;
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #007bff;
        }
        .navbar-nav .dropdown-menu {
            border-radius: 0;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .navbar-nav .dropdown-item {
            color: #333;
            font-weight: 500;
            padding: 10px 20px;
        }
        .navbar-nav .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper red darken-4">
                <a href="#" class="brand-logo center">CONTROL DESK</a>
                <ul class="right">
                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}" class="logout" @click.prevent="$root.submit();">
                                <i class="material-icons">exit_to_app</i> Log Out
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <ul id="slide-out" class="sidenav sidenav-fixed sidebar blue-grey darken-3">
        <!-- Sidebar Content Here -->
    </ul>

    <main class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Hotel Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRooms" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Rooms
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownRooms">
                            <a class="dropdown-item" href="{{url('view_rooms')}}">View Rooms</a>
                            <a class="dropdown-item" href="{{url('create_room')}}">Add Rooms</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('mybookings')}}">Booking</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Your main content goes here -->
    </main>

    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);

            var collapsibleElems = document.querySelectorAll('.collapsible');
            var collapsibleInstances = M.Collapsible.init(collapsibleElems);
        });
    </script>
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
