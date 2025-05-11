<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();
checkAdmin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $conn->real_escape_string($_POST['name']);

  $sql = "INSERT INTO states (name) VALUES ('$name')";

  if ($conn->query($sql)) {
    $_SESSION['success'] = "State added!";
    header("Location: states.php");
    exit();
  }
}

$states = $conn->query("SELECT * FROM states");

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
  <?php include 'includes/topnav.php'; ?>

  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">States Management</h1>
      <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus"></i> Add State
      </button>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($state = $states->fetch_assoc()): ?>
                <tr>
                  <td><?= $state['id'] ?></td>
                  <td><?= $state['name'] ?></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add State</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>State Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>