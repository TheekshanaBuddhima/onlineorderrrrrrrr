<?php
if(!isset($_SESSION)){
    session_start();
 }
 

$uname=$_POST['uname'];
$pass=sha1($_POST['pass']);

if(isset($_GET['order_id'])){
    
    $order_id=$_GET['order_id'];
    
}
 
 include 'dbconnection.php';
 
 $sqls="SELECT * FROM customer WHERE cus_email='$uname' AND cus_pass='$pass'";
 $results=$con->query($sqls);
 echo $nos=$results->num_rows;
 
 if($nos==0){
     header("Location:index.php");
     
 }else{
     
     $rows=$results->fetch_assoc();
     $_SESSION['cus_id']=$rows['cus_id'];
     $_SESSION['cus_info']=$rows;
     header("Location:checkout.php?order_id=$order_id");
     
     
     
 }
 

 

 
 
 
 


 
 
 
 
 
 
 
 
 
 
 