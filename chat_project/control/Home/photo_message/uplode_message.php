<?php 

include "../../func_control.php";
session_start();
if(isset($_FILES['file']['name'])){
   make_each('user_photos');
   make_each('user_photos/'.$_SESSION['user']);
   /* Getting file name */

   $filename = random_name_image(12);

   /* Location */
   $location = PATH_INFO.'user_photos/'.$_SESSION['user'].'/'.$filename;
   $location_file = 'user_photos/'.$_SESSION['user'].'/'.$filename;
   $imageFileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);
   $file_size = $_FILES['file']['size'];


   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","png");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location.'.'.$imageFileType)){
            $response = $location_file.'.'.$imageFileType;
      }
      save_image_info($filename, $location_file, $imageFileType, $file_size);
      echo $response;
   }
}

// save photo info

function save_image_info($id, $loc, $type, $size)
{
    $image = [
        $_SESSION['user'] => str_replace('/',',',$loc),
        'type' => $type,
        'size' => $size
    ];
    $images = json_decode(read_json('messages/messages.json'),true);
    $images[$id] = $image;
    write_json(json_encode($images,JSON_PRETTY_PRINT),'messages/messages.json');
}
