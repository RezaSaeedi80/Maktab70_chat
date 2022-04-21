<?php
include "../control/func_control.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../output.css">

</head>

<body>
    <div class="container-chat">
        <!-- chat room navbar -->
        <div class="navbar">
            <div class="links">
                <span class="font-[600]">Chat Room</span>
                <a href="logout.php">Logout</a>
                <a href="#">test</a>
                <a href="#">test</a>
            </div>
        </div>

        <!-- show user status -->
        <?php if (is_dir(PATH_INFO . 'messages')) {
            $messages = json_decode(read_json("messages/messages.json", true));
        } ?>
        <?php if (is_dir(PATH_INFO . 'users')) {
            $users = json_decode(read_json("users/users.json", true)); ?>
            <?php session_start(); ?>
            <div class="container-users">
                <div class="user-show">
                    <?php if (isset($users)) {
                        foreach($users as $key => $value) { ?>
                            <div class="show-user-info">
                                <div class="item-user">
                                    <div class="container-status">
                                        <img src="user_default.png" alt="">

                                        <span class="status<?php if ($_SESSION['user'] === $key) {
                                                        echo ' bg-green-400';
                                                    } else {
                                                        echo ' bg-gray-400';
                                                    } ?>">&nbsp;</span>
                                    </div>
                                    <span class="user-name"><?php echo $key ?></span>
                                </div>
                                
                                <div class="item-user">
                                    <?php if($_SESSION['user'] === 'admin') { ?>
                                    <button id="<?php echo 'block'.'_'.$key ?>" value="<?php echo $key ?>" onclick="User_block(this)">
                                    <svg class="h-8 w-8 text-red-300 icon-block"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                    </button>

                                    <button id="<?php echo 'unblock'.'_'.$key ?>" value="<?php echo $key ?>" onclick="User_unblock(this)">
                                    <svg class="h-8 w-8 text-green-300 icon-unblock"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">  
                                    <path stroke="none" d="M0 0h24v24H0z"/>  
                                    <circle cx="12" cy="12" r="9" />  <path d="M9 12l2 2l4 -4" /></svg>
                                    </button>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                <?php }
                    }
                } ?>
                </div>
            </div>

            <!-- Main(chat box) -->
            <div class="chat">
                <div class="main-chat" id="main-chat">

                    <!-- container message -->
                    <div class="container-message" id="messages">
                        <?php if (!empty($messages)) { ?>
                            <?php foreach ($messages as  $key => $value) {
                                $val_arr = json_decode(json_encode($value), true);
                                if (strlen($key) === 10) { ?>

                                    <!-- container text -->
                                    <div id="<?php echo $key ?>" class="message-show<?php if (key($value) === $_SESSION['user']) {
                                                                                        echo ' bg-green-400';
                                                                                    } else {
                                                                                        echo ' bg-gray-300';
                                                                                    } ?>">
                                        <?php foreach ($val_arr as $k => $val) { ?>
                                            <span class="main-text-message<?php if (key($value) === $_SESSION['user']) {
                                                                                echo ' text-white';
                                                                            } ?>" id="<?php echo '0' . $key ?>" <?php echo $key . ' : ' . $val ?>><?php echo $k . ' : ' . $val ?></span>
                                            <?php if ($k === $_SESSION['user'] || $_SESSION['user'] === 'admin') { ?>
                                                <button id="<?php echo '_' . $key ?>" onclick="remove_li(this)">
                                                    <svg class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>

                                                </button>
                                                <button onclick="edit_li(this)" id="<?php echo '!' . $key ?>" value="<?php echo $key ?>">
                                                    <svg class="h-4 w-4 text-blue-500" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (strlen($key) === 12) { ?>

                                    <div id="<?php echo $key ?>" class="image-show <?php if (key($value) === $_SESSION['user']) {
                                                                                        echo ' bg-green-400';
                                                                                    } else {
                                                                                        echo ' bg-gray-300';
                                                                                    } ?>">
                                        <span class="message-show<?php if (array_keys($val_arr)[0] === $_SESSION['user']) {
                                                                        echo ' bg-green-400';
                                                                    } else {
                                                                        echo ' bg-gray-300';
                                                                    } ?>"><?php echo array_keys($val_arr)[0] ?>

                                        </span>
                                        <?php $loc = '../Data/' . str_replace(',', '/', $val_arr[array_keys($val_arr)[0]] . '.' . $val_arr['type']); ?>
                                        <img src="<?php echo $loc ?>" alt="">
                                        <?php if (array_keys($val_arr)[0] === $_SESSION['user'] || $_SESSION['user'] === 'admin') {?>
                                        <button id="<?php echo '%' . $key ?>" onclick="DELETE_Image(this)" value="<?php echo $key ?>">delete</button>
                                        <?php } ?>



                                    </div>
                                <?php } ?>
                            <?php } ?>


                        <?php } ?>
                    </div>
                </div>
                <!-- input message -->
                <div class="write-message">
                    <input type="text" id="message" name="messae" placeholder="Enter your message..." onkeydown="limit()" onkeyup="limit()">
                    <div class="btn-send w-10">
                        <!-- send message text -->
                        <button class="icon-send" id="btn-submit">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                            </svg>
                        </button>

                        <!-- uplode image -->
                        <button class="icon-send" id="image_uplode_btn" onclick="uplodeImage(this)">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17a5 5 0 01-.916-9.916 5.002 5.002 0 019.832 0A5.002 5.002 0 0116 17m-7-5l3-3m0 0l3 3m-3-3v12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
    </div>

    <!-- edit message(text) modal -->
    <div id="edit_modal" class="modal">

        <div class="edit-container">
            <span class="close" id="close_modal">&times;</span>
            <div class="item">
                <label for="edit-text">Please edit your message</label>
                <input type="text" id="edit-text" class="modal-input">
            </div>
            <button id="btn-edit" class="btn-modal" onclick="save_edit(this)" value="">Save</button>
        </div>

    </div>

    <!-- uplode box modal -->
    <div id="uplode-message" class="modal">

        <div class="edit-container">
            <span class="close" id="close_modal_uplode">&times;</span>
            <div class="item">
                <label for="uplode">Please select a photo</label>
                <input type="file" id="uplod" class="modal-input">
            </div>
            <button id="uplode-end" class="btn-modal" value="">Uplode</button>
        </div>

    </div>

    <!-- delete image modal(Now) -->
    <div id="delete_box" class="modal">

        <div class="edit-container">
            <span class="close" id="close_delete_box">&times;</span>
            <div class="item">
                <span>Do you want to delete this photo?</span>
            </div>
            <button id="remove_image" class="btn-modal" value="">Delete</button>
        </div>

    </div>

    <!-- delete image modal(old) -->
    <div id="delete_box_old" class="modal">

        <div class="edit-container">
            <span class="close" id="close_delete_old">&times;</span>
            <div class="item">
                <span>Do you want to delete this photo?</span>
            </div>
            <button id="remove_image_old" class="btn-modal">Delete</button>
        </div>

    </div>


    <script src="../control/show_message/show_message.js"></script>
    <script src="../control/show_message/show_message_photo.js"></script>
    <script src="../control/Home/block.js"></script>
</body>

</html>

<!-- https://www.tailwindtoolbox.com/icons -->