
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    $q_session = $db->query("SELECT * FROM sessions where is_current=1");

    $session = $q_session->fetch_assoc();

    $r_rent = $db->query("SELECT * FROM rents WHERE session_id='$session[id]'");


    if(isset($_GET['delete'])){

        $r_reset = $db->query("SELECT * FROM rents r  WHERE session_id='$session[id]' AND id=$_GET[delete]");

        $reset = $r_reset->fetch_assoc();

        if(!$reset){
            echo "<script>alert('Data not found! Failed to delete data.');window.location='data-rent.php'</script>";
        }

        $db->query("DELETE FROM rents  WHERE id=$_GET[delete]");
        $db->query("DELETE FROM rent_remark  WHERE rent_id=$_GET[delete]");

        echo "<script>alert('Data successfully deleted.');window.location='data-rent.php'</script>";


    }

    if(isset($_GET['reset'])){

        $r_reset = $db->query("SELECT * FROM rents r  WHERE session_id='$session[id]' AND id=$_GET[reset]");

        $reset = $r_reset->fetch_assoc();

        if(!$reset){
            echo "<script>alert('Data not found! Failed to reset data.');window.location='data-rent.php'</script>";
        }

        $db->query("UPDATE rents SET remark=null,check_in_on=null,check_out_on=null  WHERE id=$_GET[reset]");

        $db->query("UPDATE rent_remark SET cin_ok=null,cin_remark=null,cin_photo=null,cout_ok=null,cout_remark=null,cout_photo=null  WHERE rent_id=$_GET[reset]");

        echo "<script>alert('Successfully reset data.');window.location='data-rent.php'</script>";

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
            <!-- breadcrumb  Start -->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <div class="page-header-left">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Data Management</li>
                                    <li class="breadcrumb-item">Rent</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bookmark pull-right">
                                <ul>
                                    <li><a href="data-rent-add.php" class="btn btn-info text-white"><i class="fa fa-plus mr-1"></i> Assign Student</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive product-table">
                                    <table class="display table-sm" id="datatable">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Room</th>
                                            <th>Checkin On</th>
                                            <th>Checkout On</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $r_rent->fetch_assoc()){ ;?>

                                                <?php
                                                        $rs_q = $db->query("SELECT rs.id as sub_id, floor,name,code FROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE rs.id= $data[room_sub_id]");
                                                        $rs = $rs_q->fetch_assoc();

                                                        $student_q = $db->query("SELECT * FROM users WHERE id='$data[user_id]'");
                                                        $student = $student_q->fetch_assoc()

                                                ?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= strLimit($student['fullname'], 20); ?></td>
                                                <td><?= $rs['floor']." ".$rs['name']." - ".$rs['code'] ?></td>
                                                <td class="text-center"><?= (!is_null($data['check_in_on']))? $data['check_in_on'] : "Not Yet"; ?></td>
                                                <td class="text-center"><?= (!is_null($data['check_out_on']))? $data['check_out_on'] : "Not Yet"; ?></td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="data-rent-view.php?id=<?= $data['id']; ?>">View</a>
                                                    <a class="btn btn-warning btn-sm" href="data-rent.php?reset=<?= $data['id']; ?>" onclick="return confirm('Are you sure want to reset this data?')">Reset</a>
                                                    <a class="btn btn-danger btn-sm" href="data-rent.php?delete=<?= $data['id']; ?>" onclick="return confirm('Are you sure want to delete this data?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php include('layout/footer.php'); ?>
        <!-- footer end-->
    </div>
    <!-- Page Body End-->
</div>
<!-- latest jquery-->

</body>

<?php include('layout/script.php'); ?>
</html>