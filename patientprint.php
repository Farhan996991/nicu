<?php
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

$stmt3 = $conn->prepare("SELECT * FROM fees WHERE patientid = :id");
$stmt3->bindParam(':id', $id);
$stmt3->execute();


?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Patient Invoice</title>
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
<body>
<div class="wrapper">
        <div class="container-fluid">
        	<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            <h6>Hospital Copy</h6>
            <hr>
            <h4>Al-Qadeer Hospital</h4>
            <h6>Dr. Sher Muhammad Road, Quetta</h6>
            <h5>NICU/ICU</h5>
            <hr>
            <div class="row">
            	<div class="col-md-4">
            		<h5>Registration # <?php echo $row["regno"]; ?></h5>
            	</div>
            	<div class="col-md-4">
            <h5>Patient's Invoice</h5>
            		
            	</div>
            	<div class="col-md-4">
            		
<?php
$currentTime = date('Y-m-d H:i:s');
?>
            	
            <h5>PrintDate:<?php echo $currentTime; ?></h5>
            		
            	</div>
</div>
            <hr>



        </div>
    </div>
</div>

           
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       
                        <p>Name:<b><?php echo $row["patientname"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">                        <p>Age(In Days):<b><?php echo $row["patientage"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <p>Gender:<b><?php echo $row["gender"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <p>Weight:<b><?php echo $row["weight"]; ?> KG</b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        
                        <p>DOB:<b><?php echo $row["dob"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <p>Date of Admission:<b><?php echo $row["doa"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       
                        <p>Time of Admission:<b><?php echo $row["toa"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <p>Date of Discharge: <b><?php echo $row["dod"]; ?></b></p>
                          </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <p>Time of Discharge: <b><?php echo $row["tod"]; ?></b></p>
                        
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <p>Phone Number: <b><?php echo $row["patientphone"]; ?></b></p>
                      
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <p>CNIC: <b><?php echo $row["cnic"]; ?></b></p>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <p>Doctor Name: <b><?php echo $row["doctorname"]; ?></b></p>

                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p>Diagnosis: <b><?php echo $row["diagnosis"]; ?></b></p>
                        
                    </div>
                </div>
                <div class="col-md-6">    
                    <div class="form-group">
                        
                        <p>Address: <b><?php echo $row["address"]; ?></b></p>
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
                                            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    
                                                    
                                                    <th>Admission Fee (Rs/-)</th>
                                                    <th>Doctor Fee(Rs/-)</th>
                                                    <th>Grand Total(Rs/-)</th>
                                                    
                                                    
                                                    
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                <?php   
                                                 $totalAdmissionFee = 0; 
                                                 $totalDoctorfee = 0;
                                                 $grandTotal=0;
                                                    while($row2=$stmt2->fetch())
                                                    {
                                                         $totalAdmissionFee += $row2['admissionfee'];
                                                         $totalDoctorfee += $row2['doctorfee']; 
                                                ?>
                                               
                                                  
                                                   
                                                    
                                                
                                                
                                                <?php } ?>
                                                <tr>
                                                 <td><p> Rs <b><?php echo $totalAdmissionFee; ?>/-</b></p></td>
                                                <td><p> Rs <b><?php echo $totalDoctorfee; ?>/-</b></p></td>
                                                <?php $grandtotal=$totalAdmissionFee+$totalDoctorfee; ?>
                                                <td><p> Rs <b><?php echo $grandtotal; ?>/-</b></p></td>
                                            </tr>   

                                               

                                                
                                                </tr>

                                                </tbody>
                                            </table>
                                            
<b>Note:- Refund requests, in the event of a patient's demise, are eligible for consideration if submitted within three hours of the said occurrence; requests made after this timeframe will not be honored.</b>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
    </div>          
</div>

<div class="wrapper">
        <div class="container-fluid">
        	<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            <h6>Patient Copy</h6>
            <hr>
            <h4>Al-Qadeer Hospital</h4>
            <h6>Dr. Sher Muhammad Road, Quetta</h6>
            <h5>NICU/ICU</h5>
            <hr>
            <div class="row">
            	<div class="col-md-4">
            		<h5>Registration # <?php echo $row["regno"]; ?></h5>
            	</div>
            	<div class="col-md-4">
            <h5>Patient's Invoice</h5>
            		
            	</div>
            	<div class="col-md-4">
            		
<?php
$currentTime = date('Y-m-d H:i:s');
?>
            	
            <h5> PrintDate:<?php echo $currentTime; ?></h5>
            		
            	</div>
</div>
            <hr>



        </div>
    </div>
</div>

            
             <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       
                        <p>Name:<b><?php echo $row["patientname"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">                        <p>Age(In Days):<b><?php echo $row["patientage"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <p>Gender:<b><?php echo $row["gender"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <p>Weight:<b><?php echo $row["weight"]; ?> KG</b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        
                        <p>DOB:<b><?php echo $row["dob"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <p>Date of Admission:<b><?php echo $row["doa"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       
                        <p>Time of Admission:<b><?php echo $row["toa"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <p>Date of Discharge: <b><?php echo $row["dod"]; ?></b></p>
                          </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <p>Time of Discharge: <b><?php echo $row["tod"]; ?></b></p>
                        
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <p>Phone Number: <b><?php echo $row["patientphone"]; ?></b></p>
                      
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group">
                        <p>CNIC: <b><?php echo $row["cnic"]; ?></b></p>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                         <p>Doctor Name: <b><?php echo $row["doctorname"]; ?></b></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       
                        <p>Diagnosis: <b><?php echo $row["diagnosis"]; ?></b></p>
                    </div>
                </div>
                <div class="col-md-6">    
                    <div class="form-group">
                        <p>Address: <b><?php echo $row["address"]; ?></b></p>
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
                                           <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    
                                                    
                                                    <th>Admission Fee (Rs/-)</th>
                                                    <th>Doctor Fee(Rs/-)</th>
                                                    <th>Grand Total(Rs/-)</th>
                                                    
                                                    
                                                    
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                <?php   
                                                 $totalAdmissionFee1 = 0; 
                                                 $totalDoctorfee1 = 0;
                                                 $grandTotal1=0;
                                                    while($row3=$stmt3->fetch())
                                                    {
                                                         $totalAdmissionFee1 += $row3['admissionfee'];
                                                         $totalDoctorfee1 += $row3['doctorfee']; 
                                                ?>
                                               
                                                  
                                                   
                                                    
                                                
                                                
                                                <?php } ?>
                                                <tr>
                                                 <td><p> Rs <b><?php echo $totalAdmissionFee1; ?>/-</b></p></td>
                                                <td><p> Rs <b><?php echo $totalDoctorfee1; ?>/-</b></p></td>
                                                <?php $grandtotal1=$totalAdmissionFee1+$totalDoctorfee1; ?>
                                                <td><p> Rs <b><?php echo $grandtotal1; ?>/-</b></p></td>
                                            </tr>   

                                               

                                                
                                                </tr>

                                                </tbody>
                                            </table>
                                            <b>Note:- Refund requests, in the event of a patient's demise, are eligible for consideration if submitted within three hours of the said occurrence; requests made after this timeframe will not be honored.</b>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
    </div>          
</div>

<h6>Verified By ____________</h6>

<script> window.print();</script>
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

</html>

