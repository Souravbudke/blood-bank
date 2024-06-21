<?php
session_start();
$_SESSION["tab"] = "New Donation";

if($_SESSION["login"] != 1)
    echo '<h2 txtcolor="red">Authentication Error!</h2>';
else{
    include_once('header.php'); 
    $pid = $_POST['pid'];  
    $units = $_POST['units']; 
    date_default_timezone_set("Asia/Calcutta"); 
    $date = date('y-m-d');
    $time = date('h:i');

   
    if($units < 300 || $units > 500) {
        echo "Error: Donation quantity must be between 300 and 500 units.";
        include_once('footer.php');
        exit(); 
    }

    $sql_1 = "insert into Donation (p_id, d_date, d_time, d_quantity) values('$pid', '$date', '$time', '$units')";  
    $sql_2 = "update  Stock SET s_quantity = s_quantity + '$units' where Stock.s_blood_group = (select p_blood_group FROM Person where p_id = '$pid')";

    if (($con->query($sql_1) === TRUE) and ($con->query($sql_2) === TRUE)) {

        echo 'Your donation is successful!';

    }
    else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    include_once('footer.php');
}
?>
