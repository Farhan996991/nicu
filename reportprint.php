<?php  require "dbconfig.php"; ?>
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



<?php


$stmt2 = $conn->prepare("SELECT * FROM doctor");
$stmt2->execute();
$doctors = $stmt2->fetchAll(); // Fetch all doctors into an array
$doctorid = null;
$year=null;
$month=null;


// Check if 'doctorid' is set in the URL
if (isset($_GET['doctorId'])) {
    $doctorid = $_GET['doctorId'];
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
/*var_dump($doctorid,$year,$month);die;*/
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
<body>
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
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
<?php
    // Check if 'doctorid' is set in the URL
     if (isset($_GET['doctorId'])) {
    $doctorid = $_GET['doctorId'];

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


<?php
$currentTime = date('Y-m-d H:i:s');
?>
<div class="row">
    <div class="col-md-6">
        <p>Print Date: <b> <?php echo $currentTime; ?></b></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            <h3>Monthly Doctor Report</h3>
            <hr>
            <h4>Al-Qadeer Hospital</h4>
            <h5>Dr. Sher Muhammad Road, Quetta</h5>
            <h5>NICU/ICU</h5>
            <hr>



        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
      <?php if (isset($doctorid)) { ?>
        <h6>Doctor Name: <?php echo $doctorname; ?></h6>
    <?php } ?>
    </div>
    <div class="col-md-6">
    <?php if (isset($doctorid)) { ?>
        <h6 style="float: right;">Reporting Month: <?php echo $selectedMonthFormatted; ?></h6>
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
         
        <h6 class="text-center">Doctor Share:Rs <?php echo (int)$doctorShare; ?>/-</h6>
</div>
        <?php
         } ?>

<div class="col-md-4">
    <?php if (isset($doctorid)) { ?>
        <h6 class="text-center">Hospital Share:Rs <?php echo (int)$hospitalShare; ?>/-</h6>
    <?php } ?>
</div>
<div class="col-md-4">
    <?php if (isset($doctorid)) { ?>
        <h6 class="text-center">Total Fees:Rs <?php echo (int)$totalDoctorFee; ?>/-</h6>
    <?php } ?>
</div>

                        </div>


                        
                        <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                            
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
</body>
 <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

         <!-- Required datatable js -->
         <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
         <!-- Buttons examples -->
         <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
         <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
         <script src="assets/plugins/datatables/jszip.min.js"></script>
         <script src="assets/plugins/datatables/pdfmake.min.js"></script>
         <script src="assets/plugins/datatables/vfs_fonts.js"></script>
         <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
         <script src="assets/plugins/datatables/buttons.print.min.js"></script>
         <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
         <!-- Responsive examples -->
         <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
         <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
 
         <!-- Datatable init js -->
         <script src="assets/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        


</html>

<script> window.print();</script>
