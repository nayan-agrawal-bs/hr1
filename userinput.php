<?php

use PhpMyAdmin\Scripts;
session_start();



if (!isset($_SESSION["loggedin"]) && !($_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
 }







include('conn.php');
//password=asdfadfa
$uid1 = $_SESSION['uid'];

$userrole=$conn->query("SELECT role FROM user WHERE uID={$uid1}");
$ro=$userrole->fetch_assoc();

if($ro['role']!="Admin"){
    header('location: n.php');
}



$result1 = $conn->query("SELECT uId,name  FROM user WHERE role='Mentor'");
$mentors = $result1->fetch_all(MYSQLI_ASSOC);


$pass = $email = $name = $role = $gender = $mentor = $address = $number = '';

$errors = array(
    'email' => '', 'name' => '', 'num' => '',
    'password' => '',  'gender' => '', 'mentor' => '',
    'role' => '', 'address' => '',
);
if (isset($_POST['sign-up'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email";
        }
    }
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is required";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['address'])) {
        $errors['address'] = "Address is required";
    } else {
        $address = $_POST['address'];
    }
    if (empty($_POST['num'])) {
        $errors['num'] = "Number is required";
    } else {
        $number = $_POST['num'];
        if (preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/', $number)) {
            $errors['num'] = "Enter a valid number ";
        }
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required";
    } else {
        $pass = $_POST['password'];
        $pass = md5($pass);
    }
    if (empty($_POST['mentor'])) {
        $errors['mentor'] = "mentor is required";
    } else {
        $mentor = $_POST['mentor'];
    }
    if (empty($_POST['role'])) {
        $errors['role'] = "role is required";
    } else {
        $role = $_POST['role'];
    }
    if (empty($_POST['gender'])) {
        $errors['gender'] = "gender is required";
    } else {
        $gender = $_POST['gender'];
    }

    if (!array_filter($errors)) {

        try {
            $conn->begin_transaction();

            $insert = $conn->query("INSERT INTO user (name, email, number, Address, role, mentor, gender, password) 
        VALUES ('{$name}','{$email}',{$number},'{$address}','{$role}','{$mentor}','{$gender}','{$pass}')");


            $conn->commit();
        } catch (\Throwable $e) {

            $conn->rollback();
            throw $e;
        }
    } else {
        echo '<script>alert("fail")</script>';
    }
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

  
  
  <form action="" method="POST">
                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row">

                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile </h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Name</label>
                                            <input type="text" class="form-control" name='name' placeholder="first name" value="">
                                            <div style='color:red;'> <?php echo $errors['name'] ?></div>
                                        </div>

                                        <div class="col-md-6"><label class="labels">Email</label>
                                            <input type="text" class="form-control" value="" name='email' placeholder="E-Mail">
                                            <div style="color: red;"> <?php echo $errors['email'] ?></div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">PhoneNumber</label>
                                            <input type="number" class="form-control" name='num' placeholder="Phone number" value="">
                                            <div style="color: red;"> <?php echo $errors['num'] ?></div>
                                        </div>

                                        <div class="col-md-12"><label class="labels">Address</label>
                                            <input type="text" class="form-control" name='address' placeholder="Address" value="">
                                            <div style='color:red;'> <?php echo $errors['address'] ?></div>
                                        </div>
                                        <div class="col-md-12"><label class="labels">Password</label>
                                            <input type="text" class="form-control" name='password' placeholder="Password" value="">
                                            <div style="color:red;"> <?php echo $errors['password'] ?></div>
                                        </div>


                                    </div><br>
                                    <div> <select name="gender" class="custom-select" style="width:200px" id="Gender">
                                            <option value="">--Gender--</option>
                                            <Option value="Male">Male</Option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select> <br>
                                        <div class='red-text'> <?php echo $errors['gender'] ?></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 py-5">
                                    <div class="col-md-12">

                                        <select name="role" class="custom-select" style="width:200px" id="role">
                                            <option value="">--Select a role--</option>
                                            <option value="Mentor">Mentor</option>
                                            <option value="employ">Employ</option>
                                        </select><br>
                                        <div class='red-text'> <?php echo $errors['role'] ?></div>
                                    </div><br>

                                    <div class="col-md-12">
                                        <select name="mentor" class="custom-select" style="width:200px" id="Mentor">
                                            <option value="">--Select a Mentor--</option>
                                            <?php foreach ($mentors as $men) : ?>
                                                <option value=<?= $men['uId']; ?>><?= $men['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select><br>
                                        <div class='red-text'> <?php echo $errors['mentor'] ?></div>
                                    </div> <br>


                                    <div class="mt-5 text-center"> <input type="submit" name="sign-up" value="sign-up" class="btn btn-primary profile-button">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>

</div>
<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>

