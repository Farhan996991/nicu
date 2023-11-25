<?php
include 'header.php';
include 'dbconfig.php';
$id = $_GET['id'];
$stmt=$conn->prepare("SELECT patient.*, doctor.doctorname
                      FROM patient
                      LEFT JOIN doctor ON patient.doctorid = doctor.id
                      WHERE patient.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$row = $stmt->fetch();

$stmt2 = $conn->prepare("SELECT * FROM fees WHERE patientid = :id");
$stmt2->bindParam(':id', $id);
$stmt2->execute();


?>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
            <h2 class="mt-5 mb-3">Registration # <?php echo $row["regno"]; ?></h2>
            </div>
            <div class="col-md-6">
                  <a href="patientprint.php?id=<?php echo $row ['id'];?>"><button class="btn btn-info mt-5 mb-3" data-toggle="tooltip" data-placement="top" title="Print Invoice" style="float:right;"><i class="mdi mdi-printer"></i></button></a>
            </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["patientname"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <label>Age</label>
                        <p><b><?php echo $row["patientage"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["gender"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Weight</label>
                        <p><b><?php echo $row["weight"]; ?> KG</b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <p><b><?php echo $row["dob"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date of Admission</label>
                        <p><b><?php echo $row["doa"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Time of Admission</label>
                        <p><b><?php echo $row["toa"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <label>Date of Discharge</label>
                        <p><b><?php echo $row["dod"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Time of Discharge</label>
                        <p><b><?php echo $row["tod"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <p><b><?php echo $row["patientphone"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <label>CNIC</label>
                        <p><b><?php echo $row["cnic"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor Name</label>
                        <p><b><?php echo $row["doctorname"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-6">    
                    <div class="form-group">
                        <label>Diagnosis</label>
                        <p><b><?php echo $row["diagnosis"]; ?></b></p>
                    </div>
                </div> 
            </div>
            

    </div>  
    <div class="container-fluid">
        <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Patient Fee Record</h4>
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                <th>Date</th>
                                                    <th>Admission Fee (Rs/-)</th>
                                                    <th>Doctor Fee(Rs/-)</th>
                                                    
                                                    
                                                    
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                <?php   
                                                    while($row2=$stmt2->fetch())
                                                    {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row2['id'] ?></td>
                                                    <td><?php echo $row2['dateoe'] ?></td>
                                                
                                                    <td><?php echo $row2['admissionfee'] ?></td>
                                                    <td><?php echo $row2['doctorfee'] ?></td>
                                                   
                                                    
                                                
                                                </tr>
                                                <?php } ?>
                                                </tr>
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
    </div>          
</div>

<?php
 include "footer.php";
?>


