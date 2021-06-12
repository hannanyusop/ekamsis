<?php

require_once '../env.php';

    if(isset($_POST['register'])){

        #check if email is unique

        $fullname = strtoupper($_POST['fullname']);
        $matric_number = $_POST['matric_number'];
        $email = $matric_number."@".$GLOBALS['student_mail_domain'];
        $phone_number = $_POST['phone_number'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Ops! invalid email!');window.location='register.php '</script>";
            exit();
        }

        $user_q = $db->query("SELECT * FROM users WHERE email='$_POST[email]'");
        $user = $user_q->fetch_assoc();


        if($user){
            echo "<script>alert('Email already exist!');window.location='register.php'</script>";
        }



        $password = $_POST['password'];
        $token = sha1(mt_rand(1, 90000) . 'SALT');

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        if (!$db->query("INSERT INTO users (email, matric_number, fullname, password, phone_number,verify_token) VALUES ('$email', '$matric_number','$fullname','$hash_pass', '$phone_number', '$token')")) {
            echo "Error: Inserting user data." . $db->error; exit();
        }else{

            $link = $GLOBALS['APP_URL'].'auth/validate.php?token='.$token;

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


            sendEmail($email, "Verify Account", $body);
            echo "<script>alert('Your account successfully registered! We\'ve send account verification trough your email');window.location='login.php '</script>";
        }

    }

?>