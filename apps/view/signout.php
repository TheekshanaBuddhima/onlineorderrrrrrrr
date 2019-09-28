<?php
//To handing errors
error_reporting(E_WARNING || E_ALL);
include '../controller/controller.php';
$ob=new controllerLogout();
$ob->getOut();




?>
<html>
    <head>
        <title>Logout - Online Order</title>
        <link rel="stylesheet" href="../resources/css/layout.css" />
        <link rel="stylesheet" 
              href="../resources/bootstrap/css/bootstrap.min.css" />
        
    </head>
    <body>
        <div id="main">
            <div id="header">
               <?php include '../common/header.php'; ?>
            </div>
            <div id="navi">&nbsp;</div>
            <div id="content">
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <h3 class="text-success" align="center">
                            User has successfully logout</h3>  
                        <p align="center">Page will be redirected to the 
                            <a href="login.php">login page </a>
                            within 3 seconds,if not please click the login</p>
                                               
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                </div> 
                             
            </div>
            <div id="footer">
                <?php include '../common/footer.php'; ?>
            </div>          
        </div>
    </body>   
    <script src="../resources/JQuery/jquery-3.2.1.min.js"></script>
    <script>
    $(document).ready(function(){
           $('#form1').submit(function(){
               var email=$('#email').val();
               var pwd=$('#pwd').val();               
               if(email=="" && pwd==""){
                   $('#err').text("Email and Password are empty");
                   $('#err').css('color','red'); 
                   $('#email').focus();
                   return false;
               }else if(email=="" && pwd!=""){
                   $('#err').text("Email is empty");
                   $('#err').css('color','red');
                   $('#email').focus();
                   return false;
               }else if(email!="" && pwd==""){
                   $('#err').text("Password is empty");
                   $('#err').css('color','red');
                   $('#pwd').focus();
                   return false;
               }               
           });    
           
           
           
    });
    
    function reMsg(){
        $('#err').text("");
    }
    
    </script>
</html>

