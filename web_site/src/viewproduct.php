<?php
if(!isset($_SESSION)){
    session_start();
 }
 //ERROR REPORTING
error_reporting(E_ERROR | E_WARNING | E_PARSE);

 if($_SESSION['s_id']==""){
      //To get IP address
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    $_SESSION['s_id']=time()+"_".$ip;
 }
 
 
include 'dbconnection.php';
$item_id=$_GET['item_id'];

$sql="SELECT * from subcategory";
$result=$con->query($sql);

$sqlp="SELECT * from category c,product p "
        . "WHERE c.cat_id=p.cat_id AND p.p_id='$p_id'";
$resultp=$con->query($sqlp);
$rowp=$resultp->fetch_assoc();

$sqlorder="SELECT * from category c,product p "
        . "WHERE c.cat_id=p.cat_id AND p.p_id='$p_id'";
$resultp=$con->query($sqlp);
$rowp=$resultp->fetch_assoc();

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Smart Design</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" 
              href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/layout.css" />
        <link rel="icon" href="../IMAGES/cart_logo.png" />
        <script type="text/javascript" src="../jquery/jquery.min.js">
        </script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js">
            </script>
            
            <script type="text/javascript">
    //Ajax for stock availability
function showStock(str,p_id)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showstock").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showstock").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getStock.php?q="+str+"&p_id="+p_id,true);
xmlhttp.send();
}
</script>
            
            
            
            
            
            
    </head>
    <body>
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function validate(){
    if(document.getElementById('uname').value==""){
        document.getElementById('show').innerHTML="errr";
        return false;
        
    }
    
}


</script>
        <div id="main">
            <div id="header">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div style="padding-top: 10px">
                            <img src="../IMAGES/Online_Store_Logo.png" height="75px" width="auto" />
                            
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="tittle">
                            Smart Design Online Fashion Store


                            
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="padlink">
                            <a href="http://www.facebook.com" data-toggle="tooltip"
                               title="FaceBook">
                            <img src="../IMAGES/facebook_30x30.png" />
                        </a>
                        <a href="http://www.facebook.com">
                            <img src="../IMAGES/tw.jpg" width="30" height="30" />
                        </a>
                        <a href="http://www.facebook.com">
                            <img src="../IMAGES/ut.jpg" width="30" height="30" />
                        </a>
                            <a href="http://www.facebook.com">
                                <img src="../IMAGES/g.png" width="30" height="30" />
                        </a>
                            
                            <br /><br />
                            <a 
                                data-toggle="modal" data-target="#myModal" style="color: white">
                                My Account
                                
                            </a>
                            <a href="cartview.php"><i class="glyphicon glyphicon-shopping-cart" style="color: white"></i></a>
                            
                            
                        </div>
                        
                        
        </div>
                        
                        
                        
                    </div>
                    
                </div>         
                
                
        
        <div id="navi">
            <div class="row"><div class="col-md-12">
            <ul class="inlinelink">
                <li>
                    <a href="viewproduct.php?c_id=L" class="linka"><B>LATEST</b></a></li>
                 <a href="viewproduct.php?c_id=B" class="linka"><B>BESTSELLER</b></a></li>
                <?php while($row=$result->fetch_assoc()){ ?>
                <li>
                    <a href="viewcatproduct.php?c_id=<?php echo $row['cat_id']; ?>" class="linka"><?php echo $row['cat_name']; ?></a></li>
                          
                <?php } ?>
            </ul>
               
           </div>
               
              </div>
        </div>
            <div id="contents">
                <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-home"></i> 
                            <a href="index.php">Home</a>
                        
                    </li>
                </ol>
                <form action="addtocart.php?p_id=<?php echo $p_id; ?>" method="post">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">&nbsp;</div>
                            <div class="col-lg-8">
                                <table border="0" class="table table-condensed" 
                                       width="600" align="center">
                                        <tr>
                                      <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr>
                           <td rowspan="6">
                   <img src="../../system/images/product_images/<?php echo $rowp['p_image'] ?>"
                                 height="400" width="auto"/>
                               &nbsp;</td><td>Code :<?php echo $rowp['p_id']; ?></td>
                                        </tr>
                                            <tr>
                           <td>Name : <?php echo $rowp['p_name']; ?></td>
                                        </tr>
                            <tr>
                           <td>Category :<?php echo $rowp['cat_name']; ?></td>
                            </tr>
                            <tr>
                           <td>Size :
                           <?php
   $sqlsize="SELECT * FROM size s,product_size ps WHERE s.size_id=ps.size_id "
                                   . "AND ps.p_id='$p_id'";
                           $resultsize=$con->query($sqlsize);
                           
                           ?>
                               <select name="size" class="input-sm" required 
                                       onchange="showStock(this.value,<?php echo $p_id; ?>)">
                                   <option value="">Select a Size</option>
                 <?php while($rowsize=$resultsize->fetch_assoc()){ ?>
         <option value="<?php echo $rowsize['size_id']; ?>">
         <?php echo $rowsize['size_code']; ?>
         </option>           
                 <?php } ?>
                                       
                                       
                               </select>
                           </td>
                           </tr>
                           <tr>
                           <td>Availability :
                               <span id="showstock"></span>
                                   
                           
                           </td>
                            </tr>         
                            <tr>
                                <td><button type="submit" 
                                            class="btn btn-success">Add to Cart </button>
                                </td>
                           </tr>                                    
                            </table>
                            </div>
                             <div class="col-lg-2">&nbsp;</div>
                            </div>
                            
                        
                        <hr/>
                    </div>
                </form>
                
            </div>
            <div id="newsbar">
                <div class="row">
                    <div class="col-lg-6">
                    
                        <div class="fb-like" data-href="http://www.bit.lk" data-width="300" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        
                    </div>
                    <div class="col-lg-6">
                    
                        <img src="../IMAGES/images (3).jpg" width="100px" height="auto" />&nbsp;<img src="../IMAGES/donate-with-paypal.jpg" width="85px" height="auto" />
                        
                    </div>
                </div>
                
                
                
            </div>
            
             <div id="prefooter">
                
                   
                </div>
            <div id="footer">
                <div id="leftfooter">
                    CopyRight &COPY; uoc 2012-2016
                </div>
                <div id="rightfooter">
                    Web Designed By: 
                </div>
                
                
                
            </div>       
            
            
        </div>
        
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Donor Login</h4>
      </div>
      <div class="modal-body">
          <form action="validate.php" method="post" onsubmit="return validate()">
              <p id="show"></p>
          <h4>
              <input type="text" name="uname" id="uname" 
                     placeholder="User Name" class="form-control" />
          </h4>
          
          <h4>
              <input type="password" name="pass" id="pass" 
                     placeholder="Password" class="form-control" />
          </h4>
          <h4>
              <button type="submit" class="btn btn-success">
                  Login
              </button>
          </h4>
          <p><a href="forgotpassword.html">Forgot Password </a></p>
          </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        
        
        
        <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
        
    </body>
</html>
