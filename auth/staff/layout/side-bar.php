<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href="#"><img class="utem-logo-sm"  src="../../../assets/images/endless-logo.png" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <h6 class="mt-3 f-14"><?=$_SESSION['auth']['fullname'] ?></h6>
            <p><?=$_SESSION['auth']['role'] ?></p>
        </div>
        <ul class="sidebar-menu">

            <li><a class="sidebar-header " href="index.php"><i data-feather="menu"></i><span>Dashboard</span></a></li>
            <li><a class="sidebar-header " href="data-rent.php"><i data-feather="menu"></i><span>Renting Management</span></a></li>

            <?php if($_SESSION['auth']['role'] == 'admin'){ ?>
            <li class="">
                <a class="sidebar-header" href="#"><i data-feather="home"></i><span>Data Management</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="data-block.php" class=""><i class="fa fa-circle"></i>Block</a></li>
                    <li><a href="data-inventory.php" class=""><i class="fa fa-circle"></i>Inventory</a></li>
                    <li><a href="data-session.php" class=""><i class="fa fa-circle"></i>Session</a></li>
                </ul>
            </li>
            <li class="">
                <a class="sidebar-header" href="#"><i data-feather="users"></i><span>User Management</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="management-student.php" class=""><i class="fa fa-circle"></i>Student</a></li>
                    <li><a href="management-staff.php" class=""><i class="fa fa-circle"></i>Staff</a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="">
                <a class="sidebar-header" href="#"><i data-feather="user"></i><span>My Account</span><i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="account-password.php"><i class="fa fa-circle"></i>Change Password</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="../logout.php"><i data-feather="menu"></i><span>Logout</span></a></li>
        </ul>
    </div>
</div>

<div class="right-sidebar" id="right_side_bar">
    <div>
        <div class="container p-0">
            <div class="modal-header p-l-20 p-r-20">
                <div class="col-sm-8 p-0">
                    <h6 class="modal-title font-weight-bold">FRIEND LIST</h6>
                </div>
                <div class="col-sm-4 text-right p-0"><i class="mr-2" data-feather="settings"></i></div>
            </div>
        </div>
        <div class="friend-list-search mt-0">
            <input type="text" placeholder="search friend"><i class="fa fa-search"></i>
        </div>
        <div class="p-l-30 p-r-30">
            <div class="chat-box">
                <div class="people-list friend-list">
                    <ul class="list">
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/1.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Vincent Porter</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/2.png" alt="">
                            <div class="status-circle away"></div>
                            <div class="about">
                                <div class="name">Ain Chavez</div>
                                <div class="status"> 28 minutes ago</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/8.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Kori Thomas</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/4.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Erica Hughes</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/5.jpg" alt="">
                            <div class="status-circle offline"></div>
                            <div class="about">
                                <div class="name">Ginger Johnston</div>
                                <div class="status"> 2 minutes ago</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/6.jpg" alt="">
                            <div class="status-circle away"></div>
                            <div class="about">
                                <div class="name">Prasanth Anand</div>
                                <div class="status"> 2 hour ago</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="assets/images/user/7.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Hileri Jecno</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>