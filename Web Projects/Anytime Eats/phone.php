<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anytime Eats - Phone </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="img/favicon.jpg" rel="icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container-xxl py-5 otp_verify">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="text-primary mb-0"><a href="index.php"><i class="fa fa-utensils me-3"></i></a>Anytime Eats</h1>
                <h2 class="mb-5 otp_text">Phone Now</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Your phone Number" >
                                    <label for="otp">Your Phone Number</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100 py-3" type="submit" name="phone_submit">submit</button>
                               
                            </div>
                
                        </form>
                        <div class="new-account mt-3">
                            <!-- <p>Don't have an account? <a href="register.php">Sign up</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!--  -->
<?php
   session_start(); // Start the session

   // Include functions.php
   include 'functions.php';
   
   // Check if the phone number form is submitted
   if (isset($_POST['phone_submit'])) {
       $phone = $_POST['phone'];
       $email = $_SESSION['email']; // Assuming email is stored in session after registration
   
       $phone_result = savePhoneNumber($email, $phone);
       if ($phone_result === true) {
            $_SESSION['phone'] = $phone;
            // Phone number successful, generate OTP
            $otp = generateOTP();
            $save_result = saveOtpToDatabase($phone, $otp, 'phone');
            
            if ($save_result === true) {
                // Send OTP SMS
                $send_result = sendOtpSms($phone, $otp);
                
                if ($send_result === true) {
                    // Display success message and redirect to OTP verification page after 2 seconds
                    echo "<script>
                    $(document).ready(function() {
                        $('.error-message').html('<div class=\"alert alert-success\">Phone number updated successfully! OTP is on its way.</div>');
                        setTimeout(function() {
                            window.location.href = 'phone_otp.php'; // Redirect to phone_otp page 
                        }, 2000);
                    });
                  </script>";
                } else {
                    // Failed to send OTP, display error message
                    echo "<script>
                            $(document).ready(function() {
                                $('.error-message').html('<div class=\"alert alert-danger\">Phone number updated successfully but failed to send OTP: " . $send_result . "</div>');
                            });
                          </script>";
                }
            } else {
                // Failed to save OTP, display error message
                echo "<script>
                        $(document).ready(function() {
                            $('.error-message').html('<div class=\"alert alert-danger\">Phone number updated successfully but failed to save OTP: " . $save_result . "</div>');
                        });
                      </script>";
            }
        } else {
           echo "<script>
                   $(document).ready(function() {
                       $('.error-message').html('<div class=\"alert alert-danger\">$phone_result</div>');
                   });
                 </script>";
       }
   }
?>


    <script>
    

    </script>
</body>
</html>
