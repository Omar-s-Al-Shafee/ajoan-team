@extends('User.layauts.master')
@section('content')
<style>
span{
font-size: 23px;
color: #8c95f6;

}
.container-fluid {
    /* background-color: #ffffff; */
    padding: 15px;
    /* border-radius: 10px; */
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
}

img.img-fluid {
    width: 100%;
    height: 400px;
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

h4.text-center {
    font-size: 28px;
    color: #333;
    margin-top: 20px;
}

h6 span {
    font-size: 18px;
    color: #555;
}


hr {
    border-top: 2px solid #8c95f6;
}

/* Card Styles */
.course-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}


.mms{
    padding-top: 100px;
    width: 33%;
    height: 500px;

}

.course-card img {
    max-width: 100%;
    height: 400px;
    border-radius: 10px;
}

.course-card h4 {
    font-size: 24px;
    color: #333;
    margin-top: 10px;
}

.course-card p {
    font-size: 20px;
    color: #555;
}

/* Popup Styles */
.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1000;
}

.popup-content {
    background-color: #fff;
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    position: relative;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}

/* You can add more styling to your popup here */

</style>

</head>
<body>
  

<section id="courses">
    <div class="container-fluid min-vh-100 d-flex flex-column mt-4">
        <div class="row">
            <div class="col-md-4  mms ">
                <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid" alt="{{ $course->title }}">
            </div>
            <div class="col-md-8">
                <h4 class="text-center">Course: {{ $course->title }}</h4>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="course-card">
                            <h4>Description</h4>
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="course-card">
                            <h4>Price</h4>
                            <p>{{ $course->price }}JD</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <h4>Target Group</h4>
                            <p>{{ $course->Target_group }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="course-card">
                            <h4>Duration of the Course</h4>
                            <p>{{ $course->time }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <h4>Start Time</h4>
                            <p>{{ $course->start }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="course-card">
                            <h4>End Time</h4>
                            <p>{{ $course->end }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="course-card">
                            <h4>Location</h4>
                            <p>{{ $course->location }}</p>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Add this button to trigger the reservation popup -->
<button id="openReservationPopup" class="btn btn-primary">Reserve This Course</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Reservation Popup -->
<div id="reservationPopup" class="popup">
    <div class="popup-content">
        <span class="close" id="closeReservationPopup">&times;</span>
        <h2>Reserve This Course</h2>
        
        <!-- Add a message container for displaying the error message -->
        <div id="errorMessage" style="color: red;"></div>

        <!-- Reservation Form -->
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Reserve</button>
        </form>
    </div>
</div>
<script>
     document.getElementById('openReservationPopup').addEventListener('click', function() {
        // Check if Target_group is 0 and display an error message
        if ({{ $course->Target_group }} === 0) {
            document.getElementById('reservationPopup').style.display = 'block';
            document.getElementById('errorMessage').textContent = 'Sorry, but all seats have been reserved.';
            
            // Hide the form elements
            var formGroups = document.getElementsByClassName('form-group');
            for (var i = 0; i < formGroups.length; i++) {
                formGroups[i].style.visibility = 'hidden';
            }
        } else {
            document.getElementById('reservationPopup').style.display = 'block';
            
            // Show the form elements
            var formGroups = document.getElementsByClassName('form-group');
            for (var i = 0; i < formGroups.length; i++) {
                formGroups[i].style.visibility = 'visible';
            }
        }
    });
    // JavaScript to close the popup when the close button is clicked
    document.getElementById('closeReservationPopup').addEventListener('click', function() {
        document.getElementById('reservationPopup').style.display = 'none';
    });
</script>
@endsection