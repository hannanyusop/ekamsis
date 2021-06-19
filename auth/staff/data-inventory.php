
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php
    $result = $db->query("SELECT * FROM inventories");

//    if($_GET['delete']){
//
//        $id = $_GET['id'];
//        $db->query("DELETE FROM inventories WHERE id=$id");
//        $db->query("DELETE FROM inventories WHERE id=$id");
//
//    }
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
                                    <li class="breadcrumb-item">Inventory</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bookmark pull-right">
                                <ul>
                                    <li><a href="data-inventory-add.php" class="btn btn-info text-white"><i class="fa fa-plus mr-1"></i> Add New Inventory</a> </li>
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
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=0; while($data = $result->fetch_assoc()){ $no++;?>
                                            <?php
                                                $quantity_q = $db->query("SELECT * FROM room_sub_inventories WHERE inventory_id=$data[id]");

                                            ?>
                                            <tr>
                                                <th><?=$no ?></th>
                                                <td><?= $data['name']; ?></td>
                                                <td class="text-center"><?= $quantity_q->num_rows ?></td>
                                                <td><?= strLimit($data['remark'], 20); ?></td>
                                                <td><?= isActive($data['is_active']) ?></td>
                                                <td>
                                                    <a href="data-inventory-edit.php?id=<?= $data['id'] ?>" class="btn btn-info btn-xs" type="button">Edit</a>
<!--                                                    <a href="data-inventory.php?delete=--><?//= $data['id'] ?><!--" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want to delete this inventory? (All data related to this inventory will be deleted too.)')">Delete</a>-->
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
        <?php include('layout/footer.php'); ?>
        <!-- footer end-->
    </div>
    <!-- Page Body End-->
</div>
<!-- latest jquery-->

</body>

<?php include('layout/script.php'); ?>
</html>