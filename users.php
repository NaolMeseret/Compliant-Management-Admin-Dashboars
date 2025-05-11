<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();
checkAdmin(); // Only admin can manage users

$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add_user'])) {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $role = $conn->real_escape_string($_POST['role']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO users (full_name, username, email, password, role, status) 
                VALUES ('$full_name', '$username', '$email', '$password', '$role', '$status')";

    if ($conn->query($sql)) {
      $_SESSION['success'] = "User added successfully!";
      header("Location: users.php");
      exit();
    } else {
      $_SESSION['error'] = "Error adding user: " . $conn->error;
    }
  }
}

// Get users based on status filter
if ($status == 'all') {
  $sql = "SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC";
} else {
  $sql = "SELECT * FROM users WHERE status = '$status' AND role != 'admin' ORDER BY created_at DESC";
}

$result = $conn->query($sql);
$users = array();

while ($row = $result->fetch_assoc()) {
  $users[] = $row;
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
      <h1 class="h3 mb-0 text-gray-800">
        <?php
        if ($status == 'all') echo 'All Users';
        elseif ($status == 'active') echo 'Active Users';
        elseif ($status == 'inactive') echo 'Inactive Users';
        ?>
      </h1>
      <a href="users.php?action=add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="bi bi-person-plus text-white-50"></i> Add User
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

    <!-- Add User Form -->
    <?php if ($action == 'add'): ?>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Add New User</h6>
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
            <div class="form-group mb-3">
              <label for="role">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="user">User</option>
                <option value="subadmin">Sub-admin</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
            <a href="users.php" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    <?php else: ?>
      <!-- Users Table -->
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">
            <?php
            if ($status == 'all') echo 'All Users';
            elseif ($status == 'active') echo 'Active Users';
            elseif ($status == 'inactive') echo 'Inactive Users';
            ?>
          </h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-three-dots-vertical text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Filter Users:</div>
              <a class="dropdown-item" href="users.php">All Users</a>
              <a class="dropdown-item" href="users.php?status=active">Active</a>
              <a class="dropdown-item" href="users.php?status=inactive">Inactive</a>
            </div>
          </div>
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
                  <th>Role</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['full_name'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= ucfirst($user['role']) ?></td>
                    <td>
                      <span class="badge <?= $user['status'] == 'active' ? 'bg-success' : 'bg-secondary' ?>">
                        <?= ucfirst($user['status']) ?>
                      </span>
                    </td>
                    <td>
                      <a href="user-details.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="users.php?action=edit&id=<?= $user['id'] ?>" class="btn btn-sm btn-info">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <a href="users.php?action=delete&id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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