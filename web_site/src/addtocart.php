<?php
if(!isset($_SESSION)){
    session_start();
 }
 
$p_id=$_GET['p_id'];
 $size_id=$_POST['size'];
$qua=$_POST['qua'];
 $s_id=$_SESSION['s_id'];
 
 include 'dbconnection.php';
 
 $sqls="SELECT * FROM orders WHERE session_id='$s_id'";
 $results=$con->query($sqls);
 $nos=$results->num_rows;
 
 if($nos==0){
     $sql="INSERT INTO `orders` VALUES('',now(),'','$s_id','','Pending')";
     $result=$con->query($sql);
     $order_id=$con->insert_id;
     
 }else{
     $rows=$results->fetch_assoc();
     $order_id=$rows['order_id'];
     
 }
 
 $sqlcat="INSERT INTO cart VALUES('','$order_id','$p_id','$qua','$size_id')";
 $resultcat=$con->query($sqlcat);
 
 $sqlb="SELECT * FROM stock_balance WHERE p_id='$p_id' AND size_id='$size_id'";
 $resultb=$con->query($sqlb);
 $rowb=$resultb->fetch_assoc();
 $cbalance=$rowb['balance'];
 $balance=$cbalance-$qua; 
 
 $sqlbup="UPDATE stock_balance SET balance='$balance'"
         . "WHERE p_id='$p_id' AND size_id='$size_id'";
  $resultbup=$con->query($sqlbup);
 
 header("Location:viewcart.php");
 
 
 
 


 
 
 
 
 
 
 
 
 
 
 