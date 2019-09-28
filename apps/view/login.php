<?php
include '../controller/controller.php';

//To handing errors
error_reporting(E_WARNING || E_ALL);
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $pwd=sha1($_POST['pwd']); //One way encription 
    $obl=new controller();
    $obl->logincontroller($email, $pwd);
    
}
?>
<html>
    <head>
        <title>Login - Online Order</title>
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
                        <form method="post" action="" id="form1">
                            <div id="err">
                            <?php
                            if(isset($_REQUEST['err'])){
                                ?>
                            <div class="text text-danger">
                                <?php
                                //Decode message
                                echo base64_decode($_REQUEST['err']);
                                ?>
                            </div>
                            <?php
                            }
                            ?>
                            </div>
                            
                            <div>Email </div>
                            <div>
                                <input type="email" id="email" name="email"
                                       onKeyPress="reMsg()" class="form-control">
                            </div>
                            <div>Password </div>
                            <div>
                                <input type="password" id="pwd" name="pwd"
                                     onKeyPress="reMsg()"  class="form-control">
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div>
                                <button type="submit" name="login" 
                                        class="btn btn-primary">Login</button>
                            </div>
                        </form>                       
                                               
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

