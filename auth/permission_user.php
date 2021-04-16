<?php
	require_once '../../env.php';

    if(isset($_SESSION['auth'])){

        if($_SESSION['auth']['role'] != 'user'){
            session_destroy(); #delete all session
            echo "<script>alert('Access denied!');window.location='../login.php';</script>";
        }

    }else{
        echo "<script>alert('Session ended! Please re-login!');window.location='../login.php';</script>";
    }

    $user_id = $_SESSION['auth']['user_id'];

?>