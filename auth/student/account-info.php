
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_user.php') ?>
<?php
$q_users = $db->query("SELECT * FROM users where id=$user_id");

$user = $q_users->fetch_assoc();

if(isset($_POST['phone_number'])){

    $phone_number = $_POST['phone_number'];

    if(!is_numeric($phone_number)){
        echo "<script>alert('Invalid phone number! Only number allowed.');window.location='account-info.php';</script>";
        exit();
    }

    $length = strlen($phone_number);

    if($length != 10 && $length != 11){
        echo "<script>alert('Invalid phone number! Please insert 10 to 11 character only');window.location='account-info.php';</script>";
        exit();
    }

    if(!$db->query("UPDATE users SET phone_number = '$phone_number' WHERE id=$user_id")){

        dd($db->error);
        echo "<script>alert('Database Error.');window.location='account-info.php';</script>";
        exit();
    }else{
        echo "<script>alert('Successfully updated.');window.location='account-info.php';</script>";
        exit();
    }
}
?>
<?php include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">

<div class="page-wrapper">
    <?php include('layout/top-bar.php') ?>
    <div class="page-body-wrapper">
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
                                    <li class="breadcrumb-item">Basic Information</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <form class="form theme-form" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="fullname">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="fullname" name="fullname" value="<?= $user['fullname']?>" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="email" name="email" value="<?= $user['email']?>" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="matric_number">Matric Number</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="matric_number" name="matric_number" value="<?= $user['matric_number']?>" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="phone_number">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="phone_number" name="phone_number" value="<?= $user['phone_number']?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button class="btn btn-primary" type="submit">Update</button>
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

<?php include('layout/script.php'); ?>
</html>