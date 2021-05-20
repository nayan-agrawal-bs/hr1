<?php

include('conn.php');
$array=$_POST['array'];
$qw=explode(",",$array);



$error='';
foreach($qw as $a){
    $result = $conn->query("SELECT * FROM request WHERE rId={$a} and status='pending'");
    
  
    if ($result->num_rows == 1) {
       
        $row = $result->fetch_assoc();
        $atten = $conn->query("SELECT aId FROM attendance WHERE uID={$row['uid']}   and date='{$row['date']}'");
        if($atten->num_rows!=1){
        if($row['type']=='Checkin'){
            
            $result1 = $conn->query("SELECT time FROM request WHERE type='Checkout' and status='Accepted' and date='{$row['date']}' and uid={$row['uid']}");
            if ($result1->num_rows == 1){
                $row2 = $result1->fetch_assoc();
                $date1 = strtotime($row['time']); 
                $date2 = strtotime($row2['time']); 
                $diff = abs($date2 - $date1);
                if($diff>28800){
                    try {
                        $conn->begin_transaction();
                        $insert=$conn->query("INSERT INTO attendance(uID,date,status) 
                        VALUES ({$row['uid']},'{$row['date']}','Present')");
                        $alter = $conn->query("UPDATE request SET status='Accepted' WHERE rId={$a}");
                        $conn->commit();
                    } catch (\Throwable $e) {
                        $conn->rollback();
                        throw $e;
                    }
                }else{
                    try {
                        $conn->begin_transaction();
                        $insert=$conn->query("INSERT INTO attendance(uID,date,status) 
                        VALUES ({$row['uid']},'{$row['date']}','Absent')");
                        $alter = $conn->query("UPDATE request SET status='Accepted' WHERE rId={$a}");
                        $conn->commit();
                    } catch (\Throwable $e) {
                        $conn->rollback();
                        throw $e;
                    }
                }
            }else{
                $error='1';
                echo '1';
                //echo $error;
            }
        }elseif($row['type']=='Checkout'){
            $result1 = $conn->query("SELECT time FROM request WHERE type='Checkin' status='Accepted' and date='{$row['date']}' and uid={$row['uid']}");
            if ($result1->num_rows == 1){
                $row2 = $result1->fetch_assoc();
                $date1 = strtotime($row2['time']); 
                $date2 = strtotime($row['time']); 
                $diff = abs($date2 - $date1);
                if($diff>28800){
                    try {
                        $conn->begin_transaction();
                        $insert=$conn->query("INSERT INTO attendance(uID,date,status) 
                        VALUES ({$row['uid']},'{$row['date']}','Present')");
                        $alter = $conn->query("UPDATE request SET status='Accepted' WHERE rId={$a}");
                        $conn->commit();
                    } catch (\Throwable $e) {
                        $conn->rollback();
                        throw $e;
                    }
                }else{
                    try {
                        $conn->begin_transaction();
                        $insert=$conn->query("INSERT INTO attendance(uID,date,status) 
                        VALUES ({$row['uid']},'{$row['date']}','Absent')");
                        $conn->commit();
                    } catch (\Throwable $e) {
                        $conn->rollback();
                        throw $e;
                    }
                }
            }else{
                $error='1';
                echo '1';
                //echo $error;
            }
        }else{
            
            try {
                $conn->begin_transaction();
                $insert=$conn->query("INSERT INTO attendance(uID,date,status) 
                VALUES ({$row['uid']},'{$row['date']}','Present')");
                $alter = $conn->query("UPDATE request SET status='Accepted' WHERE rId={$a}");
                $conn->commit();
            } catch (\Throwable $e) {
                $conn->rollback();
                throw $e;
            }
        }
    }
    }else{
        $error='2';
        echo "2";
    }
}


?>
 