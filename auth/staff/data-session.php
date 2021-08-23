
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php
    $result = $db->query("SELECT * FROM sessions");


    if(isset($_GET['active'])){

        $check_q = $db->query("SELECT * FROM sessions WHERE id='$_GET[active]'");
        $exist = $check_q->fetch_assoc();

        if(!$exist){
            echo "<script>alert('Session not exist!');window.location='data-session.php';</script>";
        }else{
            $db->query("UPDATE sessions SET is_current=0 WHERE is_current=1");

            if($db->query("UPDATE sessions SET is_current=1 WHERE id='$_GET[active]'")){
                echo "<script>alert('Session status updated!');window.location='data-session.php';</script>";
            }
        }
    }

if(isset($_GET['checkin'])){

    $check_q = $db->query("SELECT * FROM sessions WHERE id='$_GET[checkin]'");
    $exist = $check_q->fetch_assoc();

    if(!$exist){
        echo "<script>alert('Session not exist!');window.location='data-session.php';</script>";
    }else{

        if($db->query("UPDATE sessions SET allow_checkin=1,allow_checkout=0 WHERE id='$_GET[checkin]'")){
            echo "<script>alert('Checkin enabled!');window.location='data-session.php';</script>";
        }
    }
}

if(isset($_GET['checkout'])){

    $check_q = $db->query("SELECT * FROM sessions WHERE id='$_GET[checkout]'");
    $exist = $check_q->fetch_assoc();

    if(!$exist){
        echo "<script>alert('Session not exist!');window.location='data-session.php';</script>";
    }else{

        if($db->query("UPDATE sessions SET allow_checkin=0,allow_checkout=1 WHERE id='$_GET[checkout]'")){
            echo "<script>alert('Checkout enabled!');window.location='data-session.php';</script>";
        }
    }
}

if(isset($_GET['disabled'])){

    $check_q = $db->query("SELECT * FROM sessions WHERE id='$_GET[disabled]'");
    $exist = $check_q->fetch_assoc();

    if(!$exist){
        echo "<script>alert('Session not exist!');window.location='data-session.php';</script>";
    }else{

        if($db->query("UPDATE sessions SET allow_checkin=0,allow_checkout=0 WHERE id='$_GET[disabled]'")){
            echo "<script>alert('Checkin/checkout disabled!');window.location='data-session.php';</script>";
        }
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
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Active Session</th>
                                            <th>Allow Checkin</th>
                                            <th>Allow Checkout</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=0; while($data = $result->fetch_assoc()){ $no++; ;?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= strLimit($data['name'], 20); ?></td>
                                                <td><?= ($data['is_current'] == 1)? "Yes" : "No" ?></td>
                                                <td><?= ($data['allow_checkin'] == 1)? "Yes" : "No" ?></td>
                                                <td><?= ($data['allow_checkout'] == 1)? "Yes" : "No" ?></td>
                                                <td>
                                                    <?php if($data['is_current'] == 0){ ?>
                                                        <a href="data-session.php?active=<?=$data['id']?>" class="btn btn-success btn-xs" type="button" onclick="return confirm('Are you sure want to update this session status as current session?')">Set As Current</a>
                                                    <?php }else{

                                                        if($data['allow_checkin'] == 0 || $data['allow_checkout'] == 1){
                                                            echo '<a href="data-session.php?checkin='.$data['id'].'" class="btn btn-info btn-xs" onclick="return confirm(\'Are you sure want to enabled check-in?\')">Enabled Check-in</a>';
                                                        }else{
                                                            echo '<a href="data-session.php?checkout='.$data['id'].'" class="btn btn-info btn-xs" onclick="return confirm(\'Are you sure want to enabled check-out?\')">Enabled Check-out</a>';

                                                        }

                                                        if($data['allow_checkin'] == 1 || $data['allow_checkout'] == 1){
                                                            echo '<a href="data-session.php?disabled='.$data['id'].'" class="btn btn-dark btn-xs" onclick="return confirm(\'Are you sure want to disabled check-in/check-out?\')">Disabled</a>';
                                                        }


                                                    } ?>
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
        </div>
        <?php include('layout/footer.php'); ?>
    </div>
</div>

</body>

<?php include('layout/script.php'); ?>
</html>