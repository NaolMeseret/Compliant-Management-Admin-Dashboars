<?php
require 'config.php';

// Handle login
if (isset($_POST['login'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);

  $sql = "SELECT id, username, password, role FROM users WHERE username = '$username'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      header("Location: dashboard.php");
      exit();
    }
  }

  $_SESSION['error'] = "Invalid username or password";
  header("Location: login.php");
  exit();
}

// Handle logout
if (isset($_GET['logout'])) {
  // Start session if not already started
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // Destroy all session data
  session_destroy();

  // Redirect to login page
  header("Location: ../login.php");
  exit();
}
