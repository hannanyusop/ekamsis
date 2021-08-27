<!DOCTYPE html>
<html lang="en">
<?php include('layout/head.php'); ?>

<?php

if(isset($_GET['token'])) {

    $token = $_GET['token'];
    $result = $db->query("SELECT * FROM users WHERE reset_token ='$token'");
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "<script>alert('Invalid token. Please request new token');window.location='forgot-password.php'</script>";
        exit();
    }

    if(isset($_POST['new_password'])){

        $new_password = $_POST['new_password'];
        $length = strlen($new_password);

        if($length < 6){
            echo "<script>alert('Please insert 6 or more character');window.location='password.php?token=$token';</script>";
            exit();
        }

        if($new_password != $_POST['confirm_password']){
            echo "<script>alert('Confirm Password not match.');window.location='password.php?token=$token';</script>";
            exit();
        }

        $hash_pass = password_hash($new_password, PASSWORD_BCRYPT);

        if(!$db->query("UPDATE users SET password = '$hash_pass', reset_token=null WHERE id=$user[id]")){

            dd($db->error);
            echo "<script>alert('Database Error.');window.location='password.php?token=$token';</script>";
            exit();
        }else{
            echo "<script>alert('Successfully updated. Please login using new password.');window.location='login.php';</script>";
            exit();
        }
    }
}else{
    echo "<script>alert('Invalid token. Please request new token');window.location='forgot-password.php'</script>";
    exit();
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
                        <h6> Password Recovery</h6>
                      </div>
                      <form class="theme-form" method="post">
                          <div class="row">
                              <div class="col">
                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label" for="new_password">New Password</label>
                                      <div class="col-sm-9">
                                          <input class="form-control" id="new_password" name="new_password" value="<?= isset($_POST['new_password'])? $_POST['new_password'] : '' ?>" type="password" required>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <div class="form-group row">
                                      <label class="col-sm-3 col-form-label" for="confirm_password">Confirm Password</label>
                                      <div class="col-sm-9">
                                          <input class="form-control" id="confirm_password" name="confirm_password" value="<?= isset($_POST['confirm_password'])? $_POST['confirm_password'] : '' ?>" type="password" required>
                                          <span class="mt-2" id='message'></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <button class="btn btn-primary btn-block" type="submit">Save Password</button>
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