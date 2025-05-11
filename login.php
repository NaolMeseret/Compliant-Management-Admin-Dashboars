<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit();
}

if (isset($_POST['login'])) {
  // Authentication is handled in includes/auth.php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Complaint Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="Styles/admin.css">
  <style>
    .login-container {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fc;
    }

    .login-card {
      width: 400px;
      border: none;
      border-radius: 10px;
      box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .login-header {
      background-color: #4e73df;
      color: white;
      border-radius: 10px 10px 0 0;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="card login-card">
      <div class="card-header py-4 text-center login-header">
        <h4><i class="bi bi-shield-lock"></i> Complaint Management System</h4>
      </div>
      <div class="card-body p-5">
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="login.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
      <div class="card-footer text-center py-3">
        <small class="text-muted">Need help? Contact system administrator</small>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>