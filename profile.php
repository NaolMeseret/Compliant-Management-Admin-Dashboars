<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $full_name = $conn->real_escape_string($_POST['full_name']);
  $email = $conn->real_escape_string($_POST['email']);
  $user_id = $_SESSION['user_id'];

  // Handle password change if provided
  if (!empty($_POST['new_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Verify current password
    $user = $conn->query("SELECT password FROM users WHERE id = $user_id")->fetch_assoc();
    if (password_verify($current_password, $user['password'])) {
      $conn->query("UPDATE users SET password = '$new_password' WHERE id = $user_id");
      $_SESSION['success'] = "Password updated successfully!";
    } else {
      $_SESSION['error'] = "Current password is incorrect!";
    }
  }

  // Update profile info
  $conn->query("UPDATE users SET full_name = '$full_name', email = '$email' WHERE id = $user_id");
  $_SESSION['full_name'] = $full_name;
  $_SESSION['success'] = "Profile updated successfully!";
  header("Location: profile.php");
  exit();
}

$user = $conn->query("SELECT * FROM users WHERE id = {$_SESSION['user_id']}")->fetch_assoc();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
  <?php include 'includes/topnav.php'; ?>

  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow mb-4">
          <div class="card-body text-center">
            <img class="img-profile rounded-circle mb-3" src="assets/images/profile.jpg" width="150" height="150">
            <h4><?= $user['full_name'] ?></h4>
            <p class="text-muted"><?= ucfirst($user['role']) ?></p>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-body">
            <form method="POST">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= $user['full_name'] ?>" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" value="<?= $user['username'] ?>" readonly>
              </div>

              <hr>

              <h5>Change Password</h5>
              <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control">
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control">
              </div>
              <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>