<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anytime Eats - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="img/favicon.jpg" rel="icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container-xxl py-5 login">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="text-primary mb-0"><a href="index.php"><i class="fa fa-utensils me-3"></i></a>Anytime Eats</h1>
                <h2 class="mb-5 login_text">Login Now</h2>
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
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Username" required>
                                    <label for="email">Your email</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Your Password" required>
                                    <label for="password">Your Password</label>
                                    <b><i class="bi bi-eye-slash text-white" id="togglePassword"></i></b>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100 py-3" type="submit" name="login">Sign in</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p>New Account? <a href="register.php">Sign up</a><span><a class ="forgot_text" href="forgot_password.php">Forgot Password</a></span></p>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    session_start();
    // Include functions.php
    include "functions.php";

    // Check if form is submitted
    if (isset($_POST['login'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Call loginUser function to verify user credentials
        $login_result = loginUser($email, $password);
        if ($login_result === true) {
          // Store email in session
        $_SESSION['email'] = $email;
            // Login successful, redirect to home page or dashboard
            echo "<script>
                    $(document).ready(function() {
                        window.location.href = 'home.php'; // Redirect to home page
                    });
                  </script>";
            exit();
        } else {
            // Login failed, display error message
            echo "<script>
                    $(document).ready(function() {
                        $('.error-message').html('<div class=\"alert alert-danger\">" . $login_result . "</div>');
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
