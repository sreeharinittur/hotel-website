<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">KAMATH RESIDENCY</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ route('mybookings') }}">My Bookings</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 class="center-align">My Bookings</h1>
        <div class="row">
            @foreach($userBookings as $booking)
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Booking ID: {{ $booking->id }}</span>
                        <p>Room Name: {{ $booking->room->room_title }}</p>
                        <p>Start Date: {{ $booking->start_date }}</p>
                        <p>End Date: {{ $booking->end_date }}</p>
                        
                        <!-- Add more booking details here -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
