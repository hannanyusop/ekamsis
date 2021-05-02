
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php

    if($_GET['id']){

        $q_block = $db->query("SELECT * FROM blocks WHERE id=$_GET[id]");

        $block = $q_block->fetch_assoc();

        if(!$block){
            echo "<script>alert('Block not exist!');window.location='data-session.php';</script>";
            exit();
        }

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



        $result = $db->query("SELECT * FROM rooms WHERE block_id=$_GET[id]");
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
                                    <li class="breadcrumb-item"><a href="data-block.php">Room</a></li>
                                </ol>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bookmark pull-right">
                                <ul>
                                    <li>
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addRoom">Add Room</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="addRoom" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRoom">Add Room</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Name</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="form" value="add-room" required>
                                                <input class="form-control text-uppercase" type="text" id="name" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="floor">Floor</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="floor" name="floor" required>
                                                    <?php foreach ($floors as $key => $floor) { ?>
                                                        <option value="<?=$floor ?>"><?= $floor ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-secondary" type="submit">Add</button>
                            </div>
                        </div>
                    </form>
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
                                                <td><?= strLimit($data['name'], 20); ?></td>
                                                <td><?= $data['floor']; ?></td>
                                                <td>
                                                    <a href="data-room.php<?=$data['id'] ?>" class="btn btn-danger btn-xs">Edit</a>
                                                    <a href="data-room.php<?=$data['id'] ?>" class="btn btn-danger btn-xs">Manage Room</a>
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