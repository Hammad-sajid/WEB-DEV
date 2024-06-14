<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <h1 class="text-primary mb-0"><i class="fa fa-utensils me-3"></i>Anytime Eats</h1>
            <h2 class="mb-5 otp_text">Forgot Password</h2>
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
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <label for="email">Your email</label>
                                </div>
                            </div>
                    
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="request_otp">Request OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
session_start();
include 'functions.php';

if (isset($_POST['request_otp'])) {
    $email = $_POST['email'];

    // Generate OTP
    $otp = generateOTP();
    
    // Save OTP to database
    $save_result = saveOtpToDatabase($email, $otp, 'email');

    if ($save_result === true) {
        // Send OTP email
        $send_result = sendOtpEmail($email, $otp);
        
        if ($send_result === true) {
            // Save email to session and redirect to OTP verification page
            $_SESSION['email'] = $email;
            echo "<script>
                    $(document).ready(function() {
                        $('.error-message').html('<div class=\"alert alert-success\">OTP sent to your email.</div>');
                        setTimeout(function() {
                            window.location.href = 'verify_otp.php'; // Redirect to OTP verification page
                        }, 1000);
                    });
                  </script>";
        } else {
            echo "<script>
                    $(document).ready(function() {
                        $('.error-message').html('<div class=\"alert alert-danger\">Failed to send OTP: " . $send_result . "</div>');
                    });
                  </script>";
        }
    } else {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-danger\">Failed to save OTP: " . $save_result . "</div>');
                });
              </script>";
    }
}
?>

</body>
</html>
