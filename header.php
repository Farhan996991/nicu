<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>NICU Dasboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        

    </head>

    
    <body class="fixed-left">

<?php
session_start();
if (!isset($_SESSION['userid'])){
    header("Location: login.php");

}

if (isset($_POST['submit_button'])) {
    // Check if "newPassword" and "confirmPassword" keys exist in the array
    if (isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Your password change logic here
        // Add your code to process password changes based on $newPassword and $confirmPassword.
        // For example, you can check if they match and update the password in the database.

    } else {
        // Handle the case when "newPassword" or "confirmPassword" is not set
        echo "Please provide both new and confirmed passwords.";
    }
}
?>
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.php" class="logo"><i class="mdi mdi-assistant"></i> NICU Ward</a>
                        <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="mdi mdi-airplay"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-md"></i> <span> Doctor </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                   
                                    <li><a  href="addDoctor.php"><i class="mdi mdi-account-plus"></i><span> Add Doctor </span></a></li>
                                    <li><a  href="doctorlist.php"><i class="mdi mdi-view-list"></i><span> View Doctors </span></a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-wheelchair"></i> <span> Patient </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                   
                                    <li><a  href="addpatient.php"><i class="mdi mdi-account-plus"></i><span> Add Patient </span></a></li>
                                    <li><a  href="patientslist.php"><i class="mdi mdi-view-list"></i><span> View Patients </span></a></li>
                                    <li><a  href="patientfee.php"><i class="mdi mdi-cash"></i><span> Patient Fee </span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="reporting.php" class="waves-effect">
                                    <i class="mdi mdi-content-paste"></i>
                                    <span> Reporting </span>
                                </a>
                            </li>
                            <li>
                                <a href="user.php" class="waves-effect">
                                    <i class="ion-android-add-contact"></i>
                                    <span> User </span>
                                </a>
                            </li>
                           

 
                            

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">
                        
                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">
                        
                                
                            <li class="list-inline-item dropdown notification-list hide-phone">
                                <p style="color: white;">Welcome <b><?php echo $_SESSION['name']; ?></b></p>
                            </li>

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#changePasswordModal"><i class="mdi mdi-account-key m-r-5 text-muted"></i> Reset Password</a>
                                        <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-light waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                               
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- Modal for Reset Password -->
                    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="changepassword.php">
                    <div class="form-group">
                        <label for="oldPassword">Old Password</label>
                        <input type="password" class="form-control" name="oldPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

