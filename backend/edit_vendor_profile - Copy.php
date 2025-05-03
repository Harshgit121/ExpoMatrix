<?php
session_start();
include("connection.php");

// Check if user is logged in and is an organizer
if (!isset($_SESSION['username12']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'vendor') {
    header("Location: login.php");
    exit();
}

// Get organizer data from database
$username = $_SESSION['username12'];
$sql = "SELECT * FROM vendor WHERE User_Name=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $vendor = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "Error retrieving profile data. Please login again.";
    header("Location: login.php");
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Prepare update query with proper parameter binding to prevent SQL injection
    $updateSql = "UPDATE vendor SET Full_Name=?, Email=?, Phone_Number=? WHERE User_Name=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssss", $fullName, $email, $phone, $username);
    
    if ($updateStmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: vendor_profile.php");
        exit();
    } else {
        $updateError = "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile - ExpoMatrix</title>
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

    /* Edit Profile Form */
    .edit-profile-container {
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
    .edit-profile-header {
      background-color: #3b5d50;
      padding: 30px;
      color: #ffffff;
      position: relative;
    }
    .edit-form {
      padding: 30px;
    }
    .form-group {
      margin-bottom: 25px;
    }
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #3b5d50;
    }
    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #dce5e4;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-group input:focus {
      border-color: #3b5d50;
      box-shadow: 0 0 0 3px rgba(59, 93, 80, 0.2);
      outline: none;
    }
    .btn-container {
      display: flex;
      gap: 15px;
      margin-top: 30px;
    }
    .save-btn {
      padding: 12px 25px;
      background-color: #f9bf29;
      color: #2f2f2f;
      border: none;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .save-btn:hover {
      background-color: #f8b810;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    .cancel-btn {
      padding: 12px 25px;
      background-color: #eff2f1;
      color: #3b5d50;
      border: none;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .cancel-btn:hover {
      background-color: #dce5e4;
    }
    .error-message {
      background-color: #ffebee;
      color: #c62828;
      padding: 12px 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .success-message {
      background-color: #e8f5e9;
      color: #2e7d32;
      padding: 12px 15px;
      border-radius: 5px;
      margin-bottom: 20px;
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

      <!-- Edit Profile Form -->
      <div class="edit-profile-container">
        <div class="edit-profile-header">
          <h1>Edit Your Profile</h1>
          <p>Update your personal information below</p>
        </div>
        
        <div class="edit-form">
          <?php if (isset($updateError)): ?>
            <div class="error-message">
              <?php echo $updateError; ?>
            </div>
          <?php endif; ?>
          
          <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
              <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
          <?php endif; ?>
          
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" value="<?php echo htmlspecialchars($vendor['User_Name']); ?>" disabled>
              <small>Username cannot be changed</small>
            </div>
            
            <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($vendor['Full_Name']); ?>" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($vendor['Email']); ?>" required>
            </div>
            
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($vendor['Phone_Number']); ?>" required>
            </div>
            
            <div class="btn-container">
              <a href="vendor_profile.php" class="cancel-btn">Cancel</a>
              <button type="submit" name="update_profile" class="save-btn">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>