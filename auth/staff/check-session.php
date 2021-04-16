
<!DOCTYPE html>
<html lang="en">

<?= include('layout/head.php'); ?>

<?php
    $sessions = array('2019/2020 1', '2019/2020 2', '2020/2021 1')
?>
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
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <form class="theme-form" action="check-info.php" method="post">
                                    <h5 class="font-weight-bold">Select Session</h5>

                                    <div class="form-group">
                                        <label for="session">Session</label>
                                        <select class="form-control" id="session" name="session">
                                            <?php foreach ($sessions as $key => $session): ?>
                                                <option value="<?= $key; ?>"><?= $session ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" data-original-title="" title="">Submit</button>
                                        <button class="btn btn-secondary" data-original-title="" title="">Cancel</button>
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