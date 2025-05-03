<?php
session_start();
include("connection.php");

// Check if user is logged in and is an organizer
if (!isset($_SESSION['username12']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'vendor'){
    header("Location: login.php");
    exit();
}

// Get organizer data from database
$username = $_SESSION['username12'];
$sql = "SELECT * FROM vendor WHERE User_Name='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $vendor = $result->fetch_assoc();
} else {
    // Handle error - redirect to login
    $_SESSION['error'] = "Error retrieving profile data. Please login again.";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ExpoMatrix Organizer Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
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

    /* Profile Section */
    .profile-container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      animation: slideIn 0.8s ease-in-out;
    }
    @keyframes slideIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .profile-header {
      background-color: #3b5d50;
      padding: 30px;
      color: #ffffff;
      position: relative;
    }
    .profile-avatar {
      width: 100px;
      height: 100px;
      background-color: #f9bf29;  
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      font-weight: 700;
      color: #3b5d50;
      margin-bottom: 15px;
    }
    .profile-details {
      padding: 30px;
    }
    .profile-details h2 {
      color: #3b5d50;
      font-weight: 700;
      margin-bottom: 20px;
    }
    .profile-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .info-card {
      padding: 20px;
      background-color: #f5f5f5;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .info-card h3 {
      color: #3b5d50;
      font-size: 16px;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .info-card p {
      color: #6a6a6a;
      font-size: 18px;
      margin: 0;
    }
    .edit-profile-btn {
      display: inline-block;
      padding: 12px 25px;
      background-color: #f9bf29;
      color: #2f2f2f;
      border-radius: 30px;
      font-weight: 600;
      margin-top: 30px;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .edit-profile-btn:hover {
      background-color: #f8b810;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    .back-btn {
      display: inline-block;
      padding: 12px 25px;
      background-color: #eff2f1;
      color: #3b5d50;
      border-radius: 30px;
      font-weight: 600;
      margin-top: 30px;
      margin-right: 15px;
      transition: background-color 0.3s ease;
    }
    .back-btn:hover {
      background-color: #dce5e4;
    }
  </style>
</head>
<body>
  <div class="dashboard">
     <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <h2>ExpoMatrix Vendor</h2>
      <ul class="menu">
        <li><a href="#booked-stalls">Booked Stalls</a></li>
        <li><a href="#layout-explorer">Layout Explorer</a></li>
        <li><a href="#booking-requests">Booking Requests</a></li>
        <li><a href="#sort-filter">Sort & Filter</a></li>
        <li><a href="#account">Account</a></li>
      </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="content">
      <!-- Header -->
      <div class="header">
        <div class="logo">Vendor Dashboard</div>
        <nav>
          <a href="vendor_profile.php">Profile</a>
          <a href="#notifications">Notifications</a>
          <a href="logout.php">Logout</a>
        </nav>
      </div>

      <!-- Profile Content -->
      <div class="profile-container">
        <div class="profile-header">
          <div class="profile-avatar">
            <?php echo strtoupper(substr($vendor['Full_Name'], 0, 1)); ?>
          </div>
          <h1><?php echo htmlspecialchars($vendor['Full_Name']); ?></h1>
          <p>Vendor</p>
        </div>
        
        <div class="profile-details">
          <h2>Personal Information</h2>
          <div class="profile-info">
            <div class="info-card">
              <h3>Username</h3>
              <p><?php echo htmlspecialchars($vendor['User_Name']); ?></p>
            </div>
            <div class="info-card">
              <h3>Email Address</h3>
              <p><?php echo htmlspecialchars($vendor['Email']); ?></p>
            </div>
            <div class="info-card">
              <h3>Phone Number</h3>
              <p><?php echo htmlspecialchars($vendor['Phone_Number']); ?></p>
            </div>
            <!-- <div class="info-card">
              <h3>Member Since</h3>
              <p> 
                // If you have a registration date field in your database, use that
                // Otherwise, you could use the ID to estimate when they joined
                // echo "Active Member"; 
              ?></p>
            </div> -->
          </div>
          
          <a href="vendor_dashboard.php" class="back-btn">Back to Dashboard</a>
          <a href="edit_vendor_profile.php" class="edit-profile-btn">Edit Profile</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>