<?php
 

function random_string_old($length_of_string) {
    
    return substr(md5(time()), 0, $length_of_string);
}
  
?>