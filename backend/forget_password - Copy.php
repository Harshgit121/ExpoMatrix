<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forget Password - ExpoMatrix</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="logowebsite.jpeg">
  <!-- Google Font: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    /* Global & Body Settings */
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
      border: 2px solid #f9bf29;
      position: relative;
      margin: 20px 0;
    }

    .container h1 {
      font-size: 24px;
      background-color: #3b5d50;
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

    input[type="email"] {
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
  $role = isset($_GET['user_type']) ? $_GET['user_type'] : '';
  ?>
  <main>
    <div class="container">
      <h1>Forget Password</h1>
      <form name="Reset_Password" action="reset_password_code.php?role=<?php echo urlencode($role); ?>" method="post" onsubmit="return validateForm()">
        <label for="emailid">Email Id:</label>
        <input type="email" name="email1" id="email1">
        <span id="emailError" class="error"></span>
        <button type="submit" name="forget_pass">Send Password Reset Link</button>
      </form>
    </div>
  </main>

  <script>
    function validateForm() {
      var email = document.getElementById("email1").value;
      var emailError = document.getElementById("emailError");
      var emailPattern = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
      if (email === "") {
        emailError.textContent = "Email cannot be blank.";
        return false;
      } else if (!emailPattern.test(email)) {
        emailError.textContent = "Invalid email format.";
        return false;
      } else {
        emailError.textContent = "";
        return true;
      }
    }
  </script>
  <!-- Include Bootstrap JS and other scripts if necessary -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
  <script src="script.js"></script>
</body>

</html>
