<?php

if(isset($_POST['sub'])){
    
    //To get image details
    $image_name=$_FILES['user_image']['name'];
    $image_tmp=$_FILES['user_image']['tmp_name'];
    
    require '../controller/controller.php';
    $ob=new controller();
    $ob->addusercontroller($_POST, $image_name, $image_tmp); 
    
}
require '../common/session_handling.php';
include '../common/dbconnection.php';
include '../model/modulemodel.php';
include '../model/usermodel.php';
include '../model/rolemodel.php';
//Database connection
$ob = new dbconnection();
$con = $ob->connection();
//User's role_id
$role_id = $userinfo['role_id'];
$user_id = $userinfo['user_id'];
//To get modules based on role_id
$obm = new modulemodel();
$resultm = $obm->getUserModules($role_id, $con);
//To get role
$obr = new rolemodel();
$resultr = $obr->getAllRole($con);

$max=date('Y-m-d', strtotime(' -18 year'));
$min=date('Y-m-d', strtotime(' -55 year'));

?>

<html>
    <head>
        <title>Online Order</title>
        <link rel="stylesheet" href="../resources/css/layout.css" />
        <link rel="stylesheet" 
              href="../resources/bootstrap/css/bootstrap.min.css" />

    </head>
    <body>
        <div id="main">
            <div id="header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="hea1 pad2">0nline Ordering System</div>
                    </div>
                    <div class="col-md-6">
                        <div class="prof">
<?php echo $userinfo['user_fname'] . " " . $userinfo['user_lname'] . " | " . $userinfo['role_name'] ?> 
                            | <a class="signout" href="../view/signout.php">SignOut</a>

                        </div>
                    </div>
                </div>
            </div>           
            <div id="content">       
                <div class="row">
                    <div class="col-md-2">
                        <div class="pad1">
                            <ul class="list1">
<?php
while ($rowm = $resultm->fetch(PDO::FETCH_BOTH)) {
    //Convert into lowercase
    $lm_name = strtolower($rowm['m_name']);
    $url = $lm_name . ".php";
    ?>
                                    <li>
                                        <a href="<?php echo $url; ?>">
    <?php echo $rowm['m_name']; ?>
                                        </a>
                                    </li>
<?php } ?>
                            </ul>
                        </div>


                    </div>
                    <div class="col-md-10">
                        <div class="pad1">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li>
                                    <a href="user.php" class="active">User</a>
                                </li>
                                <li>
                                    <a href="adduser.php" class="active">Add User</a>
                                </li>

                            </ul>                            
                        </div>

                        <div class="clearfix">&nbsp;</div>
                        <form action="adduser.php" 
                              method="post" 
                              enctype="multipart/form-data">
                              <div>
                                <!-- Start First Name -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big>    First Name </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="user_fname" 
                                               placeholder="First Name" 
                                               id="user_fname" 
                                               onkeypress="clearMsg('msg_fname')"

                                               class="form-control"/>
                                        <span id="msg_fname"
                                              class="text text-danger"></span>

                                    </div>
                                    <div class="col-md-2"><big class="text text-danger">*</big>&nbsp;</div>
                                </div>
                                <!-- End First Name -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Last Name -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big>    Last Name </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="user_lname" 
                                               placeholder="Last Name" 
                                               id="user_lname"

                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                </div>
                                <!-- End Last Name -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Email -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big>    Email </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="email" name="login_email" 
                                               placeholder="Email" 
                                               id="login_email"
                                               onkeyup="showEmail(this.value)"
                                               class="form-control"
                                               autocomplete="no"/>
                                        <span id="msg_email"></span>

                                    </div>
                                    <div class="col-md-2"><big class="text text-danger">*</big>&nbsp;</div>
                                </div>
                                <!-- End Email -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Last Name -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big>    Date of Birth </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" name="user_dob" 
                                               placeholder="DOB" 
                                               id="user_dob"
                                               min="<?php //echo $min; ?>"
                                               max="<?php //echo $max; ?>"

                                               class="form-control" onchange="clearMsg('msg_dob')"/>
                                        <span id="msg_dob"></span>
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                </div>
                                <!-- End DOB -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start NIC -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big>    NIC </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="TEXT" name="user_nic" 
                                               placeholder="NIC" 
                                               id="user_nic"
                                               onkeypress="clearMsg('msg_nic')"
                                               class="form-control"/>
                                        <span id="msg_nic"></span>
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                </div>
                                <!-- End NIC -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Telno -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big> Telephone No </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="user_tel" 
                                               placeholder="Telephone Number" 
                                               id="user_tel"
                                               class="form-control" onKeyPress="return onlyNos(event,this)" 
                                               onKeyUp="clearMsg('msg_tel')"/>
                                        <span id="msg_tel"></span>
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                </div>
                                <!-- End Telno -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Gender -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big>    Gender </big>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="user_gender"
                                                id="user_gender"
                                                class="form-control" onchange="clearMsg('msg_gender')">
                                            <option value="">
                                                Please select a gender
                                            </option>       
                                            <option value="Male">
                                                Male
                                            </option>
                                            <option value="Female">
                                                Female
                                            </option>
                                        </select>
                                         <span id="msg_gender"></span>
                                    </div>
                                    <div class="col-md-2"><big class="text text-danger">*</big>&nbsp;</div>
                                </div>
                                <!-- End Gender -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Image -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big> Image </big>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="user_image" 
                                               id="user_image"

                                               class="form-control"/>
                                        <span id="msg_image"></span>
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                </div>
                                <!-- End Image -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Row-->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4">
                                        <big> Role </big>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="role_id" id="role_id"
                                                class="form-control" onchange="clearMsg('msg_role')">
                                            <option value="">
                                                Please select a role
                                            </option> 
<?php while ($rowr = $resultr->fetch(PDO::FETCH_BOTH)) { ?>
                                                <option value="<?php echo $rowr['role_id']; ?>">
                                                <?php echo $rowr['role_name']; ?>
                                                </option>
                                                <?php } ?>
                                        </select>
                                         <span id="msg_role"></span>
                                    </div>
                                    <div class="col-md-2"><big class="text text-danger">*</big>&nbsp;</div>
                                </div>
                                <!-- End Role -->
                                <div class="clearfix">&nbsp;</div> 
                                <!-- Start Button -->
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-4"
                                         style="text-align: right">
                                        <button type="submit"
                                                name="sub" 
                                                class="btn btn-success">
                                            Save
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="reset"
                                                name="res" 
                                                class="btn btn-danger">
                                            Clear
                                        </button>
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                </div>
                                <div class="clearfix">&nbsp;</div> 

                            </div>
                        </form>


                    </div>
                </div>         
            </div>
            <div id="footer">
<?php include '../common/footer.php'; ?>
            </div>          
        </div>
    </body>   
    <script>
        function confirmation(status) {
            var r = confirm("Do You Want to " + status + " user");
            if (r) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    
    <script src="../resources/JQuery/jquery.min.js">
    </script>
    <!-- Clent Side validation -->
    <script>
      $(document).ready(function(){
        $("form").submit(function (){
            //Get inputs
            var user_fname=$("#user_fname").val();
            var login_email=$("#login_email").val();
            var user_nic=$("#user_nic").val();
            var user_tel=$("#user_tel").val();
            var user_gender=$("#user_gender").val();
            var role_id=$("#role_id").val();
            var user_dob=$("#user_dob").val();
            
            //valid patterns
            var patnicold=/^[0-9]{9}[vVxX]$/;
            var patnicnew=/^[0-9]{12}$/;
            var pattel=/^[0-9]{9,12}$/;
            
            if(user_fname==""){
                $("#msg_fname").text("First Name can not be empty");
                $("#user_fname").focus();
               $("#msg_fname").css("color","red");
                return false;
            } 
            if(login_email==""){
                $("#msg_email").text("Email can not be empty");
                $("#login_email").focus();
               $("#msg_email").css("color","red");
                return false;
            } 
            //To check existing email.
            var hid=$("#hid").val();
            if (hid==1){
                $("#login_email").select();
               return false;
            }
            //DOB validation
            if(user_dob!=""){
                var cdate=new Date();
                var cyear=cdate.getFullYear();
                var cmonth=cdate.getMonth();
                var cd=cdate.getDate();
               
                var ddate=new Date(user_dob);
                var dyear=ddate.getFullYear();
                var dmonth=ddate.getMonth();
                var dd=ddate.getDate();
                
                var age=cyear-dyear;
                var m=cmonth-dmonth;
                var d=cd-dd;
                
                if(m<0 || (m==0 && d<0)){
                 age--;
                }
                 if(age<18){
                     $("#msg_dob").text("Under Age");
                     $("#user_dob").focus();
                    $("#msg_dob").css("color","red");
                    return false;
                 }
                 if(age>55){
                     $("#msg_dob").text("Over Age");
                     $("#user_dob").focus();
                    $("#msg_dob").css("color","red");
                    return false;
                 }                
                
            }
            
            if(user_nic!=""){
                if(!user_nic.match(patnicold) && !user_nic.match(patnicnew)){
               $("#msg_nic").text("Invalid NIC");
                $("#user_nic").select();
               $("#msg_nic").css("color","red");
                    return false;
                }
            } 
            
            if(user_dob!="" && user_nic!=""){
                if(user_nic.length==10){
                    var dy=String(dyear);
                    var y=dy.substr(2,2);
                    var n=user_nic.substr(0,2);                  
                }else{
                    var y=String(dyear);
                    var n=user_nic.substr(0,4);                  
                }
                if(y!=n){
                      $("#msg_nic").text("DOB and NIC not matching");
                      $("#user_nic").select();
                      $("#msg_nic").css("color","red");
                    
                }
            }
            
            
            if(user_tel!=""){
                if(!user_tel.match(pattel)){
               $("#msg_tel").text("Invalid Telephone No");
                $("#user_tel").select();
               $("#msg_tel").css("color","red");
                    return false;
                }
            } 
            
            if(user_gender==""){
                $("#msg_gender").text("Gender can not be empty");
                $("#user_gender").focus();
               $("#msg_gender").css("color","red");
                return false;
            } 
            var user_image=$("#user_image").val();
            if(user_image!=""){
                              
                var arr=user_image.split(".");
                var ext=arr[arr.length-1];
                ext=ext.toLowerCase();
                var extarr=['jpg','jpeg','gif','png','tiff','svg'];
                         
            if($.inArray(ext,extarr)==-1){
                $("#msg_image").text("Invalid Extension");
                $("#msg_image").css("color","red");
                return false;
                }
               var file=$('#user_image')[0].files[0];//file size limiting
               var s=file.size;
               var ssize=2*(Math.pow(1024,2));
               if(s>ssize){
                   $("#msg_image").text("Size is too much(Max 2mb)");
                   $("#msg_image").css("color","red");
                   return false;
               }
            }
             
            
            
            if(role_id==""){
                $("#msg_role").text("Role name can not be empty");
                $("#role_id").focus();
               $("#msg_role").css("color","red");
                return false;
            } 
            
        });          
      });
      
      function clearMsg(m){
          $("#"+m).text("");
      }
       
       function onlyNos(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
            catch (err) {
                alert(err.Description);
            }
        }
       
function showEmail(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("msg_email").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("msg_email").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getEmail.php?q="+str, true);
  xhttp.send();
}
       
    </script>
    
    
</html>

