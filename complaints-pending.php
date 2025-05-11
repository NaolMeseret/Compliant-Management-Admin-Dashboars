<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();

$complaints = $conn->query("
    SELECT c.*, u.full_name 
    FROM complaints c
    JOIN users u ON c.user_id = u.id
    WHERE c.status = 'pending'
    ORDER BY c.created_at DESC
");

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
  <?php include 'includes/topnav.php'; ?>

  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pending Complaints</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($complaint = $complaints->fetch_assoc()): ?>
                <tr>
                  <td>#<?= $complaint['complaint_id'] ?></td>
                  <td><?= $complaint['title'] ?></td>
                  <td><?= $complaint['full_name'] ?></td>
                  <td><?= $complaint['category'] ?></td>
                  <td><?= date('M d, Y', strtotime($complaint['created_at'])) ?></td>
                  <td>
                    <a href="complaint-view.php?id=<?= $complaint['id'] ?>" class="btn btn-sm btn-primary">View</a>
                    <a href="complaint-process.php?id=<?= $complaint['id'] ?>" class="btn btn-sm btn-info">Start Process</a>
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