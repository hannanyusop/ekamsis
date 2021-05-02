
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    $q_session = $db->query("SELECT * FROM sessions where is_current=1");

    $session = $q_session->fetch_assoc();

    $r_rent = $db->query("SELECT * FROM rents r LEFT JOIN users u ON u.id = r.user_id WHERE session_id='$session[id]'");

?>
<?php include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">

<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <?= include('layout/top-bar.php') ?>
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?= include('layout/side-bar.php'); ?>

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
                                    <li><a href="data-rent-add.php" class="btn btn-info text-white"><i class="fa fa-plus mr-1"></i> Add Data</a> </li>
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
                                            <th>Room ID</th>
                                            <th>room_sub_id</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $r_rent->fetch_assoc()){ ;?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= strLimit($data['fullname'], 20); ?></td>
                                                <td><?= "" ?></td>
                                                <td><?= $data['room_sub_id']?></td>
                                                <td>
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
        <?= include('layout/footer.php'); ?>
        <!-- footer end-->
    </div>
    <!-- Page Body End-->
</div>
<!-- latest jquery-->

</body>

<?= include('layout/script.php'); ?>
<!-- Mirrored from laravel.pixelstrap.com/endless/sample-page by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Nov 2020 07:18:47 GMT -->
</html>