<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Change - ExpoMatrix</title>
  <!-- Boxicons & Favicon -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="logowebsite.jpeg">
  <!-- Google Font: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap & Additional CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    /* Global Settings */
    body {
      font-family: "Inter", sans-serif;
      background-color: #eff2f1;
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px 15px;
    }

    /* ExpoMatrix-Themed Container */
    .container {
      background-color: #ffffff;
      padding: 30px 20px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      border: 2px solid #f9bf29; /* Accent color */
      position: relative;
      margin: 20px 0;
    }

    .container h1 {
      font-size: 24px;
      background-color: #3b5d50; /* Primary color */
      color: #fff;
      padding: 15px;
      border-radius: 10px 10px 0 0;
      margin: -30px -20px 25px -20px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
      color: #3b5d50;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #dce5e4;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 14px;
    }

    button[type="submit"] {
      background-color: #3b5d50;
      color: #ffffff;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #314d43;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .error {
      color: #e74c3c;
      font-size: 0.9rem;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <?php
  include("connection.php");
  $role2 = isset($_GET['role']) ? $_GET['role'] : '';
  $role2_encode = htmlspecialchars($role2);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $cur_email = isset($_POST['email']) ? $_POST['email'] : '';
      $new_pass = isset($_POST['new_pass']) ? $_POST['new_pass'] : '';
      $conf_pass = isset($_POST['con_new_pass']) ? $_POST['con_new_pass'] : '';

      if ($role2_encode == "organizer") {
          if ($new_pass == $conf_pass) {
              $chng_pass_query = "UPDATE organizer SET Passwo='$new_pass' WHERE Email='$cur_email'";
              $chng_pass_query_run = mysqli_query($conn, $chng_pass_query);
              if ($chng_pass_query_run) {
                  echo "<p style='color: #3b5d50; font-weight:600;'>Password Changed Successfully</p>";
                  echo "<script>window.location.href = 'login.php';</script>";
              } else {
                  echo "<p class='error'>Error in password change</p>";
              }
          } else {
              echo "<p class='error'>Passwords do not match</p>";
          }
      } else if ($role2_encode == "vendor") {
          if ($new_pass == $conf_pass) {
              $chng_pass_query = "UPDATE vendor SET password='$new_pass' WHERE Email='$cur_email'";
              $chng_pass_query_run = mysqli_query($conn, $chng_pass_query);
              if ($chng_pass_query_run) {
                  echo "<p style='color: #3b5d50; font-weight:600;'>Password Changed Successfully</p>";
                  echo "<script>window.location.href = 'login.php';</script>";
              } else {
                  echo "<p class='error'>Error in password change</p>";
              }
          } else {
              echo "<p class='error'>Passwords do not match</p>";
          }
      }
  }
  ?>
  <main>
    <div class="container">
      <h1>Change Password</h1>
      <form action="" method="post" name="change_password">
        <label>Enter Email Address</label>
        <input type="email" name="email" value="<?php echo isset($_GET['mail']) ? $_GET['mail'] : ''; ?>"><br>

        <label>Enter New Password</label>
        <input type="password" name="new_pass"><br>

        <label>Enter Confirm Password</label>
        <input type="password" name="con_new_pass"><br>

        <button type="submit" name="change_password">Update Password</button>
      </form>
    </div>
  </main>
  <!-- Scripts -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
  <script src="script.js"></script>
</body>

</html>
