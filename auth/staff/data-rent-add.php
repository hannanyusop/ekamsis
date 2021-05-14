
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    $q_session = $db->query("SELECT * FROM sessions where is_current=1");

    $session = $q_session->fetch_assoc();

    $registered = $db->query("SELECT * FROM rents WHERE session_id='$session[id]'");

    $room_ids = [];
    $registered_user = [];

    while($data = $registered->fetch_assoc()){

        $registered_user[] = $data['user_id'];
        $room_ids[] = $data['room_sub_id'];
    }

    $active_student  = $db->query("SELECT * FROM users WHERE  id NOT IN ( '" . implode( "', '" , $registered_user) . "' )");

    $active_rooms = $db->query("SELECT rs.id as sub_id, floor,name,code FROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE rs.id NOT IN ( '" . implode( "', '" , $room_ids ) . "' )");

    $r_rent = $db->query("SELECT * FROM rents r LEFT JOIN users u ON u.id = r.user_id WHERE session_id='$session[id]'");

    if(isset($_POST['user_id'])){

        if($_POST['user_id'] == ""){
            echo "<script>alert('Please select user.');window.location='data-rent-add.php'</script>";
            exit();
        }

        if($_POST['room_sub_id'] == ""){
            echo "<script>alert('Please select room.');window.location='data-rent-add.php'</script>";
            exit();
        }
        #check if room already registered or not
        $check_rent_q = $db->query("SELECT * FROM rents WHERE session_id='$session[id]' AND room_sub_id='$_POST[room_sub_id]'");

        $check_rent = $check_rent_q->fetch_assoc();

        if($check_rent){
            echo "<script>alert('Room already registered to other student.');window.location='data-rent-add.php'</script>";
            exit();
        }

        #check if users already registered or not
        $check_user_q = $db->query("SELECT * FROM rents WHERE session_id='$session[id]' AND user_id='$_POST[user_id]'");

        $check_user = $check_user_q->fetch_assoc();

        if($check_user){
            echo "<script>alert('User already registered for this session.');window.location='data-rent-add.php'</script>";
            exit();
        }

        #insert rent
        $rent_q = "INSERT INTO rents (user_id,room_sub_id, session_id, remark) VALUES ('$_POST[user_id]', '$_POST[room_sub_id]', $session[id], '')";

        if (!$db->query($rent_q)) {
            dd($db->error);
            echo "<script>alert('Failed to assign student.');window.location='data-rent-add.php'</script>";
            exit();
        }
        #insert rent remark

        $rent_id = $db->insert_id;

        $room_sub_inventories  = $db->query("SELECT * FROM room_sub_inventories WHERE room_sub_id='$_POST[room_sub_id]'");
        while($inventories = $room_sub_inventories->fetch_assoc()){

            if (!$db->query("INSERT INTO rent_remark (room_sub_inventory_id,rent_id) VALUES ($inventories[id],$rent_id)")) {
                dd($db->error);
                echo "<script>alert('Failed to insert rent remark.');window.location='data-rent-add.php'</script>";
                exit();
            }
        }

        echo "<script>alert('Successfully assign student');window.location='data-rent.php'</script>";
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
                            <form class="form theme-form" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="user_id">User</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single col-md-12" id="user_id" name="user_id" required>
                                                        <option value="" selected>-- Choose User -- </option>
                                                        <?php while($user = $active_student->fetch_assoc()){ ;?>
                                                            <option value="<?=$user['id'] ?>"><?=$user['fullname'] ?>(<?= $user['matric_number'] ?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Room</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single col-md-12" id="room_sub_id" name="room_sub_id">
                                                        <option value="" selected>-- Choose Room -- </option>
                                                        <?php while($room = $active_rooms->fetch_assoc()){ ;?>
                                                            <option value="<?=$room['sub_id'] ?>"><?= $room['floor']." ".$room['name']." - ".$room['code'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <a href="data-rent.php" class="btn btn-light">Cancel</a>
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
        <?php include('layout/footer.php'); ?>
        <!-- footer end-->
    </div>
    <!-- Page Body End-->
</div>
<!-- latest jquery-->

</body>

<?php include('layout/script.php'); ?>
</html>