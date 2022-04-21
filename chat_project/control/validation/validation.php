<?php

// Register validation
function user_name($user_name){
    $flag = true;
    preg_match_all('/[^a-zA-Z0-9\_]/',$user_name,$result);
    if ((strlen($user_name) < 3 || strlen($user_name) > 32) || !empty($result[0])) {
        $flag = false;
    }
    return $flag;
}

function full_name($name)
{
    $flag = true;
    preg_match_all('/[^a-z\s]/',$name,$result);
    if ((strlen($name) < 3 || strlen($name) > 32) || !empty($result[0])) {
        $flag = false;
    }
    return $flag;
}

function equal_check($first,$second){
    $flag = true;
    if ($first === $second) {
        $flag = false;
    }
    return $flag;
}

// Login validation
function username_login($users,$user_name){
    $flag = true;
    foreach ($users as $key => $value) {
        if ($key === $user_name) {
            $flag = false;
        }
    }return $flag;
}


