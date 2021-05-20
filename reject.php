<?php

include('conn.php');
$array=$_POST['array'];
$qw=explode(",",$array);



$error='';
foreach($qw as $a){
    $result = $conn->query("SELECT * FROM request WHERE rId={$a} and status='pending'");
    
  
    if ($result->num_rows == 1) {
       
        $row = $result->fetch_assoc();
        $atten = $conn->query("SELECT aId FROM attendance WHERE uID={$row['uid']} and date='{$row['date']}'");
        if($atten->num_rows!=1){
      
            try {
                $conn->begin_transaction();
                $insert=$conn->query("INSERT INTO attendance(uID,date,status) 
                VALUES ({$row['uid']},'{$row['date']}','Absent')");
                $alter = $conn->query("UPDATE request SET status='Rejected' WHERE rId={$a}");
                $conn->commit();
            } catch (\Throwable $e) {
                $conn->rollback();
                throw $e;
            }
        }
    
    }else{
        $error='2';
        echo "2";
    }
}
?>