<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #eceff1; /* Light background */
            font-family: 'Roboto', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #ff5252; /* Red header */
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #607d8b; /* Blue Grey */
            color: white;
            text-transform: uppercase;
        }
        tr {
            transition: background-color 0.3s;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1; /* Light grey for even rows */
        }
        tr:hover {
            background-color: #e0e0e0; /* Darker grey for hover */
        }
        @media (max-width: 768px) {
            th, td {
                display: block;
                text-align: right;
                padding: 10px;
            }
            th::before, td::before {
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            th::before {
                content: attr(data-title);
            }
            td::before {
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-container">
            <div class="header">Room Details</div>
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th data-title="Room Title">Room Title</th>
                        <th data-title="Description">Description</th>
                        <th data-title="Price">Price</th>
                        <th data-title="Wifi">Wifi</th>
                        <th data-title="Room Type">Room Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td data-label="Room Title">{{$data->room_title}}</td>
                        <td data-label="Description">{{$data->description}}</td>
                        <td data-label="Price">{{$data->price}}</td>
                        <td data-label="Wifi">{{$data->wifi}}</td>
                        <td data-label="Room Type">{{$data->room_type}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
