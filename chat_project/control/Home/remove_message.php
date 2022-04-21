<?php 

include "../func_control.php";


$message = json_decode(read_json('messages/messages.json'),true);


if (isset($_POST['id'])) {
    unset($message[$_POST['id']]);
}

// foreach ($message as $key => $value) {

// }

if (isset($_POST['id_2'])) {
    unset($message[$_POST['id_2']]);
}


write_json(json_encode($message,JSON_PRETTY_PRINT),'messages/messages.json');
