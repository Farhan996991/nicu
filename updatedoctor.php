                 <?php
include 'header.php';
include 'dbconfig.php';
$id = $_GET['id'];
$stmt=$conn->prepare("SELECT * FROM doctor WHERE id=:id");
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
                            
                            <li class="breadcrumb-item active">Doctor Update Form</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Doctor Update Form</h4>
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
                                        <label>Doctor Name</label>
                                            <div>
                                                <input name="doctorname"  type="text" class="form-control" value="<?php echo $row['doctorname']; ?>" required />
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                       <div>
                                        <input name="doctorphone" id="phoneNumber" type="text" class="form-control" value="<?php echo $row['doctorphone']; ?>" required />
                                        <span class="font-13 text-muted">(0000)0000000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">    
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <div>
                                                <div>
                                                <textarea name="doctoraddress" id="textarea" class="form-control" maxlength="225" rows="2"><?php echo $row["doctoraddress"]; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>    
                                     <div class="form-group m-b-0">
                                <div>
                                    
                                     <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light">
                                        Update
                                    </button>

                                    
                                    <a href="doctorlist.php">
    <button type="button" class="btn btn-secondary waves-effect m-l-5">
        Cancel
    </button>
</a>
                                </div>
                            </div>
                        </form>
    <?php
if (isset($_POST['submit'])) {
$doctorname = $_POST['doctorname'];
$doctorphone = $_POST['doctorphone'];
$doctoraddress = $_POST['doctoraddress'];   

// Replace this SQL query with the appropriate query to insert data into your table.
$stmt2= $conn->prepare("  UPDATE doctor SET  doctorname = '$doctorname' , doctorphone = '$doctorphone', doctoraddress = '$doctoraddress' WHERE doctor.id = '$id' ");

if ($stmt2->execute()) {
?>
<script>
alert("Doctor Has Been Updated");
window.location.href="doctorlist.php";
</script>
<?php
}
else{
?>
<script type="text/javascript">
alert("Kindly Enter The Correct Data");
window.location.href("doctorlist.php");
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