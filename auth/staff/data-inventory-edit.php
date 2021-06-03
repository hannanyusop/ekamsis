
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php

if(isset($_GET['id'])){
    $inventory_id = $_GET['id'];

    $inventory_q = $db->query("SELECT * FROM inventories WHERE id=$inventory_id");
    $inventory = $inventory_q->fetch_assoc();

    if(isset($_POST['name'])){


        $is_active = (isset($_POST['is_active']))? 1 : 0;
        $update = "UPDATE inventories SET name='$_POST[name]',remark='$_POST[remark]',is_active='$is_active' WHERE id=$inventory_id";
        if (!$db->query($update)) {

            echo "Error: " . $inventory . "<br>" . $db->error; exit();
        }else{
            echo "<script>alert('Inventory successfully updated!');window.location='data-inventory.php'</script>";
        }
    }

    if(!$inventory){
        echo "<script>alert('Data inventory not found!');window.location='data-inventory.php'</script>";
    }
}else{
    echo "<script>alert('Data inventory not found!');window.location='data-inventory.php'</script>";
}
?>
<?= include('layout/head.php'); ?>

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
                                    <li class="breadcrumb-item active"><a href="data-inventory.php">Inventory</a> </li>
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
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="name">Name</label>
                                        <input class="form-control" name="name" id="name"  type="text" value="<?=$inventory['name'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <textarea class="form-control" name="remark" id="remark" rows="5"><?=$inventory['remark'] ?></textarea>
                                    </div>
                                    <div class="checkbox p-0">
                                        <input id="is_active" type="checkbox" name="is_active" <?=($inventory['is_active'] == 1)? "checked" : "" ?>>
                                        <label class="mb-0" for="is_active">Active</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="data-inventory.php" class="btn btn-secondary" data-original-title="" title="">Cancel</a>
                                        </div>
                                    </div>
                                </form>
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