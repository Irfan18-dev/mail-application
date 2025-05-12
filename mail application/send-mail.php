<?php
include 'config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID
$email = $_SESSION['email'];
$result = $conn->query("SELECT id FROM users WHERE email='$email'");
$user = $result->fetch_assoc();
$sender_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $conn->query("INSERT INTO mails (sender_id, to_email, subject, message) VALUES ('$sender_id', '$to', '$subject', '$message')");
    $success = "Mail sent successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Send Mail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            <h4>Send Mail</h4>
          </div>
          <div class="card-body">
            <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
            <form method="POST">
              <div class="mb-3">
                <label>To</label>
                <input type="email" name="to" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100">Send Mail</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
