
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php
$result = $db->query("SELECT * FROM inventories");

$staff_domain = $GLOBALS['staff_mail_domain'];


if(isset($_POST['name'])){

    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Ops! invalid email!');window.location='management-staff-add.php'</script>";
        exit();
    }

    $parts = explode("@",$email);

    if($parts[1] != $staff_domain){
        echo "<script>alert('Ops! you need to register using email @".$staff_domain."!');window.location='management-staff-add.php'</script>";
    }

    $staff_q = $db->query("SELECT * FROM staff WHERE email='$_POST[email]'");
    $staff = $staff_q->fetch_assoc();


    if($staff){
        echo "<script>alert('Email already exist!');window.location='management-staff-add.php'</script>";
    }

    $pash_pass = password_hash('secret', PASSWORD_BCRYPT);
    $role = (isset($_POST['role']))? "admin" : "staff";
    $staff = "INSERT INTO staff (fullname,password,email,role) VALUES ('$_POST[name]','$pash_pass', '$email', '$role')";

    if (!$db->query($staff)) {
        echo "Error: " . $staff . "<br>" . $db->error; exit();
    }else{
        echo "<script>alert('New staff successfully inserted!');window.location='management-staff.php'</script>";
    }
}
?>
<?php include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">

<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <?php include('layout/top-bar.php') ?>
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include('layout/side-bar.php'); ?>

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <div class="page-header-left">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Data Management</li>
                                    <li class="breadcrumb-item active"><a href="management-staff.php">Staff</a> </li>
                                    <li class="breadcrumb-item">Add</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <form class="theme-form" method="post">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="name">Name</label>
                                        <input class="form-control" name="name" id="name"  type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="email">Email <small class="badge badge-info">Please use email with domain <?=  "@".$staff_domain  ?></small></label>
                                        <input class="form-control" name="email" id="email"  type="email" value="<?= "@".$staff_domain ?>"  required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="password">Password</label>
                                        <input class="form-control" name="password" id="password"  type="text" value="secret" readonly>
                                    </div>

                                    <div class="checkbox p-0">
                                        <input id="role" type="checkbox" name="role">
                                        <label class="mb-0" for="role">Set As Super Admin</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="data-inventory.php" class="btn btn-secondary" data-original-title="" title="">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

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