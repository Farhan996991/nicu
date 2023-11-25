                  <?php 

                  include "header.php";
                  require "dbconfig.php";

                   ?>

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">NICU</a></li>
                                                
                                                <li class="breadcrumb-item active">Add Doctor Details</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Add Doctor Details</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->

                            <div class="row">
                                
            
                                <div class="col-lg-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <form action="addDoctor.php" id="form" method="POST">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Doctor Name</label>
                                                                <div>
                                                                    <input name="doctorname"type="text" class="form-control" required placeholder="Enter Doctor Name"/>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                                <div>
                                                                    <input name="doctorphone" type="text" class="form-control" id="phoneNumber" required
                                                                         placeholder="Enter Phone Number"/>
                                                                         <span class="font-13 text-muted">(0000)0000000</span>
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
                                                               <textarea name="doctoraddress" id="textarea" class="form-control" maxlength="225" rows="2" placeholder="Enter your Address"></textarea>
                                                            </div>                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>    
                                                <div class="form-group m-b-0">
                                                    <div>
                                                        
                                                         <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>

                                                        
                                                        <button  type="reset" class="btn btn-secondary waves-effect m-l-5" >
                                                            <a style="color: white;" href="doctorlist.php">Cancel</a>
                                                            
                                                        </button>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </form>
            <?php
            
if (isset($_POST['submit'])) {
    $doctorname = "Dr. " . $_POST['doctorname'];
    $doctorphone=$_POST['doctorphone'];
    $doctoraddress=$_POST['doctoraddress'];

    $sql="INSERT INTO doctor (doctorname, doctorphone, doctoraddress) VALUES (:doctorname, :doctorphone, :doctoraddress)";
    $query=$conn->prepare($sql);
    $query->bindParam(':doctorname',$doctorname);
    $query->bindParam(':doctorphone',$doctorphone);
    $query->bindParam(':doctoraddress',$doctoraddress);
    $query->execute();

    echo "Doctor Added";

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
    const form = document.getElementById('form');
    const phoneNumber = document.getElementById('phoneNumber');

    form.addEventListener('submit', function (event) {
        const phoneNumberValue = phoneNumber.value;
        const phoneNumberPattern = /^\d+$/; // This regular expression checks for only digits

        if (phoneNumberValue.length !== 11 || !phoneNumberPattern.test(phoneNumberValue)) {
            alert('Phone Number must be 11 digits long and contain only numbers.');
            event.preventDefault(); // Prevent form submission
        }
    });

</script>

                <?php include "footer.php"; ?>