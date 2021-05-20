<?php

use PhpMyAdmin\Scripts;

session_start();

if (!isset($_SESSION["loggedin"]) && !($_SESSION["loggedin"] === true)) {
   header("location: login.php");
   exit;
}

include('conn.php');
//password=asdfadfa

$uid = $_SESSION['uid'];

$result1 = $conn->query("SELECT name,email,number,Address,role,mentor,gender,password  FROM user WHERE uId={$uid}");



if ($result1->num_rows == 1) {
    $row = $result1->fetch_assoc();
} else {
    echo "error";
}




?>



<?php include('head.php');?>
 
<!-- Vertical navbar -->
<?php include('navbar.php');?>
<!-- End vertical navbar -->


    <!-- Page content holder -->
    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>


        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">

                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label>
                                <p><?php echo $row['name'] ?></p>
                            </div>

                            <div class="col-md-6"><label class="labels">Email</label>
                                <p><?php echo $row['email'] ?></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Phone Number</label>
                                <p><?php echo $row['number'] ?></p>
                            </div>

                            <div class="col-md-12"><label class="labels">Address</label>
                                <p><?php echo $row['Address'] ?></p>
                            </div>
                            


                        </div><br>
                        <div>
                            <div class="col-md-12"><label class="labels">Gender</label>
                                <p><?php echo $row['gender'] ?></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="col-md-12">

                            <label class="labels">Role</label>
                            <p><?php echo $row['role'] ?></p>
                        </div><br>

                        <div class="col-md-12">
                            <label class="labels">Mentor</label>
                            <p><?php echo $row['mentor'] ?></p>
                        </div> <br>


                        <!-- <div class="mt-5 text-center"> <input type="submit" name="sign-up" value="sign-up" class="btn btn-primary profile-button">
                                    </div> -->


                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- End demo content -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>