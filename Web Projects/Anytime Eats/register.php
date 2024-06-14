
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anytime Eats-Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="img/favicon.jpg" rel="icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>


<!-- Registre Start -->
<div class="container-xxl py-5 register">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="text-primary mb-0"><a href="index.php"><i class="fa fa-utensils me-3"></i></a>Anytime Eats</h1>
            <h2 class="mb-5 register_text">Register Now</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <div class="form-floating">
                                <div class="error-message">
                             </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input  type="text" name="username" value="" class="form-control" id="name" placeholder="Your Name" required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input  type="email" name="email" value="" class="form-control" id="email" placeholder="Your Email" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Your Password" required>
                                <label for="password">Your Password</label>
                                <b><i class="bi bi-eye-slash text-white" id="togglePassword"></i></b>
                      </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="register">Sign up</button>
                        </div>
                    </form>
                    <div class="new-account mt-3">
                                        <p >Already have an account? <a  href="login.php">Sign in</a></p>
                                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- register End -->
<?php
session_start(); // Start the session
// Include functions.php
include "functions.php";

// Check if form is submitted
if(isset($_POST['register'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

     // Call registerUser function to insert user data into the database
     $registration_result = registerUser($username, $email, $password);
     if ($registration_result === true) {
        $_SESSION['email'] = $email;
         // Registration successful, generate OTP
         $otp = generateOTP();
         
         // Save OTP to database
         $save_result = saveOtpToDatabase($email, $otp,'email');
         
         if ($save_result === true) {
             // Send OTP email
             $send_result = sendOtpEmail($email, $otp);
             
             if ($send_result === true) {
                 // Display success message and redirect to OTP verification page after 2 seconds
                 echo "<script>
                         $(document).ready(function() {
                             $('.error-message').html('<div class=\"alert alert-success\">Registration successful! OTP sent to your email.</div>');
                             setTimeout(function() {
                                 window.location.href = 'email_otp.php'; // Redirect to OTP verification page
                             }, 1000);
                         });
                       </script>";
             } else {
                 // Failed to send OTP, display error message
                 echo "<script>
                         $(document).ready(function() {
                             $('.error-message').html('<div class=\"alert alert-danger\">Registration successful but failed to send OTP: " . $send_result . "</div>');
                         });
                       </script>";
             }
         } else {
             // Failed to save OTP, display error message
             echo "<script>
                     $(document).ready(function() {
                         $('.error-message').html('<div class=\"alert alert-danger\">Registration successful but failed to save OTP: " . $save_result . "</div>');
                     });
                   </script>";
         }
     } else {
         // Registration failed, display error message
         echo "<script>
                 $(document).ready(function() {
                     $('.error-message').html('<div class=\"alert alert-danger\">" . $registration_result . "</div>');
                 });
               </script>";
     }
 }
?>
<script>
     const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    togglePassword.style.cursor = 'pointer';
    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
    
    </script>

</body>

