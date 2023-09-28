<?php
session_start();
date_default_timezone_set("Asia/Calcutta");

$conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

$paymentid=$_POST['payment_id'];
$userid=$_POST['user_id'];
$dt=date('Y-m-d h:i:s');

$sql="insert into orders (user_id,payment_id,added_date) values ('".$userid."','".$paymentid."','".$dt."')";

$result=mysqli_query($conn,$sql);

if($result)
{
	echo 'done';
	$_SESSION['paymentid']=$paymentid;
}
else 
{
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>