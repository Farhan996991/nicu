<?php
 include "header.php";
 require "dbconfig.php";
 $stmt = $conn->prepare("SELECT patient.*, doctor.doctorname
    FROM patient
    JOIN doctor ON patient.doctorid = doctor.id
    ORDER BY patient.dateofentry DESC;");
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
                                                
                                                <li class="breadcrumb-item active">Patient List</li>
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
            
                                            <h4 class="mt-0 header-title">List of Patients</h4>
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Reg Number</th>
                                                    <th>Patient Name</th>
                                                    
                                                    
                                                    <th>Date of Birth</th>
                                                    <th>Date of Admission</th>
                                                    
                                                    <th>Doctor Name</th>
                                                    
                                                    <th>Actions</th>
                                                    <th>Status</th>
                                                    <!--<th>Delete</th> -->


                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                 <?php   
                                                    while($row=$stmt->fetch())
                                                    {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['regno'] ?></td>
                                                    <td><?php echo $row['patientname'] ?></td>
                                                    
                                                    
                                                    <td><?php echo $row['dob'] ?></td>
                                                    <td><?php echo $row['doa'] ?></td>
                                                    
                                                    <td><?php echo $row['doctorname'] ?></td>
                                                  
                                                    <?php
                                                    if ($row['dischargestatus']=="1" && !empty($row['dod'])) {
                                                        ?>
                                                        <td>
                                                        <a href="patientdetail.php?id=<?php echo $row ['id'];?>"><button class="btn btn-info"><i class="mdi mdi-information" data-toggle="tooltip" data-placement="top" title="Patient Details"></i></button></a>
                                                    </td>
                                                    <?php    
                                                    }
                                                    elseif ($row['dischargestatus']=="0" && empty($row['dod'])) {
                                                        ?>
                                                        <td>
                                                        <a href="patientdetail.php?id=<?php echo $row ['id'];?>"><button class="btn btn-info"><i class="mdi mdi-information" data-toggle="tooltip" data-placement="top" title="Patient Details"></i></button></a>

                                                        <a href="updatepatient.php?id=<?php echo $row ['id'];?>"><button class="btn btn-success"data-toggle="tooltip" data-placement="top" title="Edit Patient Details"><i class="mdi mdi-table-edit"></i></button></a>

                                                        <a href="singlepatientfee.php?id=<?php echo $row ['id'];?>"><button class="btn btn-warning"><i class="mdi mdi-cash-usd" data-toggle="tooltip" data-placement="top" title="Add Patient Fee"></i></button></a>

                                                         <!-- <a href="patientslist.php?id=<?php echo $row['id']; ?>"><button name="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Patient Record"><i class="mdi mdi-delete"></i></button></a> -->
                                                    </td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($row['dischargestatus']=="0" && empty($row['dod'])) {
                                                         ?>
                                                         <td>
                                                            <div style="border-radius:20px; background-color: green; color: white; text-align: center;">
                                                                Admitted
                                                            </div>
                                                        
                                                    </td>
                                                         <?php
                                                     } 
                                                    
                                                elseif ($row['dischargestatus']=="1" && !empty($row['dod'])) {
                                                      
                                                         ?>
                                                         <td>
                                                        <div style="border-radius:20px; background-color: red; color: white; text-align: center;">
                                                                Discharged
                                                            </div>
                                                    </td>
                                                         <?php
                                                     } 
                                                    ?>
                                                    
                                                     
                                                    
                                                    
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
        $stmt2=$conn->prepare('DELETE FROM patient WHERE id=:id');
        $stmt2->bindParam(':id',$id);
        if($stmt2->execute())
        {
        ?>
        <script> alert("Patient Deleted");
            window.location.href="patientslist.php";
        </script>
            <?php 
        }
    }
?>

<?php
 include "footer.php";
?>