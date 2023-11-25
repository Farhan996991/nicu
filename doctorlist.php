<?php
 include "header.php";
 require "dbconfig.php";
 $stmt = $conn->prepare("SELECT * FROM doctor");
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
                                                
                                                <li class="breadcrumb-item active">Doctor List</li>
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
            
                                            <h4 class="mt-0 header-title">List of Doctors</h4>
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>

                                                    <th>Doctor Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Address</th>
                                                    
                                                    <th>Update</th>
                                                    <!-- <th>Delete</th> -->


                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                <?php   
                                                    while($row=$stmt->fetch())
                                                    {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['doctorname'] ?></td>
                                                    <td><?php echo $row['doctorphone'] ?></td>
                                                    <td><?php echo $row['doctoraddress'] ?></td>
                                                    
                                                   <td>
                                                        <a href="updatedoctor.php?id=<?php echo $row ['id'];?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit Doctor Record"><i class="mdi mdi-table-edit"></i></button></a>
                                                    </td>
                                                   <!--  <td>
                                                        <a href="doctorlist.php?id=<?php echo $row['id']; ?>"><button name="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Edit Doctor Record"><i class="mdi mdi-delete"></i></button></a>
                                                    </td> -->

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
        $stmt2=$conn->prepare('DELETE FROM doctor WHERE id=:id');
        $stmt2->bindParam(':id',$id);
        if($stmt2->execute())
        {
            ?>
            <script> alert("Doctor Deleted");
            window.location.href="doctorlist.php";



        </script>
            <?php 

        }

    }


?>

               <?php
 include "footer.php";
?>