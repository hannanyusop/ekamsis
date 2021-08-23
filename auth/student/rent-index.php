
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_user.php') ?>
<?php
$q_session = $db->query("SELECT * FROM sessions where is_current=1");

$session = $q_session->fetch_assoc();

$r_rent = $db->query("SELECT * FROM rents WHERE user_id=$user_id");
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
                                <div class="table-responsive product-table">
                                    <table class="display table-sm">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Session</th>
                                            <th>Room</th>
                                            <th>Checkin On</th>
                                            <th>Checkout On</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($data = $r_rent->fetch_assoc()){ ;?>

                                            <?php
                                            $rs_q = $db->query("SELECT rs.id as sub_id, floor,name,code FROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE rs.id= $data[room_sub_id]");
                                            $rs = $rs_q->fetch_assoc();

                                            $session_q = $db->query("SELECT * FROM sessions WHERE id=$data[session_id]");
                                            $session = $session_q->fetch_assoc();
                                            ?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= $session['name'] ?></td>
                                                <td><?= $rs['floor']." ".$rs['name']." - ".$rs['code'] ?></td>
                                                <td class="text-center"><?= (!is_null($data['check_in_on']))? $data['check_in_on'] : "Not Yet"; ?></td>
                                                <td class="text-center"><?= (!is_null($data['check_out_on']))? $data['check_out_on'] : "Not Yet"; ?></td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="rent-view.php?id=<?= $data['id'] ?>">View</a>

                                                    <?php if($current_session['id'] == $session['id']){ ?>
                                                        <?php if(is_null($data['check_in_on']) ) { ?>
                                                            <?php
                                                            if($session['allow_checkin'] == 1){
                                                                echo '<a class="btn btn-success btn-sm" href="check-in.php?id='.$data['id'].'">Check-in</a>';
                                                            }else{
                                                                echo '<a class="btn btn-success btn-sm disabled" href="#">Check-in</a>';
                                                            }
                                                            ?>

                                                        <?php }elseif(!is_null($data['check_in_on']) && is_null($data['check_out_on'])){ ?>
                                                            <a class="btn btn-success btn-sm" href="check-out.php?id=<?= $data['id']; ?>">Check-out</a>

                                                            <?php
                                                            if($session['allow_checkout'] == 1){
                                                                echo '<a class="btn btn-success btn-sm" href="check-out.php?id='.$data['id'].'">Check-out</a>';
                                                            }else{
                                                                echo '<a class="btn btn-success btn-sm disabled" href="#">Check-in</a>';
                                                            }
                                                            ?>
                                                        <?php } ?>
                                                    <?php } ?>
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