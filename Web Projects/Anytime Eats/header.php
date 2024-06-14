
<?php 
$current_page = basename($_SERVER['PHP_SELF'], ".php"); // Get the current page name
?>

<!-- Navbar & Hero Start -->
 <div class="change-class position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Anytime Eats</h1>
                
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="home.php" class="nav-item nav-link <?php if ($current_page == 'home') echo 'active'; ?>">Home</a>
                        <a href="about.php" class="nav-item nav-link <?php if ($current_page == 'about') echo 'active'; ?>">About</a>
                        <a href="menu.php" class="nav-item nav-link <?php if ($current_page == 'menu') echo 'active'; ?>">Menu</a>
                        <a href="reservation.php" class="nav-item nav-link <?php if ($current_page == 'reservation') echo 'active'; ?>">Reservation</a>
                        <a href="team.php" class="nav-item nav-link <?php if ($current_page == 'team') echo 'active'; ?>">Team</a>
                        <a href="contact.php" class="nav-item nav-link <?php if ($current_page == 'contact') echo 'active'; ?>">Contact</a>
                    </div>
                    <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle btn btn-primary py-2 px-4 " data-bs-toggle="dropdown"><i class="fa fa-user"></i></a>
                            <div class="dropdown-menu m-0">
                                <a href="user_info.php" class="dropdown-item">User Info</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                                
                            </div>
                        </div>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->
        <!-- Navbar & Hero Start -->
<!-- <div class="change-class position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Anytime Eats</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="home.php" class="nav-item nav-link <?php if ($current_page == 'home') echo 'active'; ?>">Home</a>
                <a href="about.php" class="nav-item nav-link <?php if ($current_page == 'about') echo 'active'; ?>">About</a>
                <a href="service.php" class="nav-item nav-link <?php if ($current_page == 'service') echo 'active'; ?>">Service</a>
                <a href="menu.php" class="nav-item nav-link <?php if ($current_page == 'menu') echo 'active'; ?>">Menu</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?php if (in_array($current_page, ['booking', 'team', 'testimonial'])) echo 'active'; ?>" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="booking.php" class="dropdown-item <?php if ($current_page == 'booking') echo 'active'; ?>">Booking</a>
                        <a href="team.php" class="dropdown-item <?php if ($current_page == 'team') echo 'active'; ?>">Our Team</a>
                        <a href="testimonial.php" class="dropdown-item <?php if ($current_page == 'testimonial') echo 'active'; ?>">Testimonial</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link <?php if ($current_page == 'contact') echo 'active'; ?>">Contact</a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle btn btn-primary py-2 px-4" data-bs-toggle="dropdown"><i class="fa fa-user"></i></a>
                <div class="dropdown-menu m-0">
                    <a href="userinfo.php" class="dropdown-item <?php if ($current_page == 'userinfo') echo 'active'; ?>">User Info</a>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</div> -->



       