
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php
if(isset($_GET['id'])){
    $room_id = $_GET['id'];

    $q_room = $db->query("SELECT * FROM rooms WHERE id=$room_id");
    $room = $q_room->fetch_assoc();

    if(!$room){
        echo "<script>alert('Room not exist!');window.location='data-block.php';</script>";
        exit();
    }

    $q_block = $db->query("SELECT * FROM blocks WHERE id=$_GET[id]");

    $block = $q_block->fetch_assoc();

    $floors = json_decode($block['floor_list']);

//    $q_inventories = $db->query("SELECT * FROM inventories WHERE is_active=1");

    if(isset($_POST['submit'])){

        $name = strtoupper($_POST['name']);
        $update = "UPDATE rooms SET name='$name', floor='$_POST[floor]' WHERE id='$_GET[id]'";
        if (!$db->query($update)) {
            echo "<script>alert('Failed to insert new room.');window.location='data-room.php?id=" . $_GET['id'] . "'</script>";
            exit();
        }else{
            echo "<script>alert('Room updated!');window.location='data-room.php?id=$block[id]';</script>";
        }
    }
}else{
    echo "<script>alert('Invalid URL!');window.location='data-block.php'</script>";
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
                                    <li class="breadcrumb-item"><a href="data-block.php">Block</a></li>
                                    <li class="breadcrumb-item"><a href="data-room.php?id=<?= $block['id'] ?>"><?= $block['name'] ?></a> </li>
                                    <li class="breadcrumb-item">Room</li>
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
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="name">Room Name</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="form" value="add-room" required>
                                            <input class="form-control text-uppercase" type="text" id="name" VALUE="<?=$room['name'] ?>" name="name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="floor">Floor</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="floor" name="floor" required>
                                                <?php foreach ($floors as $key => $floor) { ?>
                                                    <option value="<?=$floor ?>" <?= ($room['floor'] == $floor)? "selected" : "" ?>><?= $floor ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                            <a href="data-room.php?id=<?= $block['id'] ?>" class="btn btn-secondary">Cancel</a>
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