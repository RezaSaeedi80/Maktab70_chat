<?php 

include "../func_control.php";
session_start();

$message = json_decode(read_json('messages/messages.json'),true);

foreach ($message as $key => &$value) {
    if ($key === $_POST['id_js']) {
        if ($_SESSION['user'] === 'admin') {
            $val = array_key_first(json_decode(json_encode($value), true));
            if ($val === 'admin') {
                $message[$key][$_SESSION['user']] = $_POST['message_edit'];
                write_json(json_encode($message,JSON_PRETTY_PRINT),'messages/messages.json');
                exit;
            }else {
                $message[$key][$val] = $_POST['message_edit'];
                write_json(json_encode($message,JSON_PRETTY_PRINT),'messages/messages.json');
                exit;
            }

        }else {
            $message[$key][$_SESSION['user']] = $_POST['message_edit'];
            write_json(json_encode($message,JSON_PRETTY_PRINT),'messages/messages.json');
            exit;
        }
        
    }
}    

