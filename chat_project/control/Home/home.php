<?php
include "../func_control.php";
include "../show_message/random_id_old.php";

$message = $_POST['message'];

make_each('messages');
make_each('messages/messages.json',true);

$id = random_string_old(10);

function save_message($message, $id)
{   
    session_start();
    $users = json_decode(read_json('messages/messages.json'),true);
    $user = $_SESSION['user'];

    $message = [
        $user => $message,
    ];

    $users[$id] = $message;
   
    write_json(json_encode($users,JSON_PRETTY_PRINT),'messages/messages.json');
}

save_message($message, $id);

