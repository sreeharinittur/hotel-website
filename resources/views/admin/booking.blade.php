<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .delete-icon {
            color: red;
            cursor: pointer;
        }
        .table-container {
            margin-top: 50px;
        }
        .approve {
            color: white;
            background-color: green;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        
        .reject {
            color: white;
            background-color: red;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .approve:hover {
            background-color: darkgreen;
        }

        .reject:hover {
            background-color: darkred;
        }
        /* Styles for the animated bin */
        #bin {
            position: fixed;
            bottom: -100px;
            right: 20px;
            font-size: 48px;
            color:red;
            transition: bottom 0.5s ease;
        }

        #bin.show {
            bottom: 20px;
        }

        .deleted-row {
            animation: move-to-bin 1s forwards;
        }

        @keyframes move-to-bin {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(500px);
                opacity: 0;
            }
        }

    </style>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">KAMATH RESIDENCY</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ route('mybookings') }}">My Bookings</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container table-container">
        <h4 class="center-align">Bookings' List</h4>
        <table class="striped centered">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Arrival Date</th>
                    <th>Departure Date</th>
                    <th>Status</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Delete</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $data)
                <tr>
                    <td>{{ $data->room_id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->start_date }}</td>
                    <td>{{ $data->end_date }}</td>
                    

                    <td>
                    @if($data->status=="approved")
                    <span style="color:green">approved</span>
                    @endif
                    @if($data->status=="rejected")
                    <span style="color:red">rejected</span>
                    @endif
                    

                    </td>
                    <td>{{ $data->room->room_title }}</td>
                    <td>{{ $data->room->price }}</td>
                    <td>
                        <a href="{{ url('delete_bookings', $data->id) }}" onclick="return confirm('Are you sure to delete?');"  class="delete-trigger">
                            <i class="material-icons delete-icon">delete</i>
                        </a>
                    </td>
                    <td>
                    <a href="{{url('approve_book',$data->id)}}" class="approve">Approve</a><br><br>
                    <a href="{{url('reject_book',$data->id)}}" class="reject">Reject</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <i id="bin" class="material-icons">delete</i>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bin = document.getElementById('bin');

            document.querySelectorAll('.delete-trigger').forEach(trigger => {
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();
                    const row = this.closest('tr');
                    bin.classList.add('show');

                    row.classList.add('deleted-row');
                    setTimeout(() => {
                        bin.classList.remove('show');
                        // Perform the actual deletion after the animation
                        window.location.href = this.href;
                    }, 1000);
                });
            });
        });
    </script>
</body>
</html>
