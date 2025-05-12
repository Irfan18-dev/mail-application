<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<pre>"; print_r($user); echo "</pre>";  // DEBUG
        if (password_verify($password, $user['password'])) {
            echo "✅ Password match<br>"; // DEBUG
            $_SESSION['email'] = $email;
            header("Location: send-mail.php");
            exit();
        } else {
            echo "❌ Incorrect password<br>"; // DEBUG
            $error = "Incorrect password.";
        }
    } else {
        echo "❌ Email not found<br>"; // DEBUG
        $error = "No user found with this email.";
    }
}

    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['email'] = $email;
        header("Location: send-mail.php");
        exit();
    } else {
        $error = "Invalid password.";
    }
} else {
    $error = "No user found with that email.";
}
    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: send-mail.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mail App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
      background-size: cover;
      -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
    }

    .card {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(4px);
      border-radius: 15px;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.7);
      border: 1px solid #ccc;
    }

    .card-header {
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    label {
      font-weight: 500;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            <h4>Login</h4>
          </div>
          <div class="card-body">
            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST">
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
              <a href="register.php">Don't have an account? Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
