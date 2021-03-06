<?php

include_once 'db_config.php';
//https://app.diagrams.net/#G1f69diPwJGBw-CLK9TP6kVZAKhpVS6CXg
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function dd($var){

    var_dump($var); exit();
}

function checkDir($dir){

    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
}

function is_ok($ok){

    if(is_null($ok)){
        return  "";
    }
    return ($ok == 1)? "<span class='badge badge-success'>Ok</span>" : "<span class='badge badge-danger'>Broken</span>";
}

function isActive($ok){

    return ($ok == 1)? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>";
}

function photo($photo, $width = 100){

    if(is_null($photo)){
        return "- n/a -";
    }else{

        return  "<img class='img-fluid' src='$photo' width='$width'>";
    }
}

function getEmailDomain($email){

    $parts = explode("@",$email);
    return $parts[1];
}
function getBackendRole($role_id = null){

    $roles = [
        1 => 'MANAGER',
        2 => 'STAFF',
    ];

    if(is_null($role_id)){
        return $roles;
    }

    return $roles[$role_id];
}

function getOption($name, $default = ''){

    $option_q = $GLOBALS['db']->query("SELECT * FROM options WHERE name='$name'");
    $option = $option_q->fetch_assoc();

    if(!$option){
        return $default;
    }

    return $option['value'];

}

function sendEmail($recipient_email, $title = '', $body){

    $GLOBALS['smtp_username'] = 'ecenterprinting@yahoo.com';
    $GLOBALS['smtp_password'] = 'idwfwfybfmqgkgfc';
    $GLOBALS['smtp_host'] = 'smtp.mail.yahoo.com';


    if($GLOBALS['env'] != 'production'){
        $recipient_email = $GLOBALS['email_test'];
    }

    $mail = new PHPMailer(true);

    try {

        if($GLOBALS['env'] != 'production'){
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                           // Send using SMTP
        }
        //Server settings

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $GLOBALS['smtp_host'];                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $GLOBALS['smtp_username'];                     // SMTP username
        $mail->Password   = $GLOBALS['smtp_password'];                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('ecenterprinting@yahoo.com', 'nor-reply ECP');
        $mail->addAddress($recipient_email);     // Add a recipient

//    // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function generateResetPasswordKey() {
    $alphabet = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function generateConfirmationCode() {
    $alphabet = '1234567890987654321234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function getPrintingMode($mode = null){

    $modes = [
        1 => 'Colour',
        2 => 'Black & White'
    ];

    return (is_null($mode))? $modes : $modes[$mode];
}
function getCheckedAddOn($addOnId){

    return (isset($_SESSION['jobs'][$_SESSION['auth']['user_id']]['addOn'][$addOnId]))? 'CHECKED' : '';
}

function insertJobTransaction($job_id, $staff_id, $status, $note){


    $sql = "INSERT INTO job_transaction (job_id,staff_id,status,note) VALUES ($job_id, $staff_id, $status, '$note')";


    if (!$GLOBALS['db']->query($sql)) {
        echo "Error: " . $sql . "<br>" . $GLOBALS['db']->error; exit();
    }

    return true;

}

function getTrackListAccepted(){

    $statuses = [
        1 => 'You created a job.',
        2 => 'Your job has been received.',
        4 => 'Document is ready.',
        5 => 'Document has been picked.'
    ];

    return $statuses;

}

function insertNotification($user_id, $title, $message){

    $sql = "INSERT INTO notifications (user_id,seen,title,messages) VALUES ($user_id, 0, '$title', '$message')";

    if (!$GLOBALS['db']->query($sql)) {
        echo "Error: " . $sql . "<br>" . $GLOBALS['db']->error; exit();
    }
    return true;
}

function getTimeAgo($timestamp){

date_default_timezone_set("Asia/Kuala_Lumpur");
  $time_ago        = strtotime($timestamp);
  $current_time    = time();
  $time_difference = $current_time - $time_ago;
  $seconds         = $time_difference;

  $minutes = round($seconds / 60); // value 60 is seconds
  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
  $weeks   = round($seconds / 604800); // 7*24*60*60;
  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

  if ($seconds <= 60){

      return "Just Now";

  } else if ($minutes <= 60){

      if ($minutes == 1){

          return "one minute ago";

      } else {

          return "$minutes minutes ago";

      }

  } else if ($hours <= 24){

      if ($hours == 1){

          return "an hour ago";

      } else {

          return "$hours hrs ago";

      }

  } else if ($days <= 7){

      if ($days == 1){

          return "yesterday";

      } else {

          return "$days days ago";

      }

  } else if ($weeks <= 4.3){

      if ($weeks == 1){

          return "a week ago";

      } else {

          return "$weeks weeks ago";

      }

  } else if ($months <= 12){

      if ($months == 1){

          return "a month ago";

      } else {

          return "$months months ago";

      }

  } else {

      if ($years == 1){

          return "one year ago";

      } else {

          return "$years years ago";

      }
  }
}

function strLimit($string, $limit = 20){
    return (strlen($string) > $limit)?substr($string, 0, $limit) . '...' : $string ;
}

function getYear(){
    return range(2015, date('Y'));
}

function getGender($gender = null){

    $genders = [
        'M' => 'MALE',
        'F' => 'FEMALE'
    ];

    if(is_null($gender)){
        return  $genders;
    }else{

        if(isset($genders[$gender])){
            return $genders[$gender];
        }else{
            return " ";
        }
    }
}


