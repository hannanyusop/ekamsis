
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    $q_session = $db->query("SELECT * FROM sessions where is_current=1");

    $session = $q_session->fetch_assoc();

    $registered = $db->query("SELECT * FROM rents WHERE session_id='$session[id]'");

    $room_ids = [];
    while($data = $registered->fetch_assoc()){
        $room_ids[] = $room_ids['room_sub_id'];
    }


    $arr = [];
    while($data = $registered->fetch_assoc()){
        $arr[] = $data['user_id'];
    }

    $active_student  = $db->query("SELECT * FROM users WHERE  id NOT IN ( '" . implode( "', '" , $arr ) . "' )");

    $active_rooms = $db->query("SELECT * FROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE rs.id NOT IN ( '" . implode( "', '" , $room_ids ) . "' )");


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
                                    <li class="breadcrumb-item"><a href="data-rent.php">Rent</a> </li>
                                    <li class="breadcrumb-item">Add</li>

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
                            <div class="card-header">
                                <h5>Assign Student</h5>
                            </div>
                            <form class="form theme-form">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="user_id">User</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-placeholder-multiple col-md-12" id="user_id" name="user_id">
                                                        <?php while($data = $active_student->fetch_assoc()){ ;?>
                                                            <option value="<?=$data['id'] ?>"><?=$data['fullname'] ?>(<?= $data['matric_number'] ?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Room</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-placeholder-multiple col-md-12" id="user_id" name="user_id">
                                                        <?php while($data = $active_rooms->fetch_assoc()){ ;?>
                                                            <option value="<?=$data['id'] ?>"><?= $data['floor']." ".$data['name']." - ".$data['code'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button class="btn btn-primary" type="submit" data-original-title="" title="">Submit</button>
                                        <input class="btn btn-light" type="reset" value="Cancel" data-original-title="" title="">
                                    </div>
                                </div>
                            </form>
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
</html>