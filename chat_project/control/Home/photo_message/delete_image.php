<?php 
include "../../func_control.php";




$message = json_decode(read_json('messages/messages.json'),true);


if (isset($_POST['id_remove'])) {
    foreach ($message as $key => $value) {
        if ($key === $_POST['id_remove']) {
            $val_arr = json_decode(json_encode($value), true);
            $loc =  PATH_INFO.str_replace(',', '/', $val_arr[array_keys($val_arr)[0]] . '.' . $val_arr['type']);
            unlink($loc);
        }

    }
    unset($message[$_POST['id_remove']]);
}

write_json(json_encode($message,JSON_PRETTY_PRINT),'messages/messages.json');
