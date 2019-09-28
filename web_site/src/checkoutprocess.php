<?php
if(!isset($_SESSION)){
    session_start();
 }
 
include 'dbconnection.php';

$order_id=$_SESSION['order_id'];
$cus_id=$_SESSION['cus_id'];
$total=$_SESSION['total'];

$sqlpay="INSERT INTO payment VALUES('','$total','$order_id','$cus_id',"
        . "now(),'Paid')";
$resultpay=$con->query($sqlpay);

$sqlor="UPDATE orders SET cus_id='$cus_id', order_status='Success' "
        . "WHERE order_id='$order_id'";
$resultor=$con->query($sqlor);

 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    $_SESSION['s_id']=time()+"_".$ip;

header("Location:invoice.php?order_id=$order_id");
 
 
 
 


 
 
 
 
 
 
 
 
 
 
 