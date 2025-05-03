<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - ExpoMatrix</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="logstyle.css">
    <link rel="shortcut icon" href="logowebsite.jpeg">
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box login">
            <form action="auth.php" method="post">
                <h1>Login</h1>

                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']); 
                }
                ?>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <select name="user_type" id="login_user_type" required>
                        <option value="organizer" <?php if (isset($user_type) && $user_type == 'organizer') echo 'selected'; ?>>Organizer</option>
                        <option value="vendor" <?php if (isset($user_type) && $user_type == 'vendor') echo 'selected'; ?>>Vendor</option>
                    </select>
                    <i class='bx bxs-user-check'></i>
                </div>

                <button type="submit" name="login" class="btn">Login</button>
                <a href="#" id="forget-password-link">Forget Password?</a>
            </form>
        </div>

        <div class="form-box register">
            <form action="auth.php" method="post">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <input type="text" name="fullname" placeholder="Full Name" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <input type="text" name="number" placeholder="Mobile Number" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <select name="user_type" required>
                        <option value="organizer">Organizer</option>
                        <option value="vendor">Vendor</option>
                    </select>
                    <i class='bx bxs-user-check'></i>
                </div>
                <button type="submit" name="register" class="btn">Register</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>

    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">

            <div class="sofa-img">
                <img src="sofa.jpeg" alt="Image" class="img-fluid">
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg"
                                    alt="Image" class="img-fluid"></span><span>Connect With Us</span></h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">ExpoMatrix<span></span></a></div>
                    <p class="mb-4">From Blueprint to Booked — Instantly.</p>
                    <p>Explore a smarter way to manage your expo, where technology and creativity converge to create a
                        streamlined, user-friendly experience. Join us in revolutionizing the way exhibitions are
                        planned and executed.</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Services</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Our team</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Nordic Chair</a></li>
                                <li><a href="#">Kruzo Aero</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash;
                            Designed with love by  <a href="https://untree.co">Expometrix</a> Distributed By <a
                            hreff="https://themewagon.com">Expometrix</a>
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Section -->

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
    <script src="script.js"></script>
    
    <!-- Add JavaScript for forget password functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle forget password link click
            document.getElementById('forget-password-link').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get the selected user type
                const userTypeSelect = document.getElementById('login_user_type');
                const selectedUserType = userTypeSelect.value;
                
                if (selectedUserType) {
                    // Redirect to forget password page with the selected user type
                    window.location.href = 'forget_password.php?user_type=' + selectedUserType;
                } else {
                    alert('Please select a user type first');
                }
            });
        });
    </script>
</body>

</html>