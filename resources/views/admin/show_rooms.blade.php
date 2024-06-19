<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Rooms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .navbar {
            margin-bottom: 50px;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.75rem;
            font-weight: 500;
        }
        .card-text {
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .carousel-inner img {
            border-radius: 15px 15px 0 0;
            height: 400px;
            object-fit: cover;
        }
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }
        .no-images {
            text-align: center;
            font-size: 1.2rem;
            color: #888;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h2 {
            margin-bottom: 40px;
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .details-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Hotel Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Rooms</h2>
        <div class="row">
            @foreach($rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div id="carousel{{ $room->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @if($room->images->count() > 0)
                            @foreach($room->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Room Image">
                            </div>
                            @endforeach
                            @else
                            <div class="carousel-item active">
                                <div class="no-images">No images available for this room.</div>
                            </div>
                            @endif
                        </div>
                        @if($room->images->count() > 0)
                        <a class="carousel-control-prev" href="#carousel{{ $room->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $room->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->room_title }}</h5>
                        <p class="card-text"><strong>Description:</strong> {{ $room->description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $room->price }}</p>
                        <p class="card-text"><strong>Wifi:</strong> {{ $room->wifi ? 'Yes' : 'No' }}</p>
                        <p class="card-text"><strong>Room Type:</strong> {{ ucfirst($room->room_type) }}</p>
                        <a href="/room_details/{{ $room->id }}" class="btn btn-primary details-btn">Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
