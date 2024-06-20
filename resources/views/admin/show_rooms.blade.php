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
        .booking-form-wrapper {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 30px;
        }
        .booking-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .date-input-group {
            display: flex;
            flex-direction: column;
            margin-right: 15px;
        }
        .date-input-group:last-child {
            margin-right: 0;
        }
        .date-input-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }
        .datepicker {
            width: 200px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .datepicker:focus {
            border-color: #5151e5;
            box-shadow: 0 0 5px rgba(81, 81, 229, 0.5);
            outline: none;
        }
        .availability-button {
            background: #5151e5;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .availability-button:hover {
            background: #4343c5;
        }
        .hidden {
            display: none;
        }
        #rooms-wrapper {
            margin-top: 30px;
        }
        #rooms-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .room-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 10px;
            padding: 20px;
            text-align: left;
        }
        .room-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .room-card p {
            font-size: 14px;
            color: #666;
        }
        .room-card span {
            font-weight: bold;
            color: #333;
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
        
        <div class="booking-form-wrapper">
            <form class="booking-form" id="booking-form" action="{{ route('checkAvailability') }}" method="POST">
                @csrf
                <div class="date-input-group">
                    <label for="checkin">Check-in Date:</label>
                    <input type="date" id="checkin" name="checkin" class="datepicker">
                </div>
                <div class="date-input-group">
                    <label for="checkout">Check-out Date:</label>
                    <input type="date" id="checkout" name="checkout" class="datepicker">
                </div>
                <button type="submit" class="availability-button" id="check-availability">Check Availability</button>
            </form>
        </div>

        <div id="rooms-wrapper" class="hidden">
            <div id="rooms-container"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const checkAvailabilityRoute = '{{ route("checkAvailability") }}';
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(form);
            const response = await fetch(checkAvailabilityRoute, 
            {
    method: 'POST',
    body: formData
             });

            if (response.ok) {
                const data = await response.json();
                console.log(data); 
                displayAvailableRooms(data);
            } else {
                alert('Error checking availability. Please try again.');
            }
        });

        function displayAvailableRooms(rooms) {
    const roomsContainer = document.getElementById('rooms-container');
    roomsContainer.innerHTML = '';

    rooms.forEach(room => {
        const roomCard = document.createElement('div');
        roomCard.classList.add('room-card');

        const carousel = document.createElement('div');
        carousel.classList.add('carousel', 'slide');
        carousel.setAttribute('data-ride', 'carousel');
        carousel.id = `carousel-${room.id}`;

        const carouselInner = document.createElement('div');
        carouselInner.classList.add('carousel-inner');

        if (room.images && room.images.length > 0) {
            room.images.forEach((image, index) => {
                const carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');
                if (index === 0) carouselItem.classList.add('active');

                const img = document.createElement('img');
                img.src = image.image_path;
                img.classList.add('d-block', 'w-100');

                carouselItem.appendChild(img);
                carouselInner.appendChild(carouselItem);
            });

            carousel.appendChild(carouselInner);

            const prevButton = document.createElement('a');
            prevButton.classList.add('carousel-control-prev');
            prevButton.href = `#carousel-${room.id}`;
            prevButton.setAttribute('role', 'button');
            prevButton.setAttribute('data-slide', 'prev');
            prevButton.innerHTML = `<span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>`;

            const nextButton = document.createElement('a');
            nextButton.classList.add('carousel-control-next');
            nextButton.href = `#carousel-${room.id}`;
            nextButton.setAttribute('role', 'button');
            nextButton.setAttribute('data-slide', 'next');
            nextButton.innerHTML = `<span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>`;

            carousel.appendChild(prevButton);
            carousel.appendChild(nextButton);
        } else {
            const noImageMessage = document.createElement('p');
            noImageMessage.textContent = 'No images available';
            carouselInner.appendChild(noImageMessage);
        }

        const roomTitle = document.createElement('h3');
        roomTitle.textContent = room.room_title;

        const roomDescription = document.createElement('p');
        roomDescription.textContent = room.description;

        const roomPrice = document.createElement('span');
        roomPrice.textContent = `Price: $${room.price}`;

        const detailsButton = document.createElement('a');
        detailsButton.href = `/room_details/${room.id}`;
        detailsButton.textContent = 'View Details';
        detailsButton.classList.add('availability-button');
        detailsButton.style.marginTop = '10px';
        detailsButton.style.display = 'inline-block';

        roomCard.appendChild(carousel);
        roomCard.appendChild(roomTitle);
        roomCard.appendChild(roomDescription);
        roomCard.appendChild(roomPrice);
        roomCard.appendChild(detailsButton);

        roomsContainer.appendChild(roomCard);
    });

    document.getElementById('rooms-wrapper').classList.remove('hidden');
}

    });
</script>

</body>
</html>
