
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php

if(isset($_GET['id'])){

    $student_id = $_GET['id'];
    $q_student = $db->query("SELECT * FROM users where id=$student_id");

    $student = $q_student->fetch_assoc();

    if(!$student){
        echo "<script>alert('Invalid student id.');window.location='management-student.php';</script>";
        exit();
    }

    if(isset($_POST['submit'])){

        $fullname = strtoupper($_POST['fullname']);
        $matric_number = $_POST['matric_number'];
        $email = $matric_number."@".$GLOBALS['student_mail_domain'];
        $phone_number = $_POST['phone_number'];

        $check_q = $db->query("SELECT * FROM users WHERE email='$email' AND id!=$student_id");
        $exist = $check_q->fetch_assoc();


        if($exist){
            echo "<script>alert('Email already exist!');window.location='management-student-edit.php?id=$student_id'</script>";
        }

        if(!is_numeric($phone_number)){
            echo "<script>alert('Invalid phone number! Only number allowed.');window.location='management-student-edit.php?id=$student_id';</script>";
            exit();
        }

        $length = strlen($phone_number);

        if($length != 10 && $length != 11){
            echo "<script>alert('Invalid phone number! Please insert 10 to 11 character only');window.location='management-student-edit.php?id=$student_id';</script>";
            exit();
        }

        if(!in_array($_POST['gender'], array_keys(getGender()))){
            echo "<script>alert('Invalid gender!');window.location='management-student-edit.php?id=$student_id'</script>";
        }

        if(!$db->query("UPDATE users SET fullname='$fullname',matric_number='$matric_number',email='$email',gender='$_POST[gender]',phone_number = '$phone_number' WHERE id=$student_id")){

            dd($db->error);
            echo "<script>alert('Database Error.');window.location='management-student-edit.php?id=$student_id';</script>";
            exit();
        }else{
            echo "<script>alert('Successfully updated.');window.location='management-student-edit.php?id=$student_id';</script>";
            exit();
        }
    }
}else{
    echo "<script>alert('Invalid url.');window.location='management-student.php';</script>";
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
                                    <li class="breadcrumb-item">User Management</li>
                                    <li class="breadcrumb-item"><a href="management-student.php">Student</a> </li>
                                    <li class="breadcrumb-item"><?= $student['email'] ?></li>
                                    <li class="breadcrumb-item">Edit</li>

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
                                                    <input class="form-control text-uppercase" id="fullname" name="fullname" value="<?= $student['fullname']?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="email" name="email" value="<?= $student['email']?>" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="email">Gender</label>
                                                <div class="col-sm-9">
                                                    <select id="gender" name="gender" class="form-control">
                                                        <?php foreach (getGender() as $gender => $g_name){?>
                                                            <option value="<?= $gender ?>" <?= ($gender == $student['gender'])? "selected" : "" ?>><?=$g_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="matric_number">Matric Number</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="matric_number" name="matric_number" value="<?= $student['matric_number']?>" type="text">
                                                    <small class="">*Notes : Student email also will be updated</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="phone_number">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" id="phone_number" name="phone_number" value="<?= $student['phone_number']?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button class="btn btn-primary" type="submit" name="submit">Update</button>
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