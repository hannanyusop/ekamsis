
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php
    $result = $db->query("SELECT * FROM blocks");
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
                                    <li class="breadcrumb-item">Block</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bookmark pull-right">
                                <ul>
                                    <li><a href="data-block-add.php" class="btn btn-info text-white"><i class="fa fa-plus mr-1"></i> Add New Block</a> </li>
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
                                            <th>Block Name</th>
                                            <th>For (Gender)</th>
                                            <th>Floor</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $result->fetch_assoc()){ ;?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= strLimit($data['name'], 20); ?></td>
                                                <td><?= getGender($data['for_gender']); ?></td>
                                                <td><?= implode(",", json_decode($data['floor_list'])) ?></td>
                                                <td>
                                                    <a href="data-block-edit.php?id=<?=$data['id'] ?>" class="btn btn-success btn-xs">Edit</a>
                                                    <a href="data-room.php?id=<?=$data['id'] ?>" class="btn btn-info btn-xs">Manage Room</a>
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