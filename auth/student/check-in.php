
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_user.php') ?>
<?php

    if(isset($_GET['id'])){
        $rent_id = $_GET['id'];

        $r_rent = $db->query("SELECT * FROM rents WHERE user_id=$user_id AND id=$rent_id");
        $rent = $r_rent->fetch_assoc();

        if(!$rent){
            echo "<script>alert('Invalid data.');window.location='rent-index.php'</script>";
            exit();
        }

        if($current_session['id'] != $rent['session_id']){
            echo "<script>alert('Invalid session.');window.location='rent-index.php'</script>";
            exit();
        }

        $rent_remark_q = $db->query("SELECT * FROM rent_remark WHERE rent_id=$rent_id");

    }else{
        echo "<script>alert('Invalid parameter.');window.location='rent-index.php'</script>";
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
                                    <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item">Rent</li>
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
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td rowspan="2">Inventory</td>
                                        <td class="text-center" colspan="3">Check-in</td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td>Photo</td>
                                        <td>Remark</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($remark = $rent_remark_q->fetch_assoc()){ ?>

                                        <?php
                                            $i_q = $db->query("SELECT * FROM room_sub_inventories rsi LEFT JOIN inventories i ON i.id = rsi.inventory_id WHERE rsi.id= $remark[room_sub_inventory_id]");
                                            $i = $i_q->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td><?= $i['name']?></td>
                                            <td>
                                                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                    <div class="radio radio-primary">
                                                        <input id="<?= $i['name']; ?>" type="radio" name="<?= $i['name']; ?>" value="1" checked>
                                                        <label class="mb-0" for="<?= $i['name']; ?>">Good</label>
                                                    </div>
                                                    <div class="radio radio-primary">
                                                        <input id="<?= $i['name']; ?>_no" type="radio" name="<?= $i['name']; ?>" value="0">
                                                        <label class="mb-0" for="<?= $i['name']; ?>_no">Broken</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><input class="form-control" type="file"></td>
                                            <td>
                                                <textarea class="form-control" rows="4">
                                                </textarea>
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