<?php 
include "func_control.php";
include "validation/validation.php";

make_each('users');
make_each('users/users.json',true);

extract($_POST);
$users = json_decode(read_json('users/users.json'),true);
if (empty($users)) {
    if ((full_name($Fname) === false) || (user_name($Uname) === false) || (strlen($password) < 4  || strlen($password) > 32)) {
        $result = "The written format of the entered information in not correct";
        header("Location: ../viwe/register.php?result=$result");
        exit();
    }
    else {
        save_user($Uname,$Fname,$email,$password);
        session_start();
        $x = "You are login";
        $_SESSION["user"] = $Uname;
        header("Location: ../viwe/home.php?result_user=$x");
        exit();    
    }
}
$users = json_decode(read_json('users/users.json'),true);

foreach ($users as $key => $value) {

    if ($key === $Uname) {
        $result = "username is invalid";
        header("Location: ../viwe/register.php?result=$result");
        exit();
    }
    elseif ($value['Email'] === $email) {
        $result = "Your email address invalid";
        header("Location: ../viwe/register.php?result=$result");
        exit();    
    }elseif ((full_name($Fname) === false) || (user_name($Uname) === false) || (strlen($password) < 4  || strlen($password) > 32)) {
        $result = "The written format of the entered information in not correct";
        header("Location: ../viwe/register.php?result=$result");
        exit();
    }else {
        save_user($Uname,$Fname,$email,$password);
        session_start();
        $x = "You are login";
        $_SESSION["user"] = $Uname;
        header("Location: ../viwe/home.php?result_user=$x");
        exit();    
    }
}
// foreach ($users as $key => $value) {
//     if ($key === $Uname || user_name($Uname) === false) {
        // $result = "username is invalid";
        // header("Location: ../viwe/register.php?result=$result");
        // exit();
//     }elseif (full_name($Fname) === false) {
        // $result = "Your name invalid";
        // header("Location: ../viwe/register.php?result=$result");
        // exit();
//     }elseif ($value['Email'] === $email) {
        // $result = "Your email address invalid";
        // header("Location: ../viwe/register.php?result=$result");
        // exit();
//     }elseif (strlen($password) < 4  || strlen($password) > 32) {
//         $result = "Your password invalid";
//         header("Location: ../viwe/register.php?result=$result");
//         exit();
//     }

//     else {
        // save_user($Uname,$Fname,$email,$password);
        // session_start();
        // $x = "You are login";
        // $_SESSION["user"] = $Uname;
        // header("Location: ../viwe/home.php?result_user=$x");
        // exit();
//     }
// }
    
