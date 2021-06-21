
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php

if(isset($_GET['id'])){

    $staff_id = $_GET['id'];
    $q_staff = $db->query("SELECT * FROM staff where id=$staff_id");

    $staff = $q_staff->fetch_assoc();

    if(!$staff){
        echo "<script>alert('Invalid staff id.');window.location='management-staff.php';</script>";
        exit();
    }

    $staff_domain = $GLOBALS['staff_mail_domain'];


    if(isset($_POST['name'])){

        $fullname = strtoupper($_POST['name']);
        $email = $_POST['email'];

        $parts = explode("@",$email);

        if($parts[1] != $staff_domain){
            echo "<script>alert('Ops! you need to register using email @".$staff_domain."!');window.location='management-staff-edit.php?id=$staff_id'</script>";
        }

        #cehck to prevent duplicate email
        $check_q = $db->query("SELECT * FROM staff WHERE email='$email' AND id!=$staff_id");
        $exist = $check_q->fetch_assoc();


        if($exist){
            echo "<script>alert('Email already exist!');window.location='management-staff-edit.php?id=$staff_id'</script>";
        }

        $role = (isset($_POST['role']))? "admin" : "staff";

        if(!$db->query("UPDATE staff SET fullname='$fullname',email='$email',role='$role' WHERE id=$staff_id")){

            echo "<script>alert('Database Error.');window.location='management-staff-edit.php?id=$staff_id';</script>";
            exit();
        }else{
            echo "<script>alert('Successfully updated.');window.location='management-staff.php?id=$staff_id';</script>";
            exit();
        }
    }
}else{
    echo "<script>alert('Invalid url.');window.location='management-student.php';</script>";
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
                                    <li class="breadcrumb-item">Edit</li>
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
                                        <input class="form-control" name="name" id="name"  type="text" value="<?= $staff['fullname'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="email">Email <small class="badge badge-info">Please use email with domain <?=  "@".$staff_domain  ?></small></label>
                                        <input class="form-control" name="email" id="email"  type="email" value="<?= $staff['email'] ?>"  required>
                                    </div>

                                    <div class="checkbox p-0">
                                        <input id="role" type="checkbox" name="role" <?= ($staff['role'] == 'admin')? "checked" : ""; ?>>
                                        <label class="mb-0" for="role" >Set As Admin</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" value="submit">Update</button>
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