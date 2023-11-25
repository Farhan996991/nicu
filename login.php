<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>NICU-Login</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body>

        <?php

            if(isset($_SESSION['status'])){
                echo $_SESSION['status'];
            }
        ?>


        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mt-0 m-b-15">
                        <div class="logo logo-admin"><img src="assets/images/logo11.png" height="150" alt="logo"></div>
                    </h3>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" action="login.php" method="POST">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="userid" type="text" required="" placeholder="Enter UserID">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                </div>
                            </div>

                            

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-danger btn-block waves-effect waves-light" name="signin" value="signin" type="submit">Log In</button>
                                </div>
                            </div>
                        <?php
                                if(isset($_GET['invalid'])){
                ?>
                    <script>
                        alert("Invalid UserID or Password");
                    </script>
            <?php
            }
            ?>

                          
                        </form>


                        <?php
                            include "dbconfig.php";
                            if(isset($_POST['signin'])){
                                    include "functions.php";
                                    $userid=$_POST['userid'];
                                    $password=$_POST['password'];
                                    // var_dump($userid,$password);die;
                                    login($userid,$password);

                            }
                                                  ?>
                    </div>

                </div>
            </div>
        </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>