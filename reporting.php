<?php
 include "header.php";
 require "dbconfig.php";

$stmt2 = $conn->prepare("SELECT * FROM doctor");
$stmt2->execute();
$doctors = $stmt2->fetchAll(); // Fetch all doctors into an array
$doctorid = null;
$year=null;
$month=null;


// Check if 'doctorid' is set in the URL
if (isset($_GET['doctorid'])) {
    $doctorid = $_GET['doctorid'];
    // You can fetch the doctor's name using a separate query here
}

if (isset($_GET['selectedMonth'])) {
    list($year, $month) = explode('-', $_GET['selectedMonth']);
}

$stmt4 = $conn->prepare("SELECT patient.regno, patient.patientname, fees.doctorfee, fees.dateoe, doctor.doctorname FROM fees 
    JOIN patient ON patient.id = fees.patientid
    JOIN doctor ON fees.doctorid = doctor.id WHERE doctor.id = :doctorid 
    AND YEAR(fees.dateoe) = :year
    AND MONTH(fees.dateoe) = :month");
$stmt4->bindParam(':doctorid', $doctorid);
$stmt4->bindParam(':year', $year);
$stmt4->bindParam(':month', $month);
$stmt4->execute();

$stmt5 = $conn->prepare("SELECT patient.regno, patient.patientname, fees.doctorfee, fees.dateoe, doctor.doctorname FROM fees 
    JOIN patient ON patient.id = fees.patientid
    JOIN doctor ON fees.doctorid = doctor.id WHERE doctor.id = :doctorid 
    AND YEAR(fees.dateoe) = :year
    AND MONTH(fees.dateoe) = :month");
$stmt5->bindParam(':doctorid', $doctorid);
$stmt5->bindParam(':year', $year);
$stmt5->bindParam(':month', $month);
$stmt5->execute();
?>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">NICU</a></li>
                            
                            <li class="breadcrumb-item active">Reporting</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Monthly Reports</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form action="reporting.php" method="GET">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Doctor Name</label>
                                        <select id="doctorid" name="doctorid" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($doctors as $doctor) {
                                                echo '<option value="' . $doctor['id'] . '">' . $doctor['doctorname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Select Month</label>
                                        <div>
                                            <input id=selectedMonth name="selectedMonth" type="month" class="form-control" required
                                                 />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div style="padding-top: 30px;">
                                             
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="generate">Generate Report</button>


                                            <button id="printBtn" type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Download Report" name="print"><i class="mdi mdi-arrow-down-bold-circle-outline"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->     
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
<?php
    // Check if 'doctorid' is set in the URL
    if (isset($_GET['doctorid'])) {
        $doctorid = $_GET['doctorid'];

        // Query the database to fetch the doctor's name
        $stmtDoctorName = $conn->prepare("SELECT doctorname FROM doctor WHERE id = :doctorid");
        $stmtDoctorName->bindParam(':doctorid', $doctorid);
        $stmtDoctorName->execute();
        $doctorNameRow = $stmtDoctorName->fetch();

        if ($doctorNameRow) {
            $doctorname = $doctorNameRow['doctorname'];
        }
    }
    if (isset($_GET['selectedMonth'])) {
        list($year, $month) = explode('-', $_GET['selectedMonth']);
        $selectedMonthFormatted = date("F Y", strtotime($_GET['selectedMonth']));
    }
?>
<div class="row">
    <div class="col-md-6">
        <?php if (isset($doctorname)) { ?>
            <h6>Doctor Name: <?php echo $doctorname; ?></h6>
        <?php } ?>
    </div>
    <div class="col-md-6">
    <?php if (isset($doctorid)) { ?>
        <h6>Reporting Month: <?php echo $selectedMonthFormatted; ?></h6>
    <?php } ?>
    </div>
</div>
<?php
    if (isset($doctorid)) {
        $totalDoctorFee = 0;
        $doctorShare = 0;
        $hospitalShare = 0;

        while ($row5 = $stmt5->fetch()) {
            if (is_array($row5)) { // Check if $row5 is an array
                $totalDoctorFee += $row5['doctorfee'];
            }
        }

        // Calculate shares after looping through all rows
        $doctorShare = 0.7 * $totalDoctorFee;
        $hospitalShare = 0.3 * $totalDoctorFee;
        ?>
        <div class="row">
    <div class="col-md-4">
         
        <h6>Doctor Share: Rs <?php echo (int)$doctorShare; ?>/-</h6>
</div>
        <?php
         } ?>

<div class="col-md-4">
    <?php if (isset($doctorid)) { ?>
        <h6>Hospital Share: Rs <?php echo (int)$hospitalShare; ?>/-</h6>
    <?php } ?>
</div>
<div class="col-md-4">
    <?php if (isset($doctorid)) { ?>
        <h6>Total Fees: Rs <?php echo (int)$totalDoctorFee; ?>/-</h6>
    <?php } ?>
</div>

                        </div>


                        
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            
                            <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Registration No</th>
                                <th>Patient Name</th>
                                <th>Date</th>
                              
                                <th>Total Doctor Fee(Rs/-)</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                while ($row4=$stmt4->fetch()) {
                                    
                             ?>   
                            <tr>
                                <td style="text-align: center;"><?php echo $i++ ?></td>
                                <td style="text-align: center;"><?php echo $row4['regno']; ?></td>
                                <td style="text-align: center;"><?php echo $row4['patientname']; ?></td>
                                <td style="text-align: center;"><?php echo $row4['dateoe']; ?></td>
                                
                                <td style="text-align: center;"><?php echo $row4['doctorfee']; ?></td>
                            </tr>
                            <?php
                            }
                           ?>
                            </tbody>
                        </table>
<?php
if (isset($_GET['generate'])) {
// Handle the form submission here
// Access the selected doctor's ID using $_GET['doctorid']
$selectedDoctorID = $_GET['doctorid'];
$selectedMonth = $_GET['selectedMonth'];

// Generate the report based on the selected doctor and month
// You can write your report generation logic here
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
    function reportingprint() {
            
        }
</script>
<?php
 include "footer.php";
?>

<script type="text/javascript">
    $('#printBtn').on('click',function(e){
        e.preventDefault();
        const date = $('#selectedMonth').val();
        const doctorId = $('#doctorid').val();

        window.location.href = 'reportprint.php?selectedMonth='+date+'&doctorId='+doctorId;
    })
</script>