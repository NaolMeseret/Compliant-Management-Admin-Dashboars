<!-- Sidebar -->
<?php
require("header.php");
?>
<div class="sidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
      <i class="bi bi-shield-lock"></i>
    </div>
    <div class="sidebar-brand-text mx-2">Admin Dash</div>
  </a>

  <hr class="sidebar-divider" />

  <div class="sidebar-heading">Core</div>

  <li class="nav-item">
    <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="../dashboard.php">
      <i class="bi bi-speedometer2"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider" />

  <div class="sidebar-heading">Management</div>

  <li class="nav-item">
    <a class="sidebar-link collapsed <?= strpos(basename($_SERVER['PHP_SELF']), 'complaints') !== false ? 'active' : '' ?>"
      href="#" data-bs-toggle="collapse" data-bs-target="#collapseComplaints" aria-expanded="false">
      <i class="bi bi-journal-text"></i>
      <span>Complaints</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <div id="collapseComplaints" class="collapse sidebar-dropdown">
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'complaints.php' ? 'active' : '' ?>"
        href="../complaints.php">All Complaints</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'complaints-pending.php' ? 'active' : '' ?>"
        href="../complaints-pending.php">Pending</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'complaints-inprocess.php' ? 'active' : '' ?>"
        href="../complaints-inprocess.php">In Process</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'complaints-resolved.php' ? 'active' : '' ?>"
        href="../complaints-resolved.php">Resolved</a>
    </div>
  </li>

  <li class="nav-item">
    <a class="sidebar-link collapsed <?= strpos(basename($_SERVER['PHP_SELF']), 'users') !== false ? 'active' : '' ?>"
      href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false">
      <i class="bi bi-people"></i>
      <span>Users</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <div id="collapseUsers" class="collapse sidebar-dropdown">
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>"
        href="../users.php">All Users</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'users-active.php' ? 'active' : '' ?>"
        href="../sers-active.php">Active</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'users-inactive.php' ? 'active' : '' ?>"
        href="../users-inactive.php">Inactive</a>
    </div>
  </li>

  <li class="nav-item">
    <a class="sidebar-link collapsed <?= strpos(basename($_SERVER['PHP_SELF']), 'subadmins') !== false ? 'active' : '' ?>"
      href="#" data-bs-toggle="collapse" data-bs-target="#collapseSubadmins" aria-expanded="false">
      <i class="bi bi-person-badge"></i>
      <span>Sub-Admins</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <div id="collapseSubadmins" class="collapse sidebar-dropdown">
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'subadmins.php' ? 'active' : '' ?>"
        href="../subadmins.php">All Sub-Admins</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'subadmins-add.php' ? 'active' : '' ?>"
        href="../subadmins-add.php">Add New</a>
    </div>
  </li>

  <hr class="sidebar-divider" />

  <div class="sidebar-heading">System</div>

  <li class="nav-item">
    <a class="sidebar-link collapsed <?= strpos(basename($_SERVER['PHP_SELF']), 'categories') !== false ||
                                        strpos(basename($_SERVER['PHP_SELF']), 'settings') !== false ? 'active' : '' ?>"
      href="#" data-bs-toggle="collapse" data-bs-target="#collapseSystem" aria-expanded="false">
      <i class="bi bi-gear"></i>
      <span>Configuration</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <div id="collapseSystem" class="collapse sidebar-dropdown">
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'active' : '' ?>"
        href="../categories.php">Categories</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'subcategories.php' ? 'active' : '' ?>"
        href="../subcategories.php">Subcategories</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'states.php' ? 'active' : '' ?>"
        href="../states.php">States</a>
      <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>"
        href="../settings.php">Settings</a>
    </div>
  </li>

  <hr class="sidebar-divider" />

  <div class="sidebar-heading">Reports</div>

  <li class="nav-item">
    <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : '' ?>" href="../reports.php">
      <i class="bi bi-graph-up"></i>
      <span>Reports</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'logs.php' ? 'active' : '' ?>" href="../logs.php">
      <i class="bi bi-clock-history"></i>
      <span>Activity Logs</span>
    </a>
  </li>

  <hr class="sidebar-divider d-none d-md-block" />

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</div>