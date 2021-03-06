<!DOCTYPE html>
<html lang="en">
<?php include('layout/head.php'); ?>
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
                        <h6>Login </h6>
                      </div>
                      <form class="theme-form" method="post" action="verify.php">
                        <div class="form-group">
                          <label class="col-form-label pt-0" for="email">Email</label>
                          <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <div class="form-group">
                          <label class="col-form-label" for="password">Password</label><a class="float-right" href="forgot-password.php">Forgot Password</a>
                          <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <button class="btn btn-primary btn-block" type="submit">Login</button>
                        </div>

                          <div class="form-row">
                              <div class="col-sm-12 text-center">
                                  <div class="mt-2 m-l-20">Register Account Here?&nbsp;&nbsp;<a class="btn-link text-capitalize" href="register.php">Register</a><br> Or<br>
                                     Resend link invitation&nbsp;&nbsp;<a class="btn-link text-capitalize" href="resend-verification.php">here</a>
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