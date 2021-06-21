
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">
<?php
$data = [];
$month = 1; $year = date('Y');
do{
//    $query = $db->query("SELECT * from bookings WHERE  YEAR(created_at) = $year AND MONTH(created_at) = $month");

    $count = rand(3,40);
    $data[] = $count;
    $month++;
}while($month <= 12);

$month = 1;
$success = [];
do{
//    $query = $db->query("SELECT * from bookings WHERE YEAR(created_at) = $year AND MONTH(created_at) = $month AND status =3");

    $count = rand(3,50);
    $success[] = $count;
    $month++;
}while($month <= 12);

?>
<?php

$student_q = $db->query("SELECT * FROM users WHERE verified_at IS NOT NULL");
$student = $student_q->num_rows;

$student_inactive_q = $db->query("SELECT * FROM users WHERE verified_at IS NULL");
$student_inactive = $student_inactive_q->num_rows;

$agent = 10;
$active_agent = 10;
$house = $project =$booking_approve = $booking = 10;

$room_q = $db->query("SELECT * FROM room_subs");
$room = $room_q->num_rows;

$available_room_q = $db->query("SELECT * FROM room_subs WHERE current_student_id IS NULL");
$available_room   = $available_room_q->num_rows;

$block_q = $db->query("SELECT * FROM blocks");
$block = $block_q->num_rows;

$block_m_q = $db->query("SELECT * FROM blocks WHERE for_gender='M'");
$block_m = $block_m_q->num_rows;

$block_f_q = $db->query("SELECT * FROM blocks WHERE for_gender='F'");
$block_f = $block_f_q->num_rows;



?>

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
                                <h3>Dashboard</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <h5 class="mb-0">Student</h5>
                                </div>
                                <div class="project-widgets text-center">
                                    <h1 class="font-primary counter"><?= $student?></h1>
                                    <h6 class="mb-0">Students</h6>
                                </div>
                            </div>
                            <div class="card-footer project-footer">
                                <h6 class="mb-0">Inactive: <span class="counter"><?= $student_inactive ?></span></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <h5 class="mb-0">Total Room</h5>
                                </div>
                                <div class="project-widgets text-center">
                                    <h1 class="font-primary counter"><?= $room ?></h1>
                                    <h6 class="mb-0">Rooms</h6>
                                </div>
                            </div>
                            <div class="card-footer project-footer">
                                <h6 class="mb-0">Available: <span class="counter"><?= $available_room ?></span></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <h5 class="mb-0">Block</h5>
                                </div>
                                <div class="project-widgets text-center">
                                    <h1 class="font-primary counter"><?= $block ?></h1>
                                    <h6 class="mb-0">Blocks</h6>
                                </div>
                            </div>
                            <div class="card-footer project-footer">
                                <h6 class="mb-0">Male: <span class="counter"><?= $block_m ?></span> | Female: <span class="counter"><?= $block_f ?></span></h6>
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