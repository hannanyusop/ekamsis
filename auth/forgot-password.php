<!DOCTYPE html>
<html lang="en">
<?php include('layout/head.php'); ?>

<?php

if(isset($_POST['email'])) {

    $email = $_POST['email'];

    $result = $db->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    $token = bin2hex(random_bytes(8));

    if ($user) {

        $result = $db->query("UPDATE users SET reset_token='$token' WHERE email='$email'");

        $link = $GLOBALS['APP_URL'].'auth/password.php?token='.$token;

        $body = "Hello $user[fullname],<br><br>
            <p> <br>Click this <a href='$link'>link</a> to reset password.
             <br>copy <b>$link</b> and paste into your  browser if link not working<br>
             If you not request this, please call Customer Service 06-425635654543.</p>
           
            <br><br>
            <small>
                <i>This email was generated automatically by system. Don't reply this email
                    <br>For inquiry please call our Customer Service 06-425635654543</i>
            </small>
            </p>";


        sendEmail($email, "Reset Password Link", $body);
        echo "<script>alert('We\'ve sent reset password instruction to your email!');window.location='forgot-password.php'</script>";
        exit();
    }else{
        echo "<script>alert('Email not found.');window.location='forgot-password.php'</script>";
        exit();
    }
}
?>
  <body main-theme-layout="main-theme-layout-1">
    <div class="page-wrapper">
        <div class="authentication-main">
          <div class="row">
            <div class="col-md-12">
              <div class="auth-innerright">
                <div class="authentication-box">
                    <div class="text-center"><img class="utem-logo" src="../assets/images/endless-logo.png" alt="logo"></div>
                  <div class="card mt-4">
                    <div class="card-body">
                      <div class="text-center">
                        <h6>Reset Password </h6>
                      </div>
                      <form class="theme-form" method="post">
                        <div class="form-group">
                          <label class="col-form-label pt-0" for="email">Email</label>
                          <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <button class="btn btn-primary btn-block" type="submit">Send Link</button>
                        </div>

                          <div class="form-row">
                              <div class="col-sm-12 text-center">
                                  <div class="mt-2 m-l-20">Already Remember?&nbsp;&nbsp;<a class="btn-link text-capitalize" href="login.php">Login</a>
                                  </div>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
<?php include('layout/script.php') ?>
<!-- Plugin used-->
</html>