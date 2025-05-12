<?php
session_start();
session_destroy();
header("Location: login.html");
exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logged Out - Mail App</title>
  <meta http-equiv="refresh" content="2;url=login.php">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
      <h2 class="text-success">You have been logged out.</h2>
      <p class="text-muted">Redirecting to login page...</p>
    </div>
  </div>
</body>
</html>
