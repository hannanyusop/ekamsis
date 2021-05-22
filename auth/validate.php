<?php

require_once '../env.php';

    if(isset($_GET['token'])){

        $token = $_GET['token'];

        $user_q = $db->query("SELECT * FROM users WHERE verify_token='$token'");
        $user = $user_q->fetch_assoc();

        if(!$user) {
            echo "<script>alert('Invalid url!');window.location='resend-verification.php'</script>";
        }


        if (!$db->query("UPDATE users SET verify_token=null,verified_at=NOW() WHERE id='$user[id]'")) {
            echo "Error: Inserting user data." . $db->error; exit();
        }else{

            echo "<script>alert('Your account successfully verified!');window.location='login.php '</script>";
        }

    }

?>