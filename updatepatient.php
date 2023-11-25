            <?php
include 'header.php';
include 'dbconfig.php';
$id = $_GET['id'];
$stmt=$conn->prepare("SELECT * FROM patient WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$row2 = $stmt->fetch();


$stmt3=$conn->prepare("SELECT patient.*, doctor.doctorname
                      FROM patient
                      LEFT JOIN doctor ON patient.doctorid = doctor.id
                      WHERE patient.id = :id");
$stmt3->bindParam(':id', $id);
$stmt3->execute();
$row3 = $stmt3->fetch();

$stmt4=$conn->prepare("SELECT * FROM doctor");
$stmt4->execute();
// $row4=$stmt4->fetch();
?>

<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">NICU</a></li>
                            
                            <li class="breadcrumb-item active">Patient Update Form</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Patient Update Form</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            

            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form action="" method="POST" id="form">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Registration No</label>
                                            <div>
                                                <input name="regno" type="number" class="form-control" value="<?php echo $row2['regno']; ?>"required readonly
                                                     />
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <div>
                                            <input name="patientname" type="text" class="form-control" value="<?php echo $row2['patientname']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Age(In days)</label>
                                        <div>
                                            <input name="patientage" type="number" class="form-control" value="<?php echo $row2['patientage']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">   
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                                <option value=""><?php echo $row2['gender'];
                                            ?></option>
                                                
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                <label>Weight</label>
                                        <div>
                                            <input name="weight" type="number" class="form-control" value="<?php echo $row2['weight']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div>
                                            <input name="dob" type="date" class="form-control" value="<?php echo $row2['dob']; ?>"
                                                 />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                <label>Date of Admission</label>
                                        <div>
                                            <input name="doa" type="date" class="form-control" value="<?php echo $row2['doa']; ?>"
                                                 />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Time of Admission</label>
                                        <div>
                                            <input name="toa" type="time" class="form-control" value="<?php echo $row2['toa']; ?>"
                                                 />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                <label>Phone Number</label>
                                        <div>
                                            <input name="patientphone" id="phoneNumber" type="text" class="form-control" value="<?php echo $row2['patientphone']; ?>"/>
                                            <span class="font-13 text-muted">00000000000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>CNIC</label>
                                        <div>
                                            <input name="cnic" id="cnicNumber" type="text" class="form-control" value="<?php echo $row2['cnic']; ?>"/>
                                            <span class="font-13 text-muted">0000000000000</span>
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
                                                        <textarea name="address" id="textarea" class="form-control" maxlength="225" rows="2"><?php echo $row2["address"]; ?></textarea>
                                                        </div>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Doctor Name</label>

         <select name="doctorid" id="doctorid" class="select2 form-control mb-3 custom-select" style="width: 100%; height: 36px;">
    <option value="<?php echo $row3['doctorid']; ?>"><?php echo $row3['doctorname']; ?></option>
    <?php
    while ($row4 = $stmt4->fetch()) {
        echo '<option value="' . $row4['id'] . '">' . $row4['doctorname'] . '</option>';
    }
    ?>
</select>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Diagnosis</label>
                                            <div>
                                                <input name="diagnosis" type="text" class="form-control" value="<?php echo $row2['diagnosis']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                 <div class="checkbox my-2">
                                                    <div  class="custom-control custom-checkbox">
                                                        <input name="dischargestatus" type="checkbox" class="custom-control-input" id="customCheck2">
<label class="custom-control-label" for="customCheck2">Is Patient Discharged?</label>

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                <div class="row" >
                                <div class="col-lg-6" id="discharged1">
                                    <div class="form-group">
                                <label>Date of Discharge</label>
                                        <div >
                                            <input name="dod" type="date" class="form-control" id="dod" 
                                                 />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="discharged2">
                                    <div class="form-group">
                                        <label>Time of Discharge</label>
                                        <div >
                                            <input name="tod" type="time" class="form-control" id="tod"
                                                 />
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group m-b-0">
                                    <div>
                                        <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light">
                                            Update
                                        </button>
                                        <a href="patientslist.php">
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </a>
                                    </div>
                                </div>
                            </form>
        <?php
if (isset($_POST['submit'])) {
    // Check if the checkbox is checked and update the dischargestatus value accordingly
    $dischargestatus = isset($_POST['dischargestatus']) ? 1 : 0;

    $regno = $_POST['regno'];
    $patientname = $_POST['patientname'];
    $patientage = $_POST['patientage'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $dob = $_POST['dob'];
    $doa = $_POST['doa'];
    $toa = $_POST['toa'];
    $dod = $_POST['dod'] ? $_POST['dod'] : null;
    $tod = $_POST['tod'];
    $patientphone = $_POST['patientphone'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $doctorid = $_POST['doctorid'];
    $diagnosis = $_POST['diagnosis'];

    // Replace this SQL query with the appropriate query to insert data into your table.
    $stmt2 = $conn->prepare("UPDATE patient SET 
        regno = :regno, 
        patientname = :patientname, 
        patientage = :patientage, 
        gender = :gender, 
        weight = :weight, 
        dob = :dob, 
        doa = :doa, 
        toa = :toa, 
        dod = :dod, 
        tod = :tod, 
        patientphone = :patientphone, 
        cnic = :cnic, 
        address = :address, 
        doctorid = :doctorid, 
        diagnosis = :diagnosis, 
        dischargestatus = :dischargestatus
        WHERE id = :id");

    $stmt2->bindParam(':regno', $regno);
    $stmt2->bindParam(':patientname', $patientname);
    $stmt2->bindParam(':patientage', $patientage);
    $stmt2->bindParam(':gender', $gender);
    $stmt2->bindParam(':weight', $weight);
    $stmt2->bindParam(':dob', $dob);
    $stmt2->bindParam(':doa', $doa);
    $stmt2->bindParam(':toa', $toa);
    $stmt2->bindParam(':dod', $dod);
    $stmt2->bindParam(':tod', $tod);
    $stmt2->bindParam(':patientphone', $patientphone);
    $stmt2->bindParam(':cnic', $cnic);
    $stmt2->bindParam(':address', $address);
    $stmt2->bindParam(':doctorid', $doctorid);
    $stmt2->bindParam(':diagnosis', $diagnosis);
    $stmt2->bindParam(':dischargestatus', $dischargestatus);
    $stmt2->bindParam(':id', $id);

    if ($stmt2->execute()) {
        ?>
        <script>
            alert("Patient Has Been Updated");
            window.location.href = "patientslist.php";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Kindly Enter The Correct Data");
            window.location.href = "patientlist.php";
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


                //Function for Checkbox
               <script>
document.addEventListener("DOMContentLoaded", function () {
    // Get references to the checkbox and the row containing the date and time inputs
    var checkbox = document.getElementById("customCheck2");
    const dischargestatusCheckbox = document.getElementById("customCheck2");
    var dischargedRow1 = document.getElementById("discharged1");
    var dischargedRow2 = document.getElementById("discharged2");
    const dodInput = document.getElementById("dod");
    const todInput = document.getElementById("tod");

    // Function to toggle the visibility of the discharged row
    function toggleDischargedRow() {
        if (checkbox && dischargedRow1 && dischargedRow2) {
            dischargedRow1.style.display = checkbox.checked ? "block" : "none";
            dischargedRow2.style.display = checkbox.checked ? "block" : "none";
        }
    }

    // Initial toggle based on checkbox state
    toggleDischargedRow();

    // Add an event listener to the checkbox
    if (checkbox) {
        checkbox.addEventListener("change", function () {
            toggleDischargedRow();
        });
    }
     dischargestatusCheckbox.addEventListener("change", function() {
        if (dischargestatusCheckbox.checked) {
            // If the checkbox is checked, make the "dod" and "tod" fields required
            dodInput.required = true;
            todInput.required = true;
        } else {
            // If the checkbox is unchecked, remove the "required" attribute
            dodInput.required = false;
            todInput.required = false;
            dodInput.value = null;
            todInput.value = null;
        }
    });
});
    const form = document.getElementById('form');
    const phoneNumber = document.getElementById('phoneNumber');
    const cnicNumber = document.getElementById('cnicNumber');

    form.addEventListener('submit', function (event) {
        const phoneNumberValue = phoneNumber.value;
        const cnicValue = cnicNumber.value;
        const phoneNumberPattern = /^\d+$/; // This regular expression checks for only digits
        const cnicPattern = /^\d+$/;
        if (phoneNumberValue.length !== 11 || !phoneNumberPattern.test(phoneNumberValue)) {
            alert('Phone Number must be 11 digits long and contain only numbers.');
            event.preventDefault(); // Prevent form submission
        }
        if (cnicValue.length !== 13 || !cnicPattern.test(cnicValue)) {
            alert('CNIC must be 13 digits long and contain only numbers.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>





                 <?php include "footer.php"; ?>