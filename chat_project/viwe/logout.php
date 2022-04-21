<?php
session_start();
$_SESSION['read'] = $_SESSION['user'];
unset($_SESSION['user']);
header("Location: login.php");

