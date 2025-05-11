<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
checkAuth();

// Get all complaints
$sql = "SELECT c.id, c.complaint_id, u.name as user_name, cat.name as category, c.status, c.created_at 
        FROM complaints c
        JOIN users u ON c.user_id = u.id
        JOIN categories cat ON c.category_id = cat.id
        ORDER BY c.created_at DESC";
$result = $conn->query($sql);
$complaints = [];
if ($result) {
  while ($row = $result->fetch_assoc()) {
    $complaints[] = $row;
  }
}

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<!-- Main Content -->
<div class="main-content" id="main-content">
  <!-- Top Navigation (same as dashboard) -->
  <?php include 'includes/topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Complaints</h1>
      <a href="complaints-add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="bi bi-plus-circle text-white-50"></i> Add Complaint
      </a>
    </div>

    <!-- DataTable -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Complaints List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($complaints as $complaint): ?>
                <tr>
                  <td>#<?= $complaint['complaint_id'] ?></td>
                  <td><?= $complaint['user_name'] ?></td>
                  <td><?= $complaint['category'] ?></td>
                  <td>
                    <?php
                    $badgeClass = '';
                    switch ($complaint['status']) {
                      case 'Pending':
                        $badgeClass = 'bg-warning text-dark';
                        break;
                      case 'In Process':
                        $badgeClass = 'bg-info';
                        break;
                      case 'Resolved':
                        $badgeClass = 'bg-success';
                        break;
                      case 'Rejected':
                        $badgeClass = 'bg-danger';
                        break;
                    }
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= $complaint['status'] ?></span>
                  </td>
                  <td><?= date('M d, Y', strtotime($complaint['created_at'])) ?></td>
                  <td>
                    <a href="complaint-details.php?id=<?= $complaint['id'] ?>" class="btn btn-sm btn-primary">
                      <i class="bi bi-eye"></i> View
                    </a>
                    <a href="complaint-edit.php?id=<?= $complaint['id'] ?>" class="btn btn-sm btn-info">
                      <i class="bi bi-pencil"></i> Edit
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>
</div>

<?php require_once 'includes/footer-scripts.php'; ?>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>