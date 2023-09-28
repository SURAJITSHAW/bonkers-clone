<?php
session_start();
date_default_timezone_set("Asia/Calcutta");

$conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

$paymentid=$_POST['payment_id'];
$userid=$_POST['user_id'];
$amount=$_POST['total_paid'];
$dt=date('Y-m-d h:i:s');

$sql="insert into orders (user_id,payment_id,amount,added_date) values ('".$userid."','".$paymentid. "','" . $amount . "','".$dt."')";

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