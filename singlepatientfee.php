<?php
 include "header.php";
 require "dbconfig.php";
 $stmt2 = $conn->prepare("Select * FROM doctor");
 $stmt2 -> execute();
 


 $id=$_GET['id'];


?>

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">NICU</a></li>
                                                
                                                <li class="breadcrumb-item active">Patient Fee Details</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Add Patient Fee</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                
            
                                <div class="col-lg-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <form action="singlepatientfee.php" method="POST">
                                                <div class="row">
                                                      <input type="hidden" name="patientid" value="<?php
                                                        echo $id;
                                                  ?>">  
                                                  <input type="hidden" name="patientid" value="<?php
                                                        echo $id;
                                                  ?>">  
                                                  <input type="hidden" name="dateoe">    
                                                    <div class="col-lg-3">
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
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Admission Fee</label>
                                                              <div>
                                                                    <input name="admissionfee" type="number" class="form-control" required
                                                                         placeholder="Enter Doctor Fee"/>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Doctor Fee</label>
                                                              <div>
                                                                    <input name="doctorfee" type="number" class="form-control" required
                                                                         placeholder="Enter Doctor Fee"/>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            
                                                            <div style="padding-top: 30px;">
                                                                <button name="submit" type="submit" class="btn btn-primary waves-effect   waves-light" >
                                                                Add Fee
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                    
                                                
                                            </form>
            

                       <?php
if (isset($_POST['submit'])) {
    $patientid=$_POST['patientid'];
    $doctorid=$_POST['doctorid'];
    $doctorfee=$_POST['doctorfee'];
    $admissionfee=$_POST['admissionfee'];
    $dateoe=$_POST['dateoe'];
 $currentDateTime = date("Y-m-d H:i:s");

    $sql="INSERT INTO fees (patientid, doctorid, doctorfee, admissionfee, dateoe) VALUES (:patientid, :doctorid, :doctorfee, :admissionfee, :dateoe)";
    $query=$conn->prepare($sql);
    $query->bindParam(':patientid',$patientid);
    $query->bindParam(':doctorid',$doctorid);
    $query->bindParam(':doctorfee',$doctorfee);
    $query->bindParam(':admissionfee',$admissionfee);
    $query->bindParam(':dateoe',$currentDateTime);

if ($query->execute()) {
    ?>
    <script>
        alert("Patient Fee Added")
        window.location.href="patientfee.php";
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

               <?php
 include "footer.php";
?>