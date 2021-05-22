<?php

require_once '../env.php';

    if(isset($_POST['email'])){

        #check if email is unique

        $email = $_POST['email'];

        $user_q = $db->query("SELECT * FROM users WHERE email='$email'");
        $user = $user_q->fetch_assoc();


        if(!$user){
            echo "<script>alert('Email not found!');window.location='resend-verification.php'</script>";
        }

        if($user['verified_at'] != null){
            echo "<script>alert('This email already verify. Please login.!');window.location='resend-verification.php'</script>";
        }



        $password = 'secret';
        $token = sha1(mt_rand(1, 90000) . 'SALT');

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        if (!$db->query("UPDATE users SET password='$hash_pass',verify_token= '$token' WHERE id='$user[id]'")) {
            echo "Error: Inserting user data." . $db->error; exit();
        }else{

            $link = $GLOBALS['url'].'/auth/validate.php?token='.$token;

            $body = "Hello $user[fullname],<br><br>
            <p>This email has been registered to ".$GLOBALS['APP_NAME']."<br>Click this <a href='$link'>link</a> or copy<br>  <b>$link</b>
             <p>
             Email : $email<br>
             Password : $password</p><br>
            <br>
             <br>   and paste into your  browser if link not working<br>
            <br>Please change this password to keep your account safe.<br>
             If you not request this, please call Customer Service 06-425635654543.</p>
            <small>
                <i>This email was generated automatically by system. Don't reply this email
                    <br>For inquiry please call our Customer Service 06-425635654543</i>
            </small>
            </p>";


            sendEmail($email, "Verify Account", $body);
            echo "<script>alert('Your account successfully registered! We\'ve send account verification trough your email');window.location='login.php '</script>";
        }

    }

?>