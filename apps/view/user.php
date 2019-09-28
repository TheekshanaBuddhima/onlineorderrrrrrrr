<?php
error_reporting(~E_NOTICE);
if(isset($_GET['user_id']) && isset($_GET['value'])){
   include '../controller/controller.php';
   $user_id=$_GET['user_id'];
   $value=$_GET['value'];
   $ob=new controller();
   $ob->aordcontroller($user_id, $value);
    
}else{
require '../common/session_handling.php';
include '../common/dbconnection.php';
include '../model/modulemodel.php';
include '../model/usermodel.php';
//Database connection
$ob=new dbconnection();
$con=$ob->connection();

//User's role_id
$role_id=$userinfo['role_id'];

$user_id=$userinfo['user_id'];

//To get modules based on role_id
$obm=new modulemodel();
$resultm=$obm->getUserModules($role_id, $con);

$obu=new usermodel();

//For searching
if(isset($_GET['status']) || isset($_REQUEST['key'])){
    $key=$_REQUEST['key'];
    $resultuall=$obu->viewSearchUsers($con,$key);
}else{
//To get all user info
$resultuall=$obu->viewAllUsers($con);

}
//No of users
$nou=$resultuall->rowCount();

$dev=5;
$nop=ceil($nou/$dev);
//echo $nop;
if($_GET['page']==1 || !$_GET['page']){
    $start=0;
    $n=1;
}else{
    $n=$_GET['page'];
    $start=$dev*($n-1);
}

//echo $start;
if(isset($_GET['status']) || isset($_REQUEST['key'])){
$resultu=$obu->viewSearchUserPerPage($start, $dev,$key,$con);
}else{
$resultu=$obu->viewUserPerPage($start, $dev, $con);  
}

//var_dump($resultm);

/*while($rowm=$resultm->fetch(PDO::FETCH_BOTH)){
    echo $rowm['m_name'];
}
 
 */


// Page No in Session
$_SESSION['n']=$n;
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
                            <?php echo $userinfo['user_fname']." ".$userinfo['user_lname']." | ".$userinfo['role_name'] ?> 
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
                            <?php while($rowm=$resultm->fetch(PDO::FETCH_BOTH)){ 
                                //Convert into lowercase
                                $lm_name=strtolower($rowm['m_name']);
                                $url=$lm_name.".php";
                                
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
                                                                
                            </ul>                            
                        </div>
                        <div>
                            <a href="adduser.php">
     <button type="button" class="btn btn-primary">
         <i class="glyphicon glyphicon-plus"></i> Add
     </button> 
                            </a>
                        </div>
                        <div class="row">
                            <form action="user.php?status=1" method="post">
                            <div class="col-md-6">&nbsp;</div>
                            <div class="col-md-3">
                                <input type="text" name="key" 
                                       required class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <input type="submit" name="search" 
                                       value="Search"
                                       class="btn btn-primary"/>
                            </div>
                            </form>
                        </div>
                        
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?php if(isset($_GET['status'])&& $_REQUEST['key']!=""){?>
                                Search Keyword :<?php echo $key; ?>
                                <?php }?>
                            
                            
                            </div>
                            <div class="col-md-6">No of Records :
                                <span class="badge"> <?php echo $nou; ?> </span> </div>
                            
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div>
                            <?php if($nou){?>
                        </div>
                        
                        
                        <div>
         <table class="table table-bordered table-condensed">
             <tr>
                 <th>&nbsp;</th>
                 <th>User ID</th>
                 <th>First Name</th>
                 <th>Last Name</th>
                 <th>Role</th>
                 <th>Status</th>
                 <th>&nbsp;</th>                
             </tr>
             <?php while($rowu=$resultu->fetch(PDO::FETCH_BOTH)){
                 if($rowu['user_image']==""){
                     $iname="user.png";
                     $path="../resources/images/".$iname;
                 }else{
                     $iname=$rowu['user_image'];
                     $path="../resources/images/user_images/".$iname;
                 }
                 
                 
                 if(strtolower($rowu['user_status'])=="active"){
                     $lable="Deactivate";
                     $style="danger";
                     $value="Deactive";
                 }else{
                     $lable="Activate";
                     $style="info";
                     $value="Active";                     
                 }
                 
                 ?>
             <tr>
                 <td align="center">
                  <img style="border-radius: 100px"
                      src="<?php echo $path; ?>" width="50" />&nbsp;
                 </td>
                  <td><?php echo $rowu['user_id']; ?>&nbsp;</td>
                 <td><?php echo $rowu['user_fname']; ?>&nbsp;</td>
                 <td><?php echo $rowu['user_lname']; ?>&nbsp;</td>
                 <td><?php echo $rowu['role_name']; ?>&nbsp;</td>
                 <td><?php echo $rowu['user_status']; ?>&nbsp;</td>
                
                 <td>
           <a href="viewuser.php?user_id=<?php echo $rowu['user_id']; ?>&action=view">
     <button type="button" class="btn btn-success sm">View</button>
             </a>
            <a href="viewuser.php?user_id=<?php echo $rowu['user_id']; ?>&action=update">
     <button type="button" class="btn btn-primary sm">Update</button>
             </a>
            <?php if($userinfo['user_id']!=$rowu['user_id']){ ?>
         <a href="user.php?user_id=<?php echo $rowu['user_id']; ?>&value=<?php echo $value; ?>">
             <button type="button" class="btn btn-<?php echo $style; ?> sm" onclick="return confirmation('<?php echo $value; ?>')">
         <?php echo $lable; ?></button>
             </a>
            <?php } ?>
               
                     
                     
                 </td>
             </tr>  
             <?php } ?>
                            </table>

     
            <nav class="container">
        <ul class="pagination pagination-sm">
            <?php for($i=1;$i<=$nop;$i++){ ?>
            <li <?php if($n==$i){ ?>class="active" <?php } ?>>
                <?php if(isset($_GET['status'])|| isset($_REQUEST['key'])) { ?>
                <a href="user.php?page=<?php echo $i; ?>&key=<?php echo $key; ?>">
                    
                <?php echo $i; ?>
                </a>
                <?php }else{ ?>
                <a href="user.php?page=<?php echo $i; ?>">
                    
                <?php echo $i; ?>
                </a>
                <?php } ?>
            
            </li>
            <?php } ?>
            
        </ul>
            </nav>
                            <?php }else{?>
                            <p class="alert alert-danger">No Records</p>
                            <?php }?>
                        </div>
                        
                        
                    </div>
                </div>         
            </div>
            <div id="footer">
                <?php include '../common/footer.php'; ?>
            </div>          
        </div>
    </body>   
  <script>
      function confirmation(status){
          var r=confirm("Do You Want to "+status+" user");
          if(r){
              return true;
          }else{
              return false;
          }
      }
  </script>
</html>



<?php } ?>
