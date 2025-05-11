<?php
require 'includes/config.php';
require 'includes/functions.php';
checkAuth();

// Get report data
$complaints_by_month = $conn->query("
    SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, 
           COUNT(*) AS total,
           SUM(status = 'resolved') AS resolved,
           SUM(status = 'pending') AS pending,
           SUM(status = 'in_process') AS in_process
    FROM complaints
    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
    ORDER BY month DESC
    LIMIT 12
");

$categories_stats = $conn->query("
    SELECT category, COUNT(*) AS total
    FROM complaints
    GROUP BY category
    ORDER BY total DESC
");

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
  <?php include 'includes/topnav.php'; ?>

  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Reports</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="generateReport">
        <i class="bi bi-download text-white-50"></i> Generate PDF
      </a>
    </div>

    <div class="row">
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Complaints by Month</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="complaintsChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories Distribution</h6>
          </div>
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="categoriesChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detailed Statistics</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Month</th>
                <th>Total</th>
                <th>Resolved</th>
                <th>Pending</th>
                <th>In Process</th>
                <th>Resolution Rate</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $complaints_by_month->fetch_assoc()): ?>
                <tr>
                  <td><?= date('F Y', strtotime($row['month'])) ?></td>
                  <td><?= $row['total'] ?></td>
                  <td><?= $row['resolved'] ?></td>
                  <td><?= $row['pending'] ?></td>
                  <td><?= $row['in_process'] ?></td>
                  <td><?= round(($row['resolved'] / $row['total']) * 100, 2) ?>%</td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Complaints by month chart
  var ctx = document.getElementById('complaintsChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        <?php
        $complaints_by_month->data_seek(0);
        while ($row = $complaints_by_month->fetch_assoc()):
          echo "'" . date('M Y', strtotime($row['month'])) . "',";
        endwhile;
        ?>
      ],
      datasets: [{
        label: 'Total Complaints',
        data: [
          <?php
          $complaints_by_month->data_seek(0);
          while ($row = $complaints_by_month->fetch_assoc()):
            echo $row['total'] . ",";
          endwhile;
          ?>
        ],
        backgroundColor: 'rgba(78, 115, 223, 0.5)'
      }]
    }
  });

  // Categories pie chart
  var ctx2 = document.getElementById('categoriesChart').getContext('2d');
  var chart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: [
        <?php while ($row = $categories_stats->fetch_assoc()):
          echo "'" . $row['category'] . "',";
        endwhile;
        ?>
      ],
      datasets: [{
        data: [
          <?php
          $categories_stats->data_seek(0);
          while ($row = $categories_stats->fetch_assoc()):
            echo $row['total'] . ",";
          endwhile;
          ?>
        ],
        backgroundColor: [
          '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
          '#858796', '#5a5c69', '#3a3b45', '#2e2f3a', '#1a1c23'
        ]
      }]
    }
  });
</script>

<?php include 'includes/footer.php'; ?>