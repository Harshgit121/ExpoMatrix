<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ExpoMatrix Organizer Dashboard</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <!-- Using the same Google Font as in your CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- Optionally link your existing CSS file here -->
  <!-- <link rel="stylesheet" href="your-existing-styles.css" /> -->
  <style>
    /* Global Styles */
    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background-color: #eff2f1;
      color: #6a6a6a;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      transition: 0.3s all ease;
      color: #2f2f2f;
    }

    a:hover {
      text-decoration: none;
    }

    /* Dashboard Container */
    .dashboard {
      display: flex;
      min-height: 100vh;
      overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
      background-color: #3b5d50;
      width: 250px;
      flex-shrink: 0;
      padding: 20px;
      color: #fff;
      position: relative;
      transition: width 0.3s ease;
    }

    .sidebar:hover {
      width: 300px;
    }

    .sidebar h2 {
      margin: 0;
      padding-bottom: 20px;
      font-size: 24px;
      font-weight: 700;
    }

    .menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .menu li {
      margin-bottom: 15px;
      overflow: hidden;
    }

    .menu li a {
      display: block;
      padding: 10px 15px;
      border-radius: 5px;
      font-weight: 500;
      color: #ffffff;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .menu li a:hover {
      background-color: #314d43;
      transform: scale(1.05);
    }

    /* Generate Layout Button */
    .generate-btn {
      display: block;
      text-align: center;
      margin-top: 30px;
      padding: 12px 20px;
      border-radius: 30px;
      background-color: #f9bf29;
      color: #2f2f2f;
      font-weight: 600;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .generate-btn:hover {
      background-color: #f8b810;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Content Area */
    .content {
      flex-grow: 1;
      background: #ffffff;
      padding: 40px;
      overflow-y: auto;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid #dce5e4;
      background-color: #ffffff;
    }

    .header .logo {
      font-size: 28px;
      font-weight: 700;
      color: #3b5d50;
    }

    .header nav a {
      margin-left: 15px;
      font-weight: 500;
      color: #3b5d50;
      transition: color 0.3s ease;
    }

    .header nav a:hover {
      color: #314d43;
    }

    /* Animated Dashboard Cards */
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      flex: 1;
      min-width: 250px;
      padding: 20px;
      border-radius: 10px;
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .card:hover {
      transform: translateY(-10px);
    }

    .card h3 {
      margin-top: 0;
      font-weight: 600;
    }

    /* Color variations for cards */
    .card.upcoming {
      background: #f9bf29;
      color: #2f2f2f;
    }

    .card.active {
      background: #3b5d50;
      color: #ffffff;
    }

    .card.pending {
      background: #eff2f1;
      border: 2px solid #3b5d50;
      color: #3b5d50;
    }

    .layout-container {
      position: relative;
      border: 2px solid #000;
      margin: 20px auto;
      background-color: #ADE8F4;
      overflow: auto;
    }

    .stall {
      position: absolute;
      background-color: white;
      border: 2px solid #000;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      cursor: pointer;
      overflow: hidden;
      text-align: center;
    }

    .small-stall {
      background-color: #E6F7FF;
    }

    .large-stall {
      background-color: #FFFBEB;
    }

    .staff-space {
      position: absolute;
      background-color: #ADE8F4;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }

    .walking-space {
      position: absolute;
      background-color: #CCFF33;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }

    .gate {
      position: absolute;
      background-color: #FF9999;
      border: 2px solid #FF0000;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 14px;
      color: #800000;
    }

    .modal-xl {
      max-width: 90%;
    }

    .layout-controls {
      background-color: #f8f9fa;
      border-radius: 5px;
      padding: 15px;
      margin-bottom: 20px;
    }

    #scaleFactor {
      width: 100%;
    }

    .scale-label {
      margin-top: 5px;
      font-size: 12px;
      color: #6c757d;
    }

    .info-section {
      background-color: #e9ecef;
      border-radius: 5px;
      padding: 15px;
      margin-top: 15px;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #0077B6;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="dashboard">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <h2>ExpoMatrix</h2>
      <ul class="menu">
        <li><a href="#overview">Dashboard Overview</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#events">Events</a></li>
        <li><a href="#tasks">Tasks</a></li>
        <li><a href="#analytics">Analytics</a></li>
        <li><a href="#settings">Settings</a></li>
      </ul>
      <!-- Link to the separate Generate Layout file -->
      <a id="autoLayoutBtn" class="generate-btn" href="final_automatic_layout.html">Generate Automatic Layout</a>
      <a class="generate-btn" href="customized_layout.html">Generate Cutsom Layout</a>
    </aside>

    <!-- Main Content Area -->
    <div class="content">
      <!-- Header with logo and top navigation -->
      <div class="header">
        <div class="logo">Organizer Dashboard</div>
        <nav>
          <a href="organizer_profile.php">Profile</a>
          <a href="#notifications">Notifications</a>
          <a href="logout.php">Logout</a>
        </nav>
      </div>

      <!-- Dashboard Overview Section -->


      <section id="overview">
        <h1 style="color:#3b5d50; font-weight:700;">Welcome to ExpoMatrix Organizer</h1>
        <p>Manage your events, projects, and more with an intuitive dashboard that adapts to your workflow.</p>
        Animated Dashboard Cards
        <div class="card-container">
          <div class="card upcoming">
            <h3>Upcoming Events</h3>
            <p>5 events scheduled this month</p>
          </div>
          <div class="card active">
            <h3>Active Projects</h3>
            <p>3 projects in progress</p>
          </div>
          <div class="card pending">
            <h3>Pending Tasks</h3>
            <p>12 tasks waiting for review</p>
          </div>
        </div>
      </section>

      <!-- Additional Sections (Projects, Events, etc.) can be added here -->
    </div>

  </div>


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
              <script>
                document.write(new Date().getFullYear());
              </script>. All Rights Reserved. &mdash;
              Designed with love by <a href="https://untree.co">Expometrix</a> Distributed By <a
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

</body>

</html>