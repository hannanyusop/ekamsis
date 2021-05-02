
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php
    if(isset($_POST['year1'])){


        $is_current = (isset($_POST['is_current']))? 1 : 0;


        $name = $_POST['year1']."/".$_POST['year2']." SEM".$_POST['semester'];

        $check_q = $db->query("SELECT * FROM sessions WHERE name='$name'");
        $exist = $check_q->fetch_assoc();

        if($exist){
            echo "<script>alert('Session for $name already exist!');</script>";
            exit();
        }


        if($is_current == 1){
            $db->query("UPDATE sessions SET is_current=0 WHERE is_current=1");
        }
        $q = "INSERT INTO sessions (name, is_current, year1, year2, semester) VALUES ('$name', $is_current, '$_POST[year1]', '$_POST[year2]', '$_POST[semester]')";
        if (!$db->query($q)) {
            echo "Error: " . $q . "<br>" . $db->error; exit();
        }else{

            echo "<script>alert('New session successfully inserted!');window.location='data-session.php'</script>";
        }
    }
?>
<?php include('layout/head.php'); ?>

<body main-theme-layout="main-theme-layout-1">

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
                                    <li class="breadcrumb-item active"><a href="data-session.php">Session</a> </li>
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
                                <h5>Add New Session</h5>
                            </div>
                            <div class="card-body">
                                <form class="theme-form" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label pt-0" for="year1">Year 1</label>
                                                <select class="form-control digits" id="year1" name="year1">
                                                    <?php foreach (getYear() as $year){ ?>
                                                        <option value="<?= $year ?>"><?= $year ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label pt-0" for="year2">Year 2</label>
                                                <input class="form-control" name="year2" id="year2"  type="text" readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="year2">Semester</label>
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                            <div class="radio radio-primary">
                                                <input id="semester" type="radio" name="semester" value="1" checked>
                                                <label class="mb-0" for="semester">1</label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="semester2" type="radio" name="semester" value="2">
                                                <label class="mb-0" for="semester2">2</label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="semester3" type="radio" name="semester" value="1">
                                                <label class="mb-0" for="semester3">3</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input id="is_current" name="is_current" type="checkbox">
                                            <label for="is_current">Set as current session</label>
                                        </div>
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

<?php include('layout/script.php'); ?>
<script>
    $('#year1').on('change', function() {

        y1 = $(this).val();
        $("#year2").val(parseInt(y1)+1);
    });
</script>
</html>