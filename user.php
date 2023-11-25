<?php
 include "header.php";
 require "dbconfig.php";
 $stmt = $conn->prepare("SELECT * FROM user");
 $stmt -> execute();
 ?>

<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">NICU</a></li>
                            
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="col-lg-12" >
                                    <div class="text-right">
                                       
                                        <!-- Large modal -->
                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="PopupForm(0)" data-animation="bounce" data-target=".bs-example-modal-lg">Add User</button>
                                    </div>


                                    <!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title mt-0" id="myLargeModalLabel">Add User Details</h5>

</div>
<div class="modal-body">
<form action="user.php" id="form" method="POST">

<div class="row">
<div class="col-lg-6">
    <div class="form-group">
        <label>Full Name</label>
            <div>
                <input name="name" type="text" class="form-control" required
                     placeholder="Enter Full Name"/>
            </div>
        </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Email</label>
        <div>
            <input name="email" type="email" class="form-control" required
                 placeholder="Enter Email"/>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
    <div class="form-group">
        <label>Phone Number</label>
            <div>
                <input name="phone" type="text" class="form-control" id="phoneNumber" required
                     placeholder="Enter Phone Number"/>
                     <span class="font-13 text-muted">00000000000</span>
            </div>
        </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>UserID</label>
        <div>
            <input name="userid" type="text" class="form-control" required
                 placeholder="Enter UserID"/>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
    <div class="form-group">
        <label>Password</label>
            <div>
                <input name="password"type="password" class="form-control" required
                     placeholder="Enter Password"/>
            </div>
        </div>
</div>
<!-- <div class="col-lg-6">
    <div class="form-group">
        <label>Confirm Password</label>
        <div>
            <input type="password" class="form-control" required
                 placeholder="Confirm Password"/>
        </div>
    </div>
</div> -->
</div>

<div class="form-group m-b-0">
<div>
    <button name ="submit" type="submit" class="btn btn-primary waves-effect waves-light">
        Submit
    </button>
    <a href="user.php">
    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
        Reset
    </button>
</a>
</div>
</div>
</form>
<?php
if (isset($_POST['submit'])) {
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$userid=$_POST['userid'];
$password=md5($_POST['password']); 
// Check if the userid already exists
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE userid = :userid");
    $checkStmt->bindParam(':userid', $userid);
    $checkStmt->execute();
    $count = $checkStmt->fetchColumn();

if ($count > 0) {
        // The userid already exists, display an error message
        ?>
            <script>alert("User ID already exists. Please choose a different one.")</script>
            <?php
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO user (name, phone, email, userid, password) VALUES (:name, :phone, :email, :userid, :password)";
        $query = $conn->prepare($sql);
        $query->bindParam(':name', $name);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':email', $email);
        $query->bindParam(':userid', $userid);
        $query->bindParam(':password', $password);

        if ($query->execute()) {
            ?>
            <script>alert("User Added Successfully")</script>
            <?php
        } else {
            ?>
            <script>alert("Error Adding User")</script>
            <?php
        }
    }


?>
<script>window.location.href="user.php";</script>
<?php

}
?>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                                <h4 class="mt-0 header-title">List of Users</h4>
                            </div>
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>UserID</th>
                                    <th>Update</th>
                                    <th>Delete</th>


                                </tr>
                                </thead>


                                <tbody>
                                <?php
                                    while($row=$stmt->fetch())
                                    {
                                ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['userid'] ?></td>
                                    <td><a href="updateuser.php?id=<?php echo $row ['id'];?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit User Record"><i class="mdi mdi-table-edit"></i></button></a></td>

                                    <td>
                                        <a href="user.php?id=<?php echo $row['id']; ?>"><button name="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete User Record"><i class="mdi mdi-delete"></i></button></a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->

    </div> <!-- Page content Wrapper -->

</div> <!-- content -->
<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $stmt2=$conn->prepare('DELETE FROM user WHERE id=:id');
        $stmt2->bindParam(':id',$id);
        if($stmt2->execute())
        {
        ?>
        <script> alert("User Deleted");
            window.location.href="user.php";
        </script>
            <?php 
        }
    }
?>
<script>
    const form = document.getElementById('form');
    const phoneNumber = document.getElementById('phoneNumber');

    form.addEventListener('submit', function (event) {
        const phoneNumberValue = phoneNumber.value;
        const phoneNumberPattern = /^\d+$/; // This regular expression checks for only digits

        if (phoneNumberValue.length !== 11 || !phoneNumberPattern.test(phoneNumberValue)) {
            alert('Phone Number must be 11 digits long and contain only numbers.');
            event.preventDefault(); // Prevent form submission
        }
    });
function PopupForm(id) {
            console.log(id);
            var url = "user.php?id=" + id;
            var formDiv = $('#modalbody');
            $.get(url)
                .done(function (response) {
                    formDiv.html(response);

                });
            $("#exampleModal").modal("show");
        }

</script>
                <?php
 include "footer.php";
?>