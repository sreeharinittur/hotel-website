<!DOCTYPE html>
<html>
<head>
    <title>Show Rooms</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        nav {
            margin-bottom: 50px;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-image img {
            height: 400px;
            object-fit: cover;
        }
        .no-images {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
            font-size: 1.2rem;
            color: #888;
        }
        h2 {
            margin-bottom: 40px;
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .btn-details {
            background-color: #007bff !important;
            color: #fff !important;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-details:hover {
            background-color: #0056b3 !important;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-wrapper blue darken-3">
            <div class="container">
                
                <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Rooms</a></li>
                    <li><a href="#">Bookings</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <ul class="sidenav" id="mobile-nav">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Rooms</a></li>
        <li><a href="#">Bookings</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Logout</a></li>
    </ul>

    <div class="container">
        <h2>Rooms</h2>
        <div class="row">
            @foreach($rooms as $room)
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="card-image">
                            <div class="carousel carousel-slider">
                                @if($room->images->count() > 0)
                                    @foreach($room->images as $image)
                                        <a class="carousel-item">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Room Image">
                                        </a>
                                    @endforeach
                                @else
                                    <div class="no-images">No images available for this room.</div>
                                @endif
                            </div>
                        </div>
                        <div class="card-content">
                            <span class="card-title">{{ $room->room_title }}</span>
                            <p><strong>Description:</strong> {{ $room->description }}</p>
                            <p><strong>Price:</strong> ${{ $room->price }}</p>
                            <p><strong>Wifi:</strong> {{ $room->wifi ? 'Yes' : 'No' }}</p>
                            <p><strong>Room Type:</strong> {{ ucfirst($room->room_type) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{url('room_details',$room->id)}}" class="btn btn-details">Room Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
            
            var elemsCarousel = document.querySelectorAll('.carousel');
            var instancesCarousel = M.Carousel.init(elemsCarousel, {
                fullWidth: true,
                indicators: true
            });
        });
    </script>
</body>
</html>
