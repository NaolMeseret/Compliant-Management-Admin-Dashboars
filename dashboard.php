<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
checkAuth();

$complaintCounts = getComplaintCounts($conn);
$recentComplaints = getRecentComplaints($conn);

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<!-- Main Content -->
<div class="main-content" id="main-content">
  <!-- Top Navigation -->
  <nav class="navbar navbar-expand topbar mb-4 static-top shadow">
    <div class="container-fluid">
      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="bi bi-list"></i>
      </button>

      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-search"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">3+</span>
          </a>
          <!-- Dropdown - Alerts -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Alerts Center</h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="me-3">
                <div class="icon-circle bg-primary">
                  <i class="bi bi-file-text text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500"><?= date('F j, Y') ?></div>
                <span class="font-weight-bold">A new complaint has been submitted!</span>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="me-3">
                <div class="icon-circle bg-success">
                  <i class="bi bi-check-circle text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500"><?= date('F j, Y', strtotime('-4 days')) ?></div>
                Complaint #1938 has been resolved.
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="me-3">
                <div class="icon-circle bg-warning">
                  <i class="bi bi-exclamation-triangle text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500"><?= date('F j, Y', strtotime('-9 days')) ?></div>
                Spending Alert: High number of pending complaints.
              </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
          </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-envelope"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter">7</span>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Message Center</h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image me-3">
                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                <div class="status-indicator bg-success"></div>
              </div>
              <div>
                <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                <div class="small text-gray-500">Emily Fowler · 58m</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image me-3">
                <img class="rounded-circle" src="https://source.unsplash.com/cssvEZacHvQ/60x60" alt="...">
                <div class="status-indicator"></div>
              </div>
              <div>
                <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                <div class="small text-gray-500">Jae Chun · 1d</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image me-3">
                <img class="rounded-circle" src="https://source.unsplash.com/IWLOvomUmWU/60x60" alt="...">
                <div class="status-indicator bg-warning"></div>
              </div>
              <div>
                <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
              </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="me-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
            <img class="img-profile rounded-circle" src="../assets/Images/naol.png">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">
              <i class="bi bi-person me-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="settings.php">
              <i class="bi bi-gear me-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="activity-log.php">
              <i class="bi bi-list-task me-2 text-gray-400"></i>
              Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="bi bi-box-arrow-right me-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="bi bi-download text-white-50"></i> Generate Report
      </a>
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Total Complaints Card -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card summary-card primary h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Total Complaints
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $complaintCounts['total'] ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-journal-text fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Complaints Card -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card summary-card warning h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Pending Complaints
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $complaintCounts['pending'] ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-hourglass-split fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- In Process Complaints Card -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card summary-card info h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  In Process Complaints
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $complaintCounts['inprocess'] ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-gear-wide-connected fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Resolved Complaints Card -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card summary-card success h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Resolved Complaints
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= $complaintCounts['resolved'] ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-check-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Complaints by Category Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Complaints Overview</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">View Options:</div>
                <a class="dropdown-item" href="#">Last 7 Days</a>
                <a class="dropdown-item" href="#">Last 30 Days</a>
                <a class="dropdown-item" href="#">This Year</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Export Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="complaintsChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row last-row">
      <!-- Recent Complaints -->
      <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recent Complaints</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="recentComplaints" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($recentComplaints as $complaint): ?>
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
                      <td>
                        <a href="complaint-details.php?id=<?= $complaint['id'] ?>" class="btn btn-sm btn-primary">
                          <i class="bi bi-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-info">
                          <i class="bi bi-forward"></i>
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

      <!-- System Status -->
      <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">System Status</h6>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <h4 class="small font-weight-bold">
                Server Load <span class="float-end">40%</span>
              </h4>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="mb-4">
              <h4 class="small font-weight-bold">
                Database Size <span class="float-end">65%</span>
              </h4>
              <div class="progress progress-sm">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="mb-4">
              <h4 class="small font-weight-bold">
                Storage Usage <span class="float-end">78%</span>
              </h4>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="mb-4">
              <h4 class="small font-weight-bold">
                Active Users <span class="float-end">12</span>
              </h4>
              <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="mb-4">
              <h4 class="small font-weight-bold">
                Uptime <span class="float-end">99.9%</span>
              </h4>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <a href="complaints-add.php" class="btn btn-primary btn-block">
                  <i class="bi bi-plus-circle"></i> Add Complaint
                </a>
              </div>
              <div class="col-md-6 mb-3">
                <a href="users-add.php" class="btn btn-success btn-block">
                  <i class="bi bi-person-plus"></i> Add User
                </a>
              </div>
              <div class="col-md-6 mb-3">
                <a href="subadmins-add.php" class="btn btn-info btn-block">
                  <i class="bi bi-person-badge"></i> Add Sub-admin
                </a>
              </div>
              <div class="col-md-6 mb-3">
                <a href="reports.php" class="btn btn-warning btn-block">
                  <i class="bi bi-graph-up"></i> Generate Report
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

  <!-- Footer -->
  <footer class="footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Complaint Management System <?= date('Y') ?></span>
      </div>
    </div>
  </footer>
</div>

<?php require_once 'includes/footer.php'; ?>