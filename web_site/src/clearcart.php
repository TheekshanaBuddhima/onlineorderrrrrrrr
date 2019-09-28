<?php
if(!isset($_SESSION)){
    session_start();
 }
 
include 'dbconnection.php';

$order_id=$_GET['order_id'];
$id=$_GET['id'];

if($id==0){

$sql="DELETE FROM cart WHERE order_id='$order_id'";

$result=$con->query($sql);
header("Location:index.php?order_id=$order_id");
}else{
    $p_id=$_GET['p_id'];
  $sql="DELETE FROM cart WHERE order_id='$order_id' AND p_id='$p_id'"; 
  
$result=$con->query($sql);
header("Location:viewcart.php?order_id=$order_id");
}





//

