<?php

session_start();
include('conn.php');

$uid = $_SESSION['uid'];


$type = 'Checkin';
$status = 'pending';

$mentor = $_SESSION['mentor'];

if (isset($_SESSION['uid']) && isset($_SESSION['mentor']) && $date1 != 'Sunday' && $date1 != 'Saturday') {

$result = $conn->query("SELECT rId FROM request WHERE type='Checkin' and date=DATE(NOW()) and uid={$uid}");


    if ($result->num_rows != 1) {

        try {


            $conn->begin_transaction();

            $insert = $conn->query("INSERT INTO request ( uid , mentorId , type , date , time , status ) 
        VALUES ({$uid},{$mentor},'{$type}',DATE(NOW()),TIME(NOW()),'{$status}')");



            if ($insert == TRUE) {
                echo '<script>console.log("67")</script>';
            } else {
                echo '<script>console.log("68")</script>';
            }


            $conn->commit();
        } catch (\Throwable $e) {

            $conn->rollback();
            throw $e;
        }
    } else {
        echo '5';
    }
} else {
    echo '<script>alert("session not set")</script>';
}
?>