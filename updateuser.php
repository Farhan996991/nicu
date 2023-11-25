<?php
 include "header.php";
 require "dbconfig.php";
$id = $_GET['id'];
$stmt=$conn->prepare("SELECT * FROM user WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$row = $stmt->fetch();
?>

<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">NICU</a></li>
                            
                            <li class="breadcrumb-item active">User Update Form</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User Update Form</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            

            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form action="" id="form" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                            <div>
                                                <input name="name"  type="text" class="form-control" value="<?php echo $row['name']; ?>" required />
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                       <div>
                                        <input name="phone" id="phoneNumber" type="text" class="form-control" value="<?php echo $row['phone']; ?>" required />
                                        <span class="font-13 text-muted">(0000)0000000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                            <div>
                                                <input name="email"  type="text" class="form-control" value="<?php echo $row['email']; ?>" required />
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>UserID</label>
                                       <div>
                                        <input name="userid" id=" type="text" class="form-control" value="<?php echo $row['userid']; ?>" required />
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                                     <div class="form-group m-b-0">
                                <div>
                                    
                                     <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light">
                                        Update
                                    </button>

                                    
                                    <button  type="reset" class="btn btn-secondary waves-effect m-l-5" >
                                        <a style="color: white;" href="doctorlist.php">Cancel</a>
                                        
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </form>
     <?php
if (isset($_POST['submit'])) {
$userid = $_POST['userid'];
$name = $_POST['name'];
$password=md5($_POST['password']);
$phone = $_POST['phone'];
$email = $_POST['email'];

$checkStmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE userid = :userid");
    $checkStmt->bindParam(':userid', $userid);
    $checkStmt->execute();
    $count = $checkStmt->fetchColumn();
if ($count > 0) {
        // The userid already exists, display an error message
        ?>
            <script>
            alert("User ID already exists. Please choose a different one.")
            window.location.href="updateuser.php?id=<?php echo $row['id'] ?>";</script>

            <?php
    } else {
            $stmt2= $conn->prepare("  UPDATE user SET  userid = '$userid' , name = '$name', password = '$password' , phone = '$phone', email = '$email' WHERE user.id = '$id' ");
    }     
if ($stmt2->execute()) {
?>
<script>
alert("User Has Been Updated");
window.location.href="user.php";
</script>
<?php
}
else{
?>
<script type="text/javascript">
alert("Kindly Enter The Correct Data");
window.location.href("user.php");
</script>
<?php
}
}
?>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->                    

    </div><!-- container -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->
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

</script>

<?php include "footer.php"; ?>