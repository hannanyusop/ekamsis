
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    if(isset($_POST['name'])){


        $floor_list = json_encode(explode(",",$_POST['floor']));
        $name = strtoupper($_POST[name]);
        $is_active = (isset($_POST['is_active']))? 1 : 0;
        $inventory = "INSERT INTO blocks (name, floor_list) VALUES ('$name', '$floor_list')";
        if (!$db->query($inventory)) {
            echo "Error: " . $inventory . "<br>" . $db->error; exit();
        }else{
            echo "<script>alert('New block successfully inserted!');window.location='data-block.php'</script>";
        }
    }
?>
<?= include('layout/head.php'); ?>

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
                                    <li class="breadcrumb-item active"><a href="data-block.php">Block</a> </li>
                                    <li class="breadcrumb-item">Add</li>
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
                            <div class="card-header">
                                <h5>Add New Block</h5>
                            </div>
                            <div class="card-body">
                                <form class="theme-form" method="post">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="name">Name</label>
                                        <input class="form-control text-uppercase" name="name" id="name"  type="text" placeholder="EX : HANG TUAH" data-original-title="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="floor">Floor</label>
                                        <textarea class="form-control" name="floor" id="floor" placeholder="Ex: G,1,2,3" rows="5" required></textarea>
                                        <small class="form-text text-muted" id="emailHelp">*Separate each floor with commas ','. Example : G,1,2,3</small>
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