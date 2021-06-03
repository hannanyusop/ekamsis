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
                    <div class="card mt-4 p-4">
<!--                        <h4>--><?//= $GLOBALS['APP_NAME'] ?><!--</h4>-->
                        <h6 class="text-center">Resend Verification </h6>
                      <form class="theme-form" method="post" action="verify-resend.php">
                        <div class="form-group">
                          <label class="col-form-label pt-0" for="email">Email</label>
                          <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <button class="btn btn-primary btn-block" type="submit">Resend Email Invitation</button>
                        </div>

                          <div class="form-row">
                              <div class="col-sm-12">
                                  <div class="text-left mt-2 m-l-20">Back to&nbsp;&nbsp;<a class="btn-link text-capitalize" href="login.php">Login</a> page.</div>
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