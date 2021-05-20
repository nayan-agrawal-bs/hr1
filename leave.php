<?php

session_start();


if (!isset($_SESSION["loggedin"]) && !($_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
 }
 
include('conn.php');

$error='';

$uid = $_SESSION['uid'];


$type = $_POST['type'];
$status = 'pending';
$date=$_POST['date'];
$mentor = $_SESSION['mentor'];
$checkin='Checkin';
$checkout='Checkout';

if (isset($_POST['submit'])) {

    $result = $conn->query("SELECT rId FROM request WHERE date='{$date}' and uid={$uid}");


    if ($result->num_rows != 1) {

        try {


            $conn->begin_transaction();

            $insert = $conn->query("INSERT INTO request ( uid , mentorId , type , date , time , status ) 
        VALUES ({$uid},{$mentor},'{$type}','{$date}',TIME(NOW()),'{$status}')");





            $conn->commit();
        } catch (\Throwable $e) {

            $conn->rollback();
            throw $e;
        }
    } else {
        $error='query not running';
    }
} else {
    $error='isset error';
}


?>














<?php include('head.php'); ?>

<!-- Vertical navbar -->
<?php include('navbar.php'); ?>
<!-- End vertical navbar -->


<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>




    <div class="container rounded bg-white mt-5 mb-5">
        <div>
            <!-- Apply Leave Form -->
            <div class="card pmd-card ">
                <form id="apply-leave" method="post" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label ">
                                    <label for="type">Type</label>
                                    <select name="type" id="leave-type" class="form-control" title="Please select a Leave Type" required>
                                        <option></option>
                                        <option value='Personal'>Personal</option>
                                        <option value='EW'>Extraworking</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label" for="datepickerstart">Date</label>
                                    <input type="date" class="form-control" id="datepickerstart" name="date" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label" for="datepickerend">End Date</label>
                                    <input type="date" class="form-control" id="datepickerend" name="datepickerend">
                                </div>
                            </div> -->


                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary pmd-ripple-effect pmd-btn-raised" 
                        name="submit" value="Apply"><a href="leave.php" class="btn btn-outline-secondary pmd-ripple-effect">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    </body>

    </html>