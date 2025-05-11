<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();
checkAdmin();

$users = $conn->query("SELECT * FROM users WHERE status = 'inactive'");

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
  <?php include 'includes/topnav.php'; ?>

  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Inactive Users</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                  <td><?= $user['id'] ?></td>
                  <td><?= $user['full_name'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= ucfirst($user['role']) ?></td>
                  <td>
                    <a href="user-activate.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-success">Activate</a>
                    <a href="user-delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>