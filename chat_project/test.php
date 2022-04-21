<?php 

// $a = file_get_contents("Data/messages/messages.json");
// $b = json_decode($a,true);

// print_r($b);
session_start();
echo json_encode($_SESSION['user']);