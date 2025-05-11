<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// This will handle logout through includes/auth.php
header("Location: login.php");
exit();
