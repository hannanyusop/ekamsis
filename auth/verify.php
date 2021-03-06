<?php

require_once '../env.php';

if(isset($_POST['email']) && isset($_POST['password'])){

//    $hash_pass = password_hash("secret", PASSWORD_BCRYPT);
//    dd($hash_pass);
    $email = $_POST['email']; $password = $_POST['password'];

    $domain = getEmailDomain($email);
    if(in_array($domain, $GLOBALS['allowed_mail_domain'])){

        if($domain == $GLOBALS['student_mail_domain']){
            #student

            $result = $db->query("SELECT * FROM users WHERE email='$email'");
            $user = $result->fetch_assoc();

            if($user){

                #check password hashing
                if (password_verify($password, $user['password'])) {

                    if($user['verified_at'] == null){
                        echo "<script>alert('You need to verify account first.!');window.location='login.php'</script>";
                        exit();
                    }

                    $_SESSION['auth'] = [
                        'user_id' => (int)$user['id'],
                        'fullname' => $user['fullname'],
                        'role' => 'user'
                    ];

                    header('Location:student/index.php');

                }else{
                    echo "<script>alert('Invalid Password!');window.location='login.php'</script>";
                }
            }else{
                echo "<script>alert('Invalid student email!');window.location='login.php'</script>";

            }

        }else{

            #staff
            $result = $db->query("SELECT * FROM staff WHERE email='$email'");
            $user = $result->fetch_assoc();

            if($user){

                #check password hashing
                if (password_verify($password, $user['password'])) {

                    $_SESSION['auth'] = [
                        'user_id' => (int)$user['id'],
                        'fullname' => $user['fullname'],
                        'role' => $user['role']
                    ];

                    header('Location:staff/index.php');

                }else{
                    echo "<script>alert('Invalid Password!');window.location='login.php'</script>";
                }
            }else{
                echo "<script>alert('Invalid staff email!');window.location='login.php'</script>";
            }
        }

    }

    echo "<script>alert('Invalid Email!');window.location='login.php'</script>";
}else{
    header('Location:login.php');
}
?>