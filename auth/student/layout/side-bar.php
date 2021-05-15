<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href="http://laravel.pixelstrap.com/endless"><img src="../../../assets/images/endless-logo.png" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <h6 class="mt-3 f-14"><?=$_SESSION['auth']['fullname'] ?></h6>
            <p><?=$_SESSION['auth']['role'] ?></p>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-header" href="rent-index.php"><i data-feather="book"></i><span> Rent</span></a></li>
            <li class="">
                <a class="sidebar-header" href="#"><i data-feather="user"></i><span>My Account</span><i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="account-info.php"><i class="fa fa-circle"></i>Basic Information</a></li>
                    <li><a href="account-password.php"><i class="fa fa-circle"></i>Change Password</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="../logout.php"><i data-feather="logout"></i><span> Logout</span></a></li>
        </ul>
    </div>
</div>