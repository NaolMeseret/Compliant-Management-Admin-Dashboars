<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();
checkAdmin(); // Only admin can manage subadmins

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add_subadmin'])) {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, username, email, password, role, status) 
                VALUES ('$full_name', '$username', '$email', '$password', 'subadmin', 'active')";

    if ($conn->query($sql)) {
      $_SESSION['success'] = "Sub-admin added successfully!";
      header("Location: subadmins.php");
      exit();
    } else {
      $_SESSION['error'] = "Error adding sub-admin: " . $conn->error;
    }
  }
}

// Get all subadmins
$sql = "SELECT * FROM users WHERE role = 'subadmin' ORDER BY created_at DESC";
$result = $conn->query($sql);
$subadmins = array();

while ($row = $result->fetch_assoc()) {
  $subadmins[] = $row;
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
      <h1 class="h3 mb-0 text-gray-800">Sub-Admins</h1>
      <a href="subadmins.php?action=add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="bi bi-person-badge text-white-50"></i> Add Sub-admin
      </a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success"><?= $_SESSION['success'];
                                        unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error'];
                                      unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Add Subadmin Form -->
    <?php if ($action == 'add'): ?>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Add New Sub-admin</h6>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="form-group mb-3">
              <label for="full_name">Full Name</label>
              <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="form-group mb-3">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="add_subadmin" class="btn btn-primary">Add Sub-admin</button>
            <a href="subadmins.php" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    <?php else: ?>
      <!-- Subadmins Table -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">All Sub-Admins</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($subadmins as $subadmin): ?>
                  <tr>
                    <td><?= $subadmin['id'] ?></td>
                    <td><?= $subadmin['full_name'] ?></td>
                    <td><?= $subadmin['username'] ?></td>
                    <td><?= $subadmin['email'] ?></td>
                    <td>
                      <span class="badge <?= $subadmin['status'] == 'active' ? 'bg-success' : 'bg-secondary' ?>">
                        <?= ucfirst($subadmin['status']) ?>
                      </span>
                    </td>
                    <td>
                      <a href="subadmin-details.php?id=<?= $subadmin['id'] ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="subadmins.php?action=edit&id=<?= $subadmin['id'] ?>" class="btn btn-sm btn-info">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <a href="subadmins.php?action=delete&id=<?= $subadmin['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <!-- /.container-fluid -->
</div>

<?php include 'includes/footer.php'; ?>