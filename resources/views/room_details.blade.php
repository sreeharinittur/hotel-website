<!DOCTYPE html>
<html>
<head>
    <title>Room Details</title>
     
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }
        .carousel-inner img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
        }
        .btn-book {
            background-color: #28a745;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-book:hover {
            background-color: #218838;
            color: white;
        }
        .card {
            margin-top: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .room-info {
            padding: 20px;
        }
        .room-info h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .room-info p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .form-container {
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-container label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="number"],
        .form-container input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .form-container input[type="text"]:focus,
        .form-container input[type="email"]:focus,
        .form-container input[type="number"]:focus,
        .form-container input[type="date"]:focus {
            border-color: #28a745;
            outline: none;
        }
        .alert {
            margin-top: 20px;
        }
        .no-images {
            text-align: center;
            padding: 50px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $room->room_title }}</h2>
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
                        <div class="room-info">
                            <p><strong>Description:</strong> {{ $room->description }}</p>
                            <p><strong>Price:</strong> ${{ $room->price }}</p>
                            <p><strong>Wifi:</strong> {{ $room->wifi ? 'Yes' : 'No' }}</p>
                            <p><strong>Room Type:</strong> {{ ucfirst($room->room_type) }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-container">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{session()->get('message')}}
                                </div>
                            @endif

                            @if($errors)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form action="{{url('add_booking',$room->id)}}" method="Post">
                                @csrf
                                <div>
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" required value="{{ Auth::check() ? Auth::user()->name : old('name') }}">
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                                </div>
                                <div>
                                    <label for="phone">Phone</label>
                                    <input type="number" id="phone" name="phone" required value="{{ Auth::check() ? Auth::user()->phone : old('phone') }}">
                                </div>
                                <div>
                                    <label for="startDate">Start Date</label>
                                    <input type="date" id="startDate" name="startDate" required>
                                </div>
                                <div>
                                    <label for="endDate">End Date</label>
                                    <input type="date" id="endDate" name="endDate" required>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-book" value="Book Now">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if(month < 10) month = '0' + month.toString();
        if(day < 10) day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#startDate').attr('min', maxDate);
        $('#endDate').attr('min', maxDate);

        $('#startDate').on('change', function() {
            var startDate = new Date($(this).val());
            startDate.setDate(startDate.getDate() + 1);

            var month = startDate.getMonth() + 1;
            var day = startDate.getDate();
            var year = startDate.getFullYear();

            if(month < 10) month = '0' + month.toString();
            if(day < 10) day = '0' + day.toString();

            var minEndDate = year + '-' + month + '-' + day;
            $('#endDate').attr('min', minEndDate);
        });
    });
</script>
</body>
</html>
