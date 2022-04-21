<?php
$server_root = str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);
define("PATH_INFO","$server_root/chat_project/Data/");

// read json file
function read_json($path)
{
    return file_get_contents(PATH_INFO.$path);
}

// write in json
function write_json($value,$path)
{
    file_put_contents(PATH_INFO.$path,$value);
}

// get value
function get_json($path)
{
    json_decode(read_json($path),true);
}

// save_in_json
function save_user($username,$fullname,$email,$password)
{
    $user = [
        'Fullname' => $fullname,
        'Email' => $email,
        'Password' => $password
    ];
    $users = json_decode(read_json('users/users.json'),true);
    $users[$username] = $user;
    write_json(json_encode($users,JSON_PRETTY_PRINT),'users/users.json');
}

// creat directory or file in your path
function make_each($path,$result = false){
    if ($result === false) {
        if (!is_dir(PATH_INFO.$path)) {
            mkdir(PATH_INFO.$path);
        }   
    }elseif ($result === true) {
        if (!is_file(PATH_INFO.$path)) {
            $x = fopen(PATH_INFO.$path,'w');
            fclose($x);
        }
    }
}

// random string
function random_str($len){
    $container_str = "";
    for ($i=0; $i < $len+1 ; $i++) { 
        $random = rand(65, 122);
        if ($random <= 90 || $random >= 97) {
            $container_str .= chr($random);
        }
    }
    return $container_str;
}

// serch

function serch_all($container, $item){
    $flag = false;
    foreach ($container as $value) {
        if ($item === $value) {
            $flag = true;
        }        
    }
    return $flag;
}

// serch user name in JSON FILE
function serch_username($container, $username){
    foreach ($container as $value) {
        if ($username === key($value)) {
            return true;
            exit;
        }
    }
};

// conter

function conter($array)
{
    $c = 0;
    foreach ($array as $key => $value) {
        $c++;
    }
    return $c;
}

// random uniqe string
 
// This function will return
// A random string of specified length
function random_name_image($length_of_string) {
    

// sha1 the timestamps and returns substring
// of specified length
    return substr(sha1(time()), 0, $length_of_string);
}