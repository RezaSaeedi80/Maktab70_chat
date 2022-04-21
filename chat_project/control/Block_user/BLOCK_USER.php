<?php 

include "../func_control.php";


$users = json_decode(read_json('users/users.json'),true);


if (isset($_POST['block_name'])) {
    $users[$_POST['block_name']]['block'] = true;    
}


write_json(json_encode($users,JSON_PRETTY_PRINT),'users/users.json');
