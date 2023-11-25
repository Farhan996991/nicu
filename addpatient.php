 <?php 
    include "header.php"; 
    require "dbconfig.php";

    $stmt2 = $conn->prepare("SELECT * FROM doctor");
    

    $stmt2 -> execute();
?>

    <div class="page-content-wrapper ">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">NICU</a></li>
                                
                                <li class="breadcrumb-item active">Add Patient Details</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Patient Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                

                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="addpatient.php" method="POST" id="form">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Registration No</label>
                                                <div>
                                                    <input name="regno" type="number" class="form-control" required
                                                         placeholder="Enter Registration #"/>
                                                         <input type="hidden" name="dateofentry">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <div>
                                                <input name="patientname" type="text" class="form-control" required
                                                     placeholder="Enter Patient Name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Age(In days)</label>
                                            <div>
                                                <input name="patientage" type="number" class="form-control" required
                                                     placeholder="Enter Age"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">   
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" required class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                                    <option>Select</option>
                                                     
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                    <label>Weight</label>
                                            <div>
                                                <input name="weight" type="number" class="form-control" required
                                                     placeholder="Enter Weight(kg)"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <div>
                                                <input name="dob" type="date" class="form-control" required
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
                                                <input name="doa" type="date" class="form-control" required
                                                     />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Time of Admission</label>
                                            <div>
                                                <input name="toa" type="time" class="form-control" required
                                                     />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                    <label>Date of Discharge</label>
                                            <div>
                                                <input name="dod" type="date" class="form-control" required
                                                     />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Time of Discharge</label>
                                            <div>
                                                <input name="tod" type="time" class="form-control" required
                                                     />
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                                <div>
                                                                    <input name="patientphone" type="text" class="form-control" id="phoneNumber" required
                                                                         placeholder="Enter Phone Number"/>
                                                                         <span class="font-13 text-muted">00000000000</span>
                                                                </div>
                                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>CNIC</label>
                                            <div>
                                                <input name="cnic" type="text" class="form-control" id="cnicNumber" required
                                                     placeholder="Enter CNIC"/>
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
                                               <textarea name="address" id="textarea" class="form-control" maxlength="225" rows="2" placeholder="Enter your Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Doctor Name</label>

                                                <select name="doctorid" id="doctorid" class="select2 form-control mb-3 custom-select" style="width: 100%; height: 36px;">
                                                    <option>Select</option>
                                                    <?php
                                                             while($row=$stmt2->fetch())
                                                             {?>
                                                                <option value="<?php echo $row['id']
                                                            ?>"><?php echo $row['doctorname']
                                                            ?></option>            
                                                            <?php
                                                                    }
                                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Diagnosis</label>
                                            <div>
                                                <input name="diagnosis" type="text" class="form-control" required
                                                     placeholder="Enter Diagnosis"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <div>
                                        <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="patientslist.php">
    <button type="button" class="btn btn-secondary waves-effect m-l-5">
        Cancel
    </button>
</a>
                                    </div>
                                </div>
                            </form>
        <?php
    if (isset($_POST['submit'])) {
    $regno = $_POST['regno'];
    $patientname = $_POST['patientname'];
    $patientage = $_POST['patientage'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $dob = $_POST['dob'];
    $doa = $_POST['doa'];
    $toa = $_POST['toa'];
    /*$dod = $_POST['dod'];
    $tod = $_POST['tod'];*/
    $patientphone = $_POST['patientphone'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $doctorid = $_POST['doctorid'];
    $diagnosis = $_POST['diagnosis'];
    $dateofentry=$_POST['dateofentry'];
     $currentDateTime = date("Y-m-d H:m:s");

    $dischargestatus = 0;

    // Replace this SQL query with the appropriate query to insert data into your table.
   $sql = "INSERT INTO patient (regno, patientname, patientage, gender, weight, dob, doa, toa, /*dod, tod,*/ patientphone, cnic, address, doctorid, diagnosis, dischargestatus, dateofentry) VALUES (:regno, :patientname, :patientage, :gender, :weight, :dob, :doa, :toa, /*:dod, :tod,*/ :patientphone, :cnic, :address, :doctorid, :diagnosis, :dischargestatus, :dateofentry)";
    $query = $conn->prepare($sql);
    $query->bindParam(':regno', $regno);
    $query->bindParam(':patientname', $patientname);
    $query->bindParam(':patientage', $patientage);
    $query->bindParam(':gender', $gender);
    $query->bindParam(':weight', $weight);
    $query->bindParam(':dob', $dob);
    $query->bindParam(':doa', $doa);
    $query->bindParam(':toa', $toa);
    /*$query->bindParam(':dod', $dod);
    $query->bindParam(':tod', $tod);*/
    $query->bindParam(':patientphone', $patientphone);
    $query->bindParam(':cnic', $cnic);
    $query->bindParam(':address', $address);
    $query->bindParam(':doctorid', $doctorid);
    $query->bindParam(':diagnosis', $diagnosis);
    $query->bindParam(':dischargestatus', $dischargestatus); // Bind the dischargedstatus
    $query->bindParam(':dateofentry', $currentDateTime);
    $query->execute();

    echo "Patient Added";

    // Close the database connection
    }
    ?>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->                    

    </div><!-- container -->

</div> <!-- Page content Wrapper -->

<script>
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