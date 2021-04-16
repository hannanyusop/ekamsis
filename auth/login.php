<!DOCTYPE html>
<html lang="en">
<?= include('layout/head.php'); ?>
  <body main-theme-layout="main-theme-layout-1">
    <div class="page-wrapper">
        <div class="authentication-main">
          <div class="row">
            <div class="col-md-12">
              <div class="auth-innerright">
                <div class="authentication-box">
                  <div class="text-center"><img src="../assets/images/endless-logo.png" alt=""></div>
                  <div class="card mt-4">
                    <div class="card-body">
                      <div class="text-center">
                        <h4>LOGIN</h4>
                        <h6>Enter your Username and Password </h6>
                      </div>
                      <form class="theme-form" method="post" action="verify.php">
                        <div class="form-group">
                          <label class="col-form-label pt-0" for="email">Email</label>
                          <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <div class="form-group">
                          <label class="col-form-label" for="password">Password</label>
                          <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <button class="btn btn-primary btn-block" type="submit">Login</button>
                        </div>

                          <div class="form-row">
                              <div class="col-sm-12">
                                  <div class="text-left mt-2 m-l-20">Register Account Here?&nbsp;&nbsp;<a class="btn-link text-capitalize" href="register.php">Register</a></div>
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
<?= include('layout/script.php') ?>
<!-- Plugin used-->
</html>