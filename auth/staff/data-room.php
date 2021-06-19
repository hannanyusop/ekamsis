
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php

    if($_GET['id']){

        $q_block = $db->query("SELECT * FROM blocks WHERE id=$_GET[id]");

        $block = $q_block->fetch_assoc();

        if(!$block){
            echo "<script>alert('Block not exist!');window.location='data-block.php';</script>";
            exit();
        }

        $floors = json_decode($block['floor_list']);

        $q_inventories = $db->query("SELECT * FROM inventories WHERE is_active=1");

        $r_rooms = $db->query("SELECT * FROM rooms WHERE block_id=$_GET[id]");

    }else{
        dd('stop');
    }
?>
<?php include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">
<div class="page-wrapper">
    <?php include('layout/top-bar.php') ?>
    <div class="page-body-wrapper">
        <?php include('layout/side-bar.php'); ?>

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <div class="page-header-left">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Data Management</li>
                                    <li class="breadcrumb-item"><a href="data-block.php">Block</a></li>
                                    <li class="breadcrumb-item"><?= $block['name'] ?></li>
                                    <li class="breadcrumb-item">Room</li>
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
                    <form method="post" action="data-room-add.php?id=<?= $_GET['id'] ?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRoom">Add Room</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Room Name</label>
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

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="total">Total Sub Room</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" min="1" max="8" name="total" value="1" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="floor">Inventory</label>
                                            <div class="col-sm-9">
                                                <div class="col">
                                                    <?php while($inventory = $q_inventories->fetch_assoc()){ ;?>
                                                        <label class="d-block" for="inventory_id_<?= $inventory['id']?>">
                                                            <input class="checkbox_animated" id="inventory_id_<?= $inventory['id']?>" type="checkbox" value="<?= $inventory['id']?>" name="inventory_id[]"><?= $inventory['name'];?>                                                        </label>
                                                    <?php } ?>
                                                </div>
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
                                            <th>Room Name</th>
                                            <th>Floor</th>
                                            <th>Total Sub Room</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $r_rooms->fetch_assoc()){

//                                            $result = $db->query("SELECT rs.id as rsid, floor,name,codeFROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE block_id=$_GET[id]");

                                            $rs = $db->query("SELECT * FROM room_subs WHERE room_id=$data[id]");
                                        ?>

                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['floor']; ?></td>
                                                <td><?= $rs->num_rows; ?></td>
                                                <td>
                                                    <a href="data-room-edit.php?id=<?=$data['id'] ?>" class="btn btn-info btn-xs">Edit</a>
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