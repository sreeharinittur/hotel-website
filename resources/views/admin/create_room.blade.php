<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f8f8; /* Light Beige */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .input-field label {
            color: #333;
            font-size: 1rem;
        }
        .input-field input[type="text"], 
        .input-field input[type="email"], 
        .input-field input[type="number"], 
        .input-field select {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }
        .input-field input[type="file"] {
            padding: 10px;
            width: calc(100% - 20px); /* Subtract padding from width */
        }
        .btn {
            background-color: #2196F3; /* Blue */
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0d8bf5; /* Darker blue on hover */
        }
        .progress {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="center-align">Add Room</h3>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="progress">
            <div class="determinate" style="width: 0%"></div>
        </div>
        <form id="roomForm" action="{{ url('add_room') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-field">
                <label for="title">Room Title</label>
                <input type="text" id="title" name="title" required>
                <span class="helper-text" data-error="Title is required"></span>
            </div>
            <div class="input-field">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required>
                <span class="helper-text" data-error="Description is required"></span>
            </div>
            <div class="input-field">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" required>
                <span class="helper-text" data-error="Price is required"></span>
            </div>
            <div class="input-field">
                <select id="wifi" name="wifi" required>
                    <option value="" disabled selected>Select Wifi</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label for="wifi">Wifi</label>
            </div>
            <div class="input-field">
                <select id="type" name="type" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="regular">Regular</option>
                    <option value="premium">Premium</option>
                    <option value="deluxe">Deluxe</option>
                </select>
                <label for="type">Room Type</label>
            </div>
            <div class="input-field">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Upload Images</span>
                        <input type="file" name="images[]" multiple accept="image/*" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload one or more images">
                    </div>
                </div>
            </div>
            <button id="submitBtn" type="submit" class="btn" disabled>Create Room</button>
        </form>
    </div>

    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);

            var form = document.getElementById('roomForm');
            var submitBtn = document.getElementById('submitBtn');

            form.addEventListener('input', function() {
                var isValid = form.checkValidity();
                submitBtn.disabled = !isValid;
            });

            var progressBar = document.querySelector('.progress .determinate');
            form.addEventListener('submit', function() {
                var progress = 0;
                var interval = setInterval(function() {
                    progress += 5;
                    progressBar.style.width = progress + '%';
                    if (progress >= 100) {
                        clearInterval(interval);
                    }
                }, 100);
            });
        });
    </script>
</body>
</html>
