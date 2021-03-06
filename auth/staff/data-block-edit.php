
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php
    if(isset($_GET['id'])){

        $block_id = $_GET['id'];
        $q_block = $db->query("SELECT * FROM blocks WHERE id=$block_id");

        $block = $q_block->fetch_assoc();

        if(!$block){
            echo "<script>alert('Block not exist!');window.location='data-block.php';</script>";
            exit();
        }

        if(isset($_POST['name'])){


            if(!in_array($_POST['gender'], array_keys(getGender()))){
                echo "<script>alert('Invalid gender!');window.location='data-block-edit.php?id=$block_id'</script>";
            }

            $gender = $_POST['gender'];

            $name = strtoupper($_POST['name']);
            $is_active = (isset($_POST['is_active']))? 1 : 0;
            $update = "UPDATE blocks set name='$name',for_gender='$_POST[gender]' WHERE id='$_GET[id]'";
            if (!$db->query($update)) {
                echo "Error: " . $update . "<br>" . $db->error; exit();
            }else{
                echo "<script>alert('Block successfully updated!');window.location='data-block.php'</script>";
            }
        }

    }else{
        echo "<script>alert('Invalid URL!');window.location='data-block.php'</script>";

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
                                    <li class="breadcrumb-item active"><a href="data-block.php">Block</a> </li>
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
                                        <input class="form-control text-uppercase" name="name" id="name" value="<?= $block['name'] ?>"  type="text" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="gender">For (Gender)</label>
                                        <select id="gender" name="gender" class="form-control">
                                            <?php foreach (getGender() as $gender => $g_name){?>
                                                <option value="<?= $gender ?>" <?= ($gender == $block['for_gender'])? "selected" : "" ?>><?=$g_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="data-block.php" class="btn btn-secondary">Cancel</a>
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
</html>