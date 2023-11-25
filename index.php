<?php
 include "header.php";
 include "dbconfig.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the SQL query to count entries in the database table
$sql = "SELECT COUNT(*) as count FROM patient";

// Execute the query
$result = $conn->query($sql);

$count = 0; // Initialize the count variable

if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC); // Use PDO::FETCH_ASSOC to get an associative array
    $count = $row['count'];
}

// Define the SQL query to count doctors in the database
$sql1 = "SELECT COUNT(*) as count FROM doctor";

// Execute the query
$result = $conn->query($sql1);

$doctorCount = 0; // Initialize the count variable

if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC); // Use PDO::FETCH_ASSOC to get an associative array
    $doctorCount = $row['count'];
}

/// SQL query to count the number of patients admitted
$sqlAdmitted = "SELECT COUNT(*) as count FROM patient WHERE dischargestatus='0'";

$resultAdmitted = $conn->query($sqlAdmitted);
$rowAdmitted = $resultAdmitted->fetch();
$patientsAdmitted = $rowAdmitted['count'];

// SQL query to count the number of patients discharged
$sqlDischarged = "SELECT COUNT(*) as count FROM patient WHERE dischargestatus='1'";

$resultDischarged = $conn->query($sqlDischarged);
$rowDischarged = $resultDischarged->fetch();
$patientsDischarged = $rowDischarged['count'];

?>


                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item">NICU</li>
                                                <li class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Dashboard</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->

                                    
                            <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="fa fa-wheelchair"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 align-self-center text-center">
                                                    <div class="m-l-10">
                                                        <h5 class="mt-0 round-inner"><?php echo $count ?></h5>

                                                        <p class="mb-0 text-muted">Total Patients</p>                                                                 
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="col-9 text-center align-self-center">
                                                    <div class="m-l-10 ">
                                                        <h5 class="mt-0 round-inner"><?php echo $patientsAdmitted; ?></h5>
                                                        <p class="mb-0 text-muted">Patients Admitted</p>
                                                    </div>
                                                </div>
                                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round ">
                                                        <i class="mdi mdi-exit-to-app"></i>
                                                    </div>
                                                </div>
                                                <div class="col-9 align-self-center text-center">
                                                    <div class="m-l-10 ">
                                                        <h5 class="mt-0 round-inner"><?php echo $patientsDischarged; ?></h5>
                                                        <p class="mb-0 text-muted">Patients Discharged</p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column -->
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="col-3 align-self-center">
                                                    <div class="round ">
                                                        <i class="fa fa-user-md"></i>
                                                    </div>
                                                </div>
                                                <div class="col-9 align-self-center text-center">
                                                    <div class="m-l-10 ">
                                                        <h5 class="mt-0 round-inner"><?php echo $doctorCount; ?></h5>
                                                        <p class="mb-0 text-muted">Total Doctors</p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                
                            </div>
                                                                           
                        </div><!-- container -->


                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                

<?php
 include "footer.php";
?>