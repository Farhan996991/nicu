<?php
 include "header.php";
 require "dbconfig.php";
 $stmt = $conn->prepare("SELECT fees.admissionfee, fees.id, fees.dateoe, fees.doctorfee, fees.doctorid, patient.patientname, doctor.doctorname
FROM fees
JOIN patient ON patient.id = fees.patientid
JOIN doctor ON fees.doctorid = doctor.id
ORDER BY fees.dateoe ASC;
");
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
                                                
                                                <li class="breadcrumb-item active">Patients Fee Record</li>
                                            </ol>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->

                           
            
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Patient Fee Record</h4>
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Admission Fee (Rs/-)</th>
                                                    <th>Doctor Fee(Rs/-)</th>
                                                    <th>Doctor Name</th>
                                                    <th>Date</th>
                                                    
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                <?php   
                                                    while($row=$stmt->fetch())
                                                    {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['patientname'] ?></td>
                                                    <td><?php echo $row['admissionfee'] ?></td>
                                                    <td><?php echo $row['doctorfee'] ?></td>
                                                    <td><?php echo $row['doctorname'] ?></td>
                                                    <td><?php echo $row['dateoe'] ?></td>
                                                    

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
 include "footer.php";
?>