<?php 
include "validation/validation.php";
include "func_control.php";

extract($_POST);

$users = json_decode(read_json('users/users.json'),true);

if (username_login($users,$Uname_log) !== true) {
    foreach ($users as $value) {
        // echo $value['Password'].'<br>';
        // echo $password_log;
        // exit();
        if ($value['Password'] !== $password_log) {
            $result = "You are not login";
            header("Location: ../viwe/login.php?result=$result");
            exit();
        }
    }
}else{
    $result = "You are not login";
    header("Location: ../viwe/login.php?result=$result");
    exit();
}
foreach ($users as $val) {
    if($val['Password'] === $password_log){
        session_start();
        $x = "You are login";
        $_SESSION["user"] = $Uname_log;
        header("Location: ../viwe/home.php?result_user=$x");
        exit();
    }
}