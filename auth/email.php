<?php

require_once '../env.php';

        $fullname = "Hannan Yusop";
        $matric_number = "B031910175";
        $email = $matric_number."@".$GLOBALS['student_mail_domain'];

        $password = randomPassword();
        $token = sha1(mt_rand(1, 90000) . 'SALT');

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $link = 'validate.php?token='.$token;

        $body = "Hello $fullname,<br><br>
            <p>This email has been registered to ".$GLOBALS['APP_NAME']."<br>Click this <a href='$link'>link</a> or copy<br>  <b>$link</b>
             <br>   and paste into your  browser if link not working<br>
            <br>Please change this password to keep your account safe.<br>
             If you not request this, please call Customer Service 06-425635654543.</p>
            
            <br><br>
            <small>
                <i>This email was generated automatically by system. Don't reply this email
                    <br>For inquiry please call our Customer Service 06-425635654543</i>
            </small>
            </p>";

        $x = sendEmail($email, "Account Verification", $body);

        dd($x);
?>