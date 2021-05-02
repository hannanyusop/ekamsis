
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php

    if($_GET['id']){

        $q_room = $db->query("SELECT * FROM rooms WHERE id=$_GET[id]");

        $room = $q_room->fetch_assoc();

        if(!$room){
            echo "<script>alert('Block not exist!');window.location='data-room.php?id='".$room['block_id'].";</script>";
            exit();
        }

        $q_block = $db->query("SELECT * FROM blocks WHERE id=$_GET[id]");

        $block = $q_block->fetch_assoc();

        $floors = json_decode($block['floor_list']);

        if(isset($_POST['form'])){

            if($_POST['form'] == "add-room"){

                $name = strtoupper($_POST['name']);
                $q = "INSERT INTO rooms (block_id, floor, is_active, name) VALUES ('$block[id]', '$_POST[floor]', 1, '$name')";

                if (!$db->query($q)) {
                    echo "<script>alert('Failed to insert new room.');window.location='data-room.php?id='".$_GET['id']."</script>";
                }else{

                    echo "<script>alert('New session successfully inserted!');window.location='data-room.php?id='".$_GET['id']."</script>";
                }
            }
        }



        $result = $db->query("SELECT * FROM room_subs WHERE room_id=$_GET[id]");
    }else{
        dd('stop');
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
                                    <li class="breadcrumb-item"><a href="data-block.php">Block</a></li>
                                    <li class="breadcrumb-item">Room</li>
                                    <li class="breadcrumb-item"><a href="data-room.php?id=<?=$block['id'] ?>"><?=$room['name'] ?></a></li>

                                </ol>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bookmark pull-right">
                                <ul>
                                    <li>
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addSubRoom">Add Sub Room</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scrolling long content-->

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
                                            <th>Floor</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $result->fetch_assoc()){ ;?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= $room['name']." ".$data['code']?></td>
                                                <td><?= $data['is_active']; ?></td>
                                                <td>
                                                    <a href="data-room-edit.php<?=$data['id'] ?>" class="btn btn-info btn-xs">Edit</a>
                                                    <a href="data-room-sub.php<?=$data['id'] ?>" class="btn btn-success btn-xs">Sub Room</a>
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

<?php include('layout/script.php'); ?>
</html>