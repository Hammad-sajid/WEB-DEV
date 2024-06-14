<?php
session_start();
include "functions.php";

// Check if availability form is submitted
if (isset($_POST['check_availability'])) {
    $table_type = $_POST["table_type"];
    $num_people = $_POST["num_people"];
    $available_table_id = checkTableAvailability($table_type, $num_people);
    
    if ($available_table_id !== false) {
        $_SESSION['tid'] = $available_table_id; // Save the table ID in the session
        $_SESSION['num_people'] = $num_people; // Save the number of people in the session
    }
    
    echo json_encode(['available' => $available_table_id !== false, 'table_id' => $available_table_id]);
    exit;
}

// Check if reservation form is submitted
//changes made after successful reservation
// Check if reservation form is submitted
if (isset($_POST['submit_reservation'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $datetime = $_POST['date'] . ' ' . $_POST['time'];
    $num_people = $_SESSION['num_people']; // Retrieve the number of people from the session
    $message = $_POST['message'];

    // Call the function to save the reservation
    $save_result = saveReservation($name, $email, $datetime, $num_people, $message);

    if ($save_result) {
        // Send confirmation email
        $email_result = sendEmailReservation($name, $email, $datetime, $num_people);

        if ($email_result === true) {
            echo json_encode(['success' => true]); // Send success response
        } else {
            echo json_encode(['success' => false, 'error' => $email_result]); // Send failure response with email error
        }
    } else {
        echo json_encode(['success' => false]); // Send failure response
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Anytime Eats | Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.jpg" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-xxl bg-white p-0">
    <?php include "header.php"; ?>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Table Reservation</h1>
        </div>
    </div>
    <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="video">
                    <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://youtu.be/--MdohXec7M" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                    <div id="first-part">
                        <h1 class="text-white mb-4">Check Table Availability</h1>
                        <div id="availability-error-message" class="alert alert-danger" style="display: none;">
                        </div>
                        <form id="availability-form" onsubmit="checkAvailability(event)">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="table_type" name="table_type" required>
                                            <option value="family">Family</option>
                                            <option value="friends">Friends</option>
                                            <option value="couple">Couple</option>
                                        </select>
                                        <label for="table_type">Table Type</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="num_people" name="num_people" placeholder="Number of People" required>
                                        <label for="num_people">Number of People</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Check Availability</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="second-part" style="display: none;">
                        <div class="mt-5">
                            <h1 class="text-white mb-4">Book A Table Online</h1>
                            <div id="success-message" style="display:none;" class="alert alert-success"></div>
                            <div id="error-message" style="display:none;" class="alert alert-danger"></div>
                            <form id="reservation-form" onsubmit="checkReservation(event)">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                                            <label for="date">Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="time" class="form-control" id="time" name="time" placeholder="Time" required>
                                            <label for="time">Time</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="message" name="message" placeholder="Special Requests" style="height: 100px"></textarea>
                                            <label for="message">Special Requests</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Submit Reservation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/main.js"></script>
<!-- custom script -->
<script>
function toggleFormSections(available, success) {
    if (success) {
        if (available) {
            document.getElementById('first-part').style.display = 'none';
            document.getElementById('second-part').style.display = 'block';
        } else {
            document.getElementById('availability-error-message').innerText = 'Table is not available.';
            document.getElementById('availability-error-message').style.display = 'block';
        }
    } else {
        document.getElementById('availability-error-message').innerText = 'Error occurred while processing your request.';
        document.getElementById('availability-error-message').style.display = 'block';
    }
}

function checkAvailability(event) {
    event.preventDefault();
    const tableType = document.getElementById('table_type').value;
    const numPeople = document.getElementById('num_people').value;
    const formData = new FormData();
    formData.append('check_availability', true);
    formData.append('table_type', tableType);
    formData.append('num_people', numPeople);

    fetch('reservation.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        toggleFormSections(data.available, true);
    })
    .catch(error => {
        console.error('Error:', error);
        toggleFormSections(false, false); // Show error message
    });
}
// changes made after successfull reservations
function checkReservation(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const numPeople = document.getElementById('num_people').value;
    const message = document.getElementById('message').value;

    const formData = new FormData();
    formData.append('submit_reservation', true);
    formData.append('name', name);
    formData.append('email', email);
    formData.append('date', date);
    formData.append('time', time);
    formData.append('num_people', numPeople);
    formData.append('message', message);

    fetch('reservation.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('success-message').innerText = 'Reservation successful. A confirmation email has been sent.';
            document.getElementById('success-message').style.display = 'block';
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
                window.location.reload(); // Reload the page after 3 seconds
            }, 3000);
        } else {
            document.getElementById('error-message').innerText = 'Failed to make reservation. ' + (data.error ? data.error : '');
            document.getElementById('error-message').style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('error-message').innerText = 'Error occurred while processing your request.';
        document.getElementById('error-message').style.display = 'block';
    });
}

</script>
</body>
</html>
