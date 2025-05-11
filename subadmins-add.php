<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();
checkAdmin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $full_name = $conn->real_escape_string($_POST['full_name']);
  $username = $conn->real_escape_string($_POST['username']);
  $email = $conn->real_escape_string($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (full_name, username, email, password, role) 
            VALUES ('$full_name', '$username', '$email', '$password', 'subadmin')";

  if ($conn->query($sql)) {
    $_SESSION['success'] = "Sub-admin added successfully!";
    header("Location: subadmins.php");
    exit();
  } else {
    $_SESSION['error'] = "Error: " . $conn->error;
  }
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
  <!-- Top Navigation -->
  <?php include 'includes/topnav.php'; ?>

  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Add New Sub-admin</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Sub-admin</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>