<?php

    $GLOBALS['db'] = $db = new mysqli("localhost", "root", "", "hostel");

    if($db->connect_error){
        header('Location: ../error.php');
    }

?>