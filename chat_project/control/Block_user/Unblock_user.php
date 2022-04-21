<?php 

include "../func_control.php";


$users = json_decode(read_json('users/users.json'),true);


if (isset($_POST['un_block_name'])) {
    foreach ($users as $key => &$value) {
        if ($key === $_POST['un_block_name']) {
            unset($value['block']);
        }
    }    
}


write_json(json_encode($users,JSON_PRETTY_PRINT),'users/users.json');
