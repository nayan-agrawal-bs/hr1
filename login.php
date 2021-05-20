<?php

//session_destroy();
//session_start();

// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//    header("location: profile.php");
//    exit;
// }

// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 180)) {
//    // last request was more than 30 minutes ago
//    session_unset();     // unset $_SESSION variable for the run-time 
//    session_destroy();   // destroy session data in storage
// }
//  

include('conn.php');

$uid = $pass = '';
$uid_err = $pass_err = $login_err = '';

if (isset($_POST['submit'])) {

   //echo '<script>alert("1");</script>';

   if (empty($_POST["uid"])) {
      //echo '<script>alert("pst2")</script>';
      $uid_err = "Please enter username.";
   } else {

      $uid = trim($_POST["uid"]);
   }
   if (empty($_POST["pass"])) {

      $pass_err = "Please enter your password.";
      //echo '<script>alert("pst1")</script>';
   } else {

      $pass = $_POST["pass"];
      $pass=md5($pass);
   }
   //echo '<script>alert("1");</script>';
   if (empty($uid_err) && empty($pass_err)) {
      
      $result = $conn->query("SELECT uId, mentor, password FROM user WHERE uId = {$uid} ");

      
      if ($result->num_rows == 1) {
         $row = $result->fetch_assoc();
           
        
         if ($pass == $row['password']) {
            
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['uid'] = $uid;
            $_SESSION['mentor']=$row['mentor'];
            $_SESSION['role']=$row['role'];
            $_SESSION['LAST_ACTIVITY'] = time();

            
            header("location: profile.php");
         } else {

            $login_err = "Invalid Uid or Password";
            echo '<script>alert("Invalid Uid or Password")</script>';
         }
      } else {

         $login_err = "Invalid Uid or Password";
         echo '<script>alert("Invalid Uid or Password")</script>';
         
      }
   }
}
?>



<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <title>Login</title>
</head>

<body>
   <div id="login">
      <h3 class="text-center text-white pt-5">Login form</h3>
      <div class="container">
         <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
               <div id="login-box" class="col-md-12">
                  <form id="login-form" class="form" action="" method="post">
                     <h3 class="text-center text-info">Login</h3>
                     <div class="form-group">
                        <label for="username" class="text-info">User-Id:</label><br>
                        <input type="text" name="uid" id="uid" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="password" class="text-info">Password:</label><br>
                        <input type="text" name="pass" id="password" class="form-control">
                     </div>
                     <div class="form-group">

                        <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   
</body>

</html>