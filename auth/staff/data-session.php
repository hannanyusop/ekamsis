
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    $result = $db->query("SELECT * FROM sessions");


    if($_GET['active']){

        $check_q = $db->query("SELECT * FROM sessions WHERE id='$_GET[active]'");
        $exist = $check_q->fetch_assoc();

        if(!$exist){
            echo "<script>alert('Session for not exist!');window.location='data-session.php';</script>";
        }else{
            $db->query("UPDATE sessions SET is_current=0 WHERE is_current=1");

            if($db->query("UPDATE sessions SET is_current=1 WHERE id='$_GET[active]'")){
                echo "<script>alert('Session status updated!');window.location='data-session.php';</script>";
            }
        }


    }
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
                                    <li class="breadcrumb-item">Session</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bookmark pull-right">
                                <ul>
                                    <li><a href="data-session-add.php" class="btn btn-info text-white"><i class="fa fa-plus mr-1"></i> Add Session</a> </li>
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
                                            <th>Active Session</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $result->fetch_assoc()){ ;?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= strLimit($data['name'], 20); ?></td>
                                                <td><?= ($data['is_current'] == 1)? "Yes" : "No" ?></td>
                                                <td>
                                                    <?php if($data['is_current'] == 0){ ?>
                                                        <a href="data-session.php?active=<?=$data['id']?>" class="btn btn-success btn-xs" type="button" onclick="return confirm('Are you sure want to update this session status as current session?')">Set As Current</a>
                                                    <?php } ?>
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