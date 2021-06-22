<?php

require_once 'env.php';

$body = "Test email";


sendEmail($GLOBALS['email_test'], "Activate $GLOBALS[APP_NAME] Account", $body);
echo "<script>alert('Your account successfully registered! We have send activation link to your email');</script>";

