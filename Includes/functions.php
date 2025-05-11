<?php
require 'config.php';

// Get complaint stats
function getComplaintStats()
{
  global $conn;

  $stats = array();

  // Total complaints
  $sql = "SELECT COUNT(*) as total FROM complaints";
  $result = $conn->query($sql);
  $stats['total'] = $result->fetch_assoc()['total'];

  // Pending complaints
  $sql = "SELECT COUNT(*) as pending FROM complaints WHERE status = 'pending'";
  $result = $conn->query($sql);
  $stats['pending'] = $result->fetch_assoc()['pending'];

  // In process complaints
  $sql = "SELECT COUNT(*) as in_process FROM complaints WHERE status = 'in_process'";
  $result = $conn->query($sql);
  $stats['in_process'] = $result->fetch_assoc()['in_process'];

  // Resolved complaints
  $sql = "SELECT COUNT(*) as resolved FROM complaints WHERE status = 'resolved'";
  $result = $conn->query($sql);
  $stats['resolved'] = $result->fetch_assoc()['resolved'];

  return $stats;
}

// Get recent complaints
function getRecentComplaints($limit = 5)
{
  global $conn;

  $sql = "SELECT c.id, c.complaint_id, c.title, c.category, c.status, u.full_name 
            FROM complaints c 
            JOIN users u ON c.user_id = u.id 
            ORDER BY c.created_at DESC 
            LIMIT $limit";

  $result = $conn->query($sql);
  $complaints = array();

  while ($row = $result->fetch_assoc()) {
    $complaints[] = $row;
  }

  return $complaints;
}
