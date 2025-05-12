<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Fetch user ID from session email
$email = $_SESSION['email'];
$result = $conn->query("SELECT id FROM users WHERE email='$email'");
$user = $result->fetch_assoc();
$sender_id = $user['id'];

// Fetch sent mails for the logged-in user
$mails_result = $conn->query("SELECT * FROM mails WHERE sender_id='$sender_id'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sent Mails</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container mt-5">
    <h3 class="text-center mb-4">Sent Mails</h3>
    
    <!-- Display a message if no sent mails found -->
    <?php if ($mails_result->num_rows == 0): ?>
      <div class="alert alert-info text-center">
        No sent mails found.
      </div>
    <?php else: ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>To</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Sent At</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($mail = $mails_result->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($mail['to_email']); ?></td>
              <td><?php echo htmlspecialchars($mail['subject']); ?></td>
              <td><?php echo htmlspecialchars($mail['message']); ?></td>
              <td><?php echo $mail['sent_at']; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>
