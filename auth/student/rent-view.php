
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

        if(is_null($rent['check_in_on'])){
            echo "<script>alert('You need to check-in first.');window.location='rent-index.php'</script>";
            exit();
        }

        $rent_remark_q = $db->query("SELECT * FROM rent_remark WHERE rent_id=$rent_id");

        $user_q = $db->query("SELECT * FROM users WHERE id=$rent[user_id] ");
        $user = $user_q->fetch_assoc();

        $session_q = $db->query("SELECT * FROM sessions WHERE id=$rent[session_id]");
        $session = $session_q->fetch_assoc();

        $rs_q = $db->query("SELECT rs.id as sub_id, floor,name,code,block_id FROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE rs.id= $rent[room_sub_id]");
        $rs = $rs_q->fetch_assoc();

        $block_q = $db->query("SELECT * FROM blocks WHERE id=$rs[block_id]");
        $block = $block_q->fetch_assoc();
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

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <span>NAME : <b><?= $user['fullname'] ?></b></span><br>
                                        <span>MATRIC NUMBER : <b><?= $user['matric_number']; ?></b></span><br>
                                        <span>PHONE NO. : <b><?= $user['phone_number']; ?></b></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span>SESSION : <b><?= $session['name'] ?></b></span><br>
                                        <span>CHECK-IN ON: <b><?= $rent['check_in_on'] ?></b></span><br>
                                        <span>CHECK-OUT ON: <b><?= $rent['check_out_on'] ?></b></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span>BlOCK :<?= $block['name'] ?></span><br>
                                        <span>FLOOR :<?= $rs['floor'] ?></span><br>
                                        <span>ROOM : <?= $rs['floor']." ".$rs['name']." - ".$rs['code'] ?></span>
                                    </div>
                                </div>


                                <form method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="checkout" value="true">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td rowspan="2">Inventory</td>
                                            <td class="text-center" colspan="3">Check-in</td>
                                            <td class="text-center" colspan="3">Check-out</td>
                                        </tr>
                                        <tr>
                                            <td>Condition</td>
                                            <td>Photo</td>
                                            <td>Remark</td>
                                            <td>Condition</td>
                                            <td>Photo</td>
                                            <td>Remark</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($remark = $rent_remark_q->fetch_assoc()){ ?>

                                            <?php
                                            $i_q = $db->query("SELECT rsi.id as rsid,name FROM room_sub_inventories rsi LEFT JOIN inventories i ON i.id = rsi.inventory_id WHERE rsi.id= $remark[room_sub_inventory_id]");
                                            $i = $i_q->fetch_assoc();
                                            ?>
                                            <tr>
                                                <td><?= $i['name']?></td>
                                                <td><?= is_ok($remark['cin_ok']) ?></td>
                                                <td><?= photo($remark['cin_photo']) ?></td>
                                                <td><?= $remark['cin_remark'] ?></td>
                                                <td><?= is_ok($remark['cout_ok']) ?></td>
                                                <td><?= photo($remark['cout_photo']) ?></td>
                                                <td><?= $remark['cout_remark'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
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