
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_admin.php') ?>
<?php

    if(isset($_GET['name'])){

        $whereGender = '';
        if($_GET['gender'] != ''){
            $whereGender = "AND gender='$_GET[gender]'";
        }
//        AND matric_number LIKE '%$_GET[matric_number]%'
        $name = $_GET['name'];

        $result = $db->query("SELECT * FROM users WHERE fullname LIKE '%$name%' AND matric_number LIKE '%$_GET[matric_number]%' ".$whereGender);

    }else{
        $result = $db->query("SELECT * FROM users");

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
                                    <li class="breadcrumb-item">Student</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">

                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-body">
                               <form class="needs-validation">
                                   <div class="form-row">
                                       <div class="col-md-4 mb-3">
                                           <label for="name">Name</label>
                                           <input class="form-control" id="name" name="name" type="text" placeholder="Student Name" value="<?= $_GET['name'] ?? '' ?>">
                                       </div>
                                       <div class="col-md-4 mb-3">
                                           <label for="gender">Gender</label>
                                           <select id="gender" name="gender" class="form-control">
                                               <option value="" selected>-- ALL --</option>
                                               <?php foreach (getGender() as $gender => $g_name){?>
                                                   <option value="<?= $gender ?>" <?= (isset($_GET['gender']) && $_GET['gender'] == $gender)? "selected" : "" ?>><?=$g_name ?></option>
                                               <?php } ?>
                                           </select>
                                       </div>
                                       <div class="col-md-4 mb-3">
                                           <label for="matric_number">Matric Number</label>
                                           <input class="form-control" id="matric_number" name="matric_number" type="text" placeholder="Matric Number" value="<?= $_GET['matric_number'] ?? '' ?>">
                                       </div>
                                   </div>
                                   <button class="btn btn-primary" type="submit">Search</button>
                               </form>
                           </div>
                       </div>
                   </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive product-table">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Matric Number</th>
                                            <th>Phone Number</th>
                                            <th>Verified</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=0; while($data = $result->fetch_assoc()){  $no++; ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= strLimit($data['fullname'], 20); ?></td>
                                                <td><?= getGender($data['gender']) ?></td>
                                                <td><?= $data['matric_number']; ?></td>
                                                <td><?= $data['phone_number']; ?></td>
                                                <td><?= (is_null($data['verified_at']))? "<span class='badge badge-dark'>Not Verified</span>" : $data['verified_at']; ?></td>
                                                <td>
<!--                                                    <a href="management-student-view.php?id=--><?//=$data['id'] ?><!--" class="btn btn-success btn-xs" type="button">View</a>-->
                                                    <a href="management-student-edit.php?id=<?=$data['id'] ?>" class="btn btn-info btn-xs" type="button">Edit</a>

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