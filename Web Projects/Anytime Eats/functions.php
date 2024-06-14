<?php
// // functions.php

function registerUser($username, $email, $password) {

    include "connection.php"; 

    // Sanitize input
    $username = mysqli_real_escape_string($con, $username);
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    // Check if email or username already exists
    $query_username = "SELECT * FROM users WHERE username='$username'";
    $query_email = "SELECT * FROM users WHERE email='$email'";

    $result_username = mysqli_query($con, $query_username);
    $result_email = mysqli_query($con, $query_email);

    if (mysqli_num_rows($result_username) > 0) {
        return "Username already exists.";
    } elseif (mysqli_num_rows($result_email) > 0) {
        return "Email already exists.";
    } else {
        // Directly store the plain text password (not recommended)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query_insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($con, $query_insert)) {
            return true;
        } else {
            return "Error: " . mysqli_error($con);
        }
    }
}


function loginUser($email, $password) {
    include "connection.php";

    // Sanitize email to prevent SQL injection
    $email = mysqli_real_escape_string($con, $email);

    // Query to check if the email exists
    $query_email = "SELECT * FROM users WHERE email='$email'";
    $result_email = mysqli_query($con, $query_email);

    if (mysqli_num_rows($result_email) > 0) {
        $fetch = mysqli_fetch_assoc($result_email);
        
        
        // Compare the entered password with the stored password directly
        if (password_verify($password, $fetch['password'])){
            // Successful login
            return true;
        } else {
            // Invalid password
            return "Invalid password.";
           
        }
    } else {
        // Email does not exist
        return "Email does not exist.";
    }
}

// function to send otp through email 

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

function sendOtpEmail($email, $otp) {
    

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'madikhan.1308@gmail.com'; // SMTP username
        $mail->Password = 'zgvhgiojxgwhiwhh'; // SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('madikhan.1308@gmial.com', 'Anytime Eats');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = 'Your OTP code is <b>' . $otp . '</b>';

        $mail->send();
        return true;
    } catch (Exception $e) {
         return "Message could not be sent. ";
    }
}


// Function to generate OTP
function generateOTP() {
    return rand(100000, 999999);
}
// Function to save OTP to database without using prepared statements

function saveOtpToDatabase($contact, $otp, $type ) {
    include "connection.php"; 

    $contact = mysqli_real_escape_string($con, $contact);
    $otp = mysqli_real_escape_string($con, $otp);

    // Set expiration time to 30 minutes from now
    $expiration = date('Y-m-d H:i:s', strtotime('+30 minutes'));
    $expiration = mysqli_real_escape_string($con, $expiration);
    
    if ($type === 'email') {
        $query_insert = "INSERT INTO otp_storage (email, otp, expiration) VALUES ('$contact', '$otp', '$expiration')";
    } elseif ($type === 'phone') {
        $query_insert = "INSERT INTO otp_storage (phone, otp, expiration) VALUES ('$contact', '$otp', '$expiration')";
    } else {
        return "Invalid contact type.";
    }

    if (mysqli_query($con, $query_insert)) {
        return true;
    } else {
        return "Error: " . mysqli_error($con);
    }
}


// Function to validate OTP
function validateOtp($contact, $otp) {
    include "connection.php";

    $contact = mysqli_real_escape_string($con, $contact);
    $otp = mysqli_real_escape_string($con, $otp);

    // Determine whether to use email or phone number for validation
    $field = filter_var($contact, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    // Construct the SQL query based on the field
    $query_select = "SELECT otp, expiration FROM otp_storage WHERE $field='$contact' AND otp='$otp'";
    $result_otp = mysqli_query($con, $query_select);

    if ($result_otp && mysqli_num_rows($result_otp) > 0) {
        $result_expiry = mysqli_fetch_assoc($result_otp);
        $expiration = $result_expiry['expiration'];

        if (new DateTime() < new DateTime($expiration)) {
            return true; // OTP is valid and not expired
        } else {
            return "OTP has expired.";
        }
    } else {
        return "Invalid OTP.";
    }
}


 // Function to resend OTP
function resendOtp_Email($email) {

    include "connection.php";

    $email = mysqli_real_escape_string($con, $email);

    // Generate a new OTP
    $otp = generateOTP();

    // Set expiration time to 15 minutes from now
    $expiration = date('Y-m-d H:i:s', strtotime('+30 minutes'));
    $expiration = mysqli_real_escape_string($con, $expiration);

    // Insert new OTP into the database
    $query_insert = "INSERT INTO otp_storage (email, otp, expiration) VALUES ('$email', '$otp', '$expiration')";
    
    if (mysqli_query($con, $query_insert)) {
        // Send OTP email
        $send_result = sendOtpEmail_register($email, $otp);
        if ($send_result === true) {
            return true;
        } else {
            return "Failed to send OTP email.";
        }
    } else {
        return "Error: " . mysqli_error($con);
    }
}
// function to add phone number
function savePhoneNumber($email, $phone) {
    include "connection.php";

    $email = mysqli_real_escape_string($con, $email);
    $phone = mysqli_real_escape_string($con, $phone);

    $query_update = "UPDATE users SET phone='$phone' WHERE email='$email'";

    if (mysqli_query($con, $query_update)) {
        return true;
    } else {
        return "Error: " . mysqli_error($con);
    }
}
//function to send otp on mobile
function sendOtpSms($phone, $otp) {
    $apiKey = 'ca7a3ce662480fdcc475c559c6a38e83-323d0a52-a352-4659-8c97-412d3bd304a8'; // Your API key here
    $url = 'https://ppjl98.api.infobip.com/sms/2/text/advanced';
    
    $data = [
        "messages" => [
            [
                "destinations" => [
                    ["to" => $phone]
                ],
                "from" => "Anytime Eats",
                "text" => "Your OTP code is: $otp"
            ]
        ]
    ];
    
    $jsonData = json_encode($data);
    
    $headers = [
        'Authorization: App ' . $apiKey,
        'Content-Type: application/json',
        'Accept: application/json'
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return 'Error:' . curl_error($ch);
    }
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    if ($httpCode == 200) {
        $responseData = json_decode($response, true);
        $status = $responseData['messages'][0]['status']['name'];
        $description = $responseData['messages'][0]['status']['description'];
        
        if ($status === 'PENDING_ACCEPTED') {
            return true; // Treat this as success
        } elseif ($status === 'DELIVERED') {
            return true; // Treat this as success
        } else {
            return 'Failed to send OTP: ' . $description;
        }
    } else {
        return 'Unexpected HTTP status: ' . $httpCode;
    }
}


//function to resend otp to  phone
function resendOtpSms($phone) {
    include "connection.php";
    // Generate a new OTP
    $otp = generateOTP();

    // Set expiration time to 15 minutes from now
    $expiration = date('Y-m-d H:i:s', strtotime('+30 minutes'));
    $expiration = mysqli_real_escape_string($con, $expiration);

    // Insert new OTP into the database
    $query_insert = "INSERT INTO otp_storage (phone, otp, expiration) VALUES ('$phone', '$otp', '$expiration')";
    
    if (mysqli_query($con, $query_insert)) {
        // Send OTP email
        $send_result = sendOtpSms($phone, $otp);
        if ($send_result === true) {
            return true;
        } else {
            return "Failed to send OTP Phone.";
        }
    } else {
        return "Error: " . mysqli_error($con);
    }
}
function updatePassword($email ,$new_password){
    include "connection.php"; 
    $email = mysqli_real_escape_string($con, $email);
    $new_password = mysqli_real_escape_string($con, $new_password);
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update the password in the database
    $query_update = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
    if (mysqli_query($con,$query_update)) {
        return true;
    } else {
        return "Error: " . mysqli_error($con);
    }
}
// function to update user info 

function updateUserInfo($email, $username, $phone, $address) {
    include 'connection.php'; // Include the database connection file

    $email = mysqli_real_escape_string($con, $email);
    $username = mysqli_real_escape_string($con, $username);
    $phone = mysqli_real_escape_string($con, $phone);
    $address = mysqli_real_escape_string($con, $address);

    $query_update = "UPDATE users SET username = '$username', phone = '$phone', address = '$address' WHERE email = '$email'";

    if (mysqli_query($con,  $query_update)) {
        mysqli_close($con);
        return true;
    } else {
        $error = mysqli_error($con);
        mysqli_close($con);
        return $error;
    }
}

// Function to check table availability based on table type
function checkTableAvailability($table_type, $num_people) {
    include "connection.php"; // Assuming you have a database connection
    
    // Sanitize inputs to prevent SQL injection
    $table_type = mysqli_real_escape_string($con, $table_type);
    $num_people = intval($num_people); // Convert to integer
    
    // Construct the SQL query
    $query_select = "SELECT tid FROM tables WHERE t_type = '$table_type' AND availability = 'available' AND num_seats = '$num_people' LIMIT 1";
    
    // Execute the query
    $result = mysqli_query($con, $query_select);
    
    // Check if query executed successfully and returned at least one row
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the first row
        $row = mysqli_fetch_assoc($result);
        return $row['tid']; // Return the table ID of the first available table
    } else {
        return false; // No table available
    }
}

function saveReservation($name, $email, $datetime, $people, $message) {
    include "connection.php"; // Assuming you have a database connection

    if (!isset($_SESSION['tid'])) {
        return false; // No table ID in session, reservation cannot proceed
    }
    
    $tid = $_SESSION['tid'];


    // Escape inputs to prevent SQL injection
    $tid = mysqli_real_escape_string($con, $tid);
    $name = mysqli_real_escape_string($con, $name);
    $email = mysqli_real_escape_string($con, $email);
    $datetime = mysqli_real_escape_string($con, $datetime);
    $people = mysqli_real_escape_string($con, $people);
    $message = mysqli_real_escape_string($con, $message);

    // Insert reservation data into reservations table
    $query_insert = "INSERT INTO reservations (tid, name, email, date_time, people, message) VALUES ('$tid', '$name', '$email', '$datetime', '$people', '$message')";
    $result = mysqli_query($con, $query_insert);

    if ($result) {
        // Update the table availability status to 'reserved'
        $query_update = "UPDATE tables SET availability ='reserved'  WHERE tid = '$tid'";
        mysqli_query($con, $query_update);
        
        // Schedule a task to update availability back to 'available' after 1.5 hours
        $schedule_datetime = date('Y-m-d H:i:s', strtotime('+1.5 hours', strtotime($datetime)));
        $job_query = "INSERT INTO scheduled_jobs (tid, schedule_datetime, action) VALUES ('$tid', '$schedule_datetime', 'update_availability')";
        mysqli_query($con, $job_query);
        
        // Clear the table ID from the session
        unset($_SESSION['tid']);
        // Reservation saved successfully
        return true;
    } else {
        // Error occurred while saving reservation
        return false;
    }
}

// Periodic job checker function
function checkScheduledJobs() {
    include "connection.php"; // Assuming you have a database connection
    
    // Get current time
    $current_datetime = date('Y-m-d H:i:s');
    
    // Select jobs scheduled before or at the current time
    $query = "SELECT * FROM scheduled_jobs WHERE schedule_datetime <= '$current_datetime'";
    $result = mysqli_query($con, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $tid = $row['tid'];
        // Update table availability to 'available'
        $query_update = "UPDATE tables SET availability ='available' WHERE tid = '$tid'";
        mysqli_query($con, $query_update);
        
        // Delete the executed job
        $job_id = $row['id'];
        $query_delete = "DELETE FROM scheduled_jobs WHERE id = '$job_id'";
        mysqli_query($con, $query_delete);
    }
}

// Call the function to check for scheduled jobs periodically
checkScheduledJobs();

// function to send  email  of reservation

 function sendEmailReservation($name, $email, $datetime, $numPeople) {

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'madikhan.1308@gmail.com'; // SMTP username
        $mail->Password = 'zgvhgiojxgwhiwhh'; // SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('madikhan.1308@gmail.com', 'Anytime Eats');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reservation Confirmation';
        $mail->Body    = "Dear $name,<br><br>Your reservation for $numPeople people on $datetime has been confirmed.<br><br>Thank you for choosing Anytime Eats!<br><br>Best Regards,<br>Anytime Eats Team";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
function ReceiveEmail($name, $email, $subject, $message) {
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'madikhan.1308@gmail.com'; // SMTP username
        $mail->Password = 'zgvhgiojxgwhiwhh'; // SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('madikhan.1308@gmail.com', 'Anytime Eats');
        $mail->addAddress('madikhan.1308@gmail.com'); // Fixed recipient (your email)

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "You have received a new message from the contact form.<br><br>
                          <strong>Name:</strong> $name<br>
                          <strong>Email:</strong> $email<br>
                          <strong>Subject:</strong> $subject<br>
                          <strong>Message:</strong><br>$message";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
// Function to fetch menu items based on category


?>



