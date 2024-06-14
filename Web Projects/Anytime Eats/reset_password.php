<!-- reset_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <h2 class="mb-5 otp_text">Reset Password</h2>
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
                                    <input type="password" name="new_password" class="form-control" id="password" placeholder="New Password" required>
                                    <label for="new_password">New Password</label>
                                    <b><i class="bi bi-eye-slash text-white" id="togglePassword"></i></b>
                                </div>
                            </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="reset_password">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
session_start();
include "functions.php";

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $email = $_SESSION['email'];

    // Hash the new password
   $update_result = updatePassword($email ,$new_password);

    if($update_result === true) {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-success\">Password reset successfully!</div>');
                    setTimeout(function() {
                        window.location.href = 'login.php'; // Redirect to login page
                    }, 1000);
                });
              </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    $('.error-message').html('<div class=\"alert alert-danger\">Failed to reset password: " . $update_result . "</div>');
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
</html>
