<?php
include '../common/dbconnection.php';
include '../model/login.php';

$obc=new dbconnection();
$con=$obc->connection();

$email=$_GET['q'];

$obl=new login();
$r=$obl->checkEmail($email, $con);
$n=$r->rowCount();

$patemail='/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/';

if(preg_match($patemail,$email)){
    if($n==0){
        $status="Valid Email";
        $a="text text-success";
    }else{
        $status="Exsiting Email";
        $a="text text-danger";
        echo"<input type='hidden' value='1' id='hid' />";
    }
}else{
        $status="Invalid Email";
        $a="text text-danger";
}

ECHO "<p class='".$a."'>".$status."</p>";
