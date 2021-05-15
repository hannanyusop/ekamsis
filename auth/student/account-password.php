
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_user.php') ?>
<?php
$q_users = $db->query("SELECT * FROM users where id=$user_id");

$user = $q_users->fetch_assoc();

if(isset($_POST['password'])){

    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!password_verify($_POST['password'], $user['password'])) {
        echo "<script>alert('Old password not matched!');window.location='account-password.php';</script>";
        exit();
    }

    $length = strlen($new_password);

    if($length < 6){
        echo "<script>alert('Please insert 6 or more character');window.location='account-password.php';</script>";
        exit();
    }

    $hash_pass = password_hash($new_password, PASSWORD_BCRYPT);

    if(!$db->query("UPDATE users SET password = '$hash_pass' WHERE id=$user_id")){

        dd($db->error);
        echo "<script>alert('Database Error.');window.location='account-password.php';</script>";
        exit();
    }else{
        echo "<script>alert('Successfully updated.');window.location='account-password.php';</script>";
        exit();
    }
}
?>
<?= include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">

<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <?php include('layout/top-bar.php') ?>
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include('layout/side-bar.php'); ?>

        <div class="page-body">
            <!-- breadcrumb  Start -->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <div class="page-header-left">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item">My Account</li>
                                    <li class="breadcrumb-item">Change Password</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <form class="form theme-form" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="password">Old Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="password" name="password" value="<?= isset($_POST['password'])? $_POST['password'] : '' ?>" type="password" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button class="btn btn-primary" type="submit">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('layout/footer.php'); ?>
    </div>
</div>
</body>

<?= include('layout/script.php'); ?>
<script type="text/javascript">
    $('#new_password, #confirm_password').on('keyup', function () {
        if ($('#new_password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Password Not Matching').css('color', 'red');
    });
</script>
</html>