<?php
function getNextId($counterFile = 'contador_ID.txt') {
    
    if (!file_exists($counterFile)) {
        file_put_contents($counterFile, "0");
    }

   
    $last_id = (int)file_get_contents($counterFile);

    
    $new_id = $last_id + 1;

    
    file_put_contents($counterFile, $new_id);

    return $new_id;
}
?>
