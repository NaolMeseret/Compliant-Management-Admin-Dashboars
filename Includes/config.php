<?php
session_start();

// Database configuration as variables
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'complaint_management';

// Create connection using variables
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Set timezone
date_default_timezone_set('UTC');

// Check if user is logged in for protected pages
function checkAuth()
{
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
  }
}

// Get complaint counts for dashboard
function getComplaintCounts($conn)
{
  $counts = [
    'total' => 0,
    'pending' => 0,
    'inprocess' => 0,
    'resolved' => 0
  ];

  $sql = "SELECT status, COUNT(*) as count FROM complaints GROUP BY status";
  $result = $conn->query($sql);

  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $counts['total'] += $row['count'];
      switch ($row['status']) {
        case 'Pending':
          $counts['pending'] = $row['count'];
          break;
        case 'In Process':
          $counts['inprocess'] = $row['count'];
          break;
        case 'Resolved':
          $counts['resolved'] = $row['count'];
          break;
      }
    }
  }

  return $counts;
}

// Get recent complaints for dashboard
function getRecentComplaints($conn, $limit = 5)
{
  $complaints = [];
  $sql = "SELECT c.id, c.complaint_id, u.name as user_name, cat.name as category, c.status 
            FROM complaints c
            JOIN users u ON c.user_id = u.id
            JOIN categories cat ON c.category_id = cat.id
            ORDER BY c.created_at DESC LIMIT $limit";
  $result = $conn->query($sql);

  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $complaints[] = $row;
    }
  }

  return $complaints;
}
