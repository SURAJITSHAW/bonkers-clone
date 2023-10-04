<?php
session_start();
date_default_timezone_set("Asia/Calcutta");

$conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

$add_id=$_POST['add_id'];
$paymentid=$_POST['payment_id'];
$userid=$_POST['user_id'];
$amount=$_POST['total_paid'];
$p_ids=$_POST['p_ids'];
$p_idsString = implode(', ', $p_ids);
$qnt=$_POST['qnt'];
$qntString = implode(', ', $qnt);
$dt=date('Y-m-d h:i:s');

$sql= "insert into orders (user_id, add_id,  p_ids, quantities, payment_id,amount,added_date) values ('".$userid. "','" . $add_id . "','" . $p_idsString . "','" . $qntString . "','".$paymentid. "','" . $amount . "','".$dt."')";

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