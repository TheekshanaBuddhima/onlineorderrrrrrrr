<?php
require '../common/session_handling.php';
include '../common/dbconnection.php';
include '../model/modulemodel.php';
//Database connection
$ob=new dbconnection();
$con=$ob->connection();

//User's role_id
$role_id=$userinfo['role_id'];

//To get modules based on role_id
$obm=new modulemodel();
$resultm=$obm->getUserModules($role_id, $con);
//var_dump($resultm);

/*while($rowm=$resultm->fetch(PDO::FETCH_BOTH)){
    echo $rowm['m_name'];
}
 
 */



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
                        <div>
                            <table class="list1">
                                <?php while($rowm=$resultm->fetch(PDO::FETCH_BOTH)){ 
                                $lm_name=strtolower($rowm['m_name']);
                                $url=$lm_name.".php";
                                ?>
                                <tr class="list_li">
                                <td class="pad2">
                                 <a class="text" href="<?php echo $url;?>">
                                <?php echo $rowm['m_name'] ?>
                                 </a>   
                                </td>
                             </tr>
                            <?php } ?>
                            </table>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-10">
                        <div class="pad1">
                            <ul class="breadcrumb">
                                <li>Dashboard</li>
                                                                
                            </ul>                            
                        </div>
                        
                        
                    </div>
                </div>         
            </div>
            <div id="footer">
                <?php include '../common/footer.php'; ?>
            </div>          
        </div>
    </body>   
  
</html>

