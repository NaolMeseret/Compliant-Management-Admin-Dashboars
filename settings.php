<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();
checkAdmin(); // Only admin can change settings

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['update_settings'])) {
    $site_name = $conn->real_escape_string($_POST['site_name']);
    $site_email = $conn->real_escape_string($_POST['site_email']);
    $items_per_page = (int)$_POST['items_per_page'];

    // In a real application, you would save these to a settings table
    $_SESSION['success'] = "Settings updated successfully!";
    header("Location: settings.php");
    exit();
  }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="main-content" id="main-content">
  <!-- Top Navigation -->
  <nav class="navbar navbar-expand topbar mb-4 static-top shadow">
    <!-- Same as dashboard.php -->
  </nav>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">System Settings</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success"><?= $_SESSION['success'];
                                        unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error'];
                                      unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Settings Form -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group mb-3">
            <label for="site_name">Site Name</label>
            <input type="text" class="form-control" id="site_name" name="site_name" value="Complaint Management System">
          </div>
          <div class="form-group mb-3">
            <label for="site_email">Site Email</label>
            <input type="email" class="form-control" id="site_email" name="site_email" value="admin@complaintsystem.com">
          </div>
          <div class="form-group mb-3">
            <label for="items_per_page">Items Per Page</label>
            <select class="form-control" id="items_per_page" name="items_per_page">
              <option value="10">10</option>
              <option value="25" selected>25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
          <button type="submit" name="update_settings" class="btn btn-primary">Save Settings</button>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>

<?php include 'includes/footer.php'; ?>