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
$p_id=$_GET['p_id'];

$sql="SELECT * from category";
$result=$con->query($sql);

$s_id=$_SESSION['s_id'];

$sqlp="SELECT * from orders WHERE session_id='$s_id'";
$resultp=$con->query($sqlp);
$rowp=$resultp->fetch_assoc();
$order_id=$rowp['order_id'];

$_SESSION['order_id']=$order_id;


//To get cart items
//
$sqlc="SELECT sum(qua) as s1,p_id,size_id FROM cart "
        . "WHERE order_id='$order_id' GROUP BY p_id,size_id";
//$sqlc="SELECT * FROM cart c,product p, size s WHERE c.p_id=p.p_id AND c.size_id=s.size_id AND c.order_id='$order_id'";

$resultc=$con->query($sqlc);

$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='bitresources13@gmail.com'; // Business email ID
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
                            <a href="viewcart.php"><i class="glyphicon glyphicon-shopping-cart" style="color: white"></i></a>
                            
                            
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
                    <div class="container-fluid">
                
                        <table class="table">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Product Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Price</th>
                                <th>&nbsp;</th>                                                     
                            </tr>
                            <?php
                            $total=0;
                            while($rowc=$resultc->fetch_assoc()){ 
                                
                                $size_id=$rowc['size_id'];
                                  $p_id=$rowc['p_id'];
                                
   $sqls="SELECT * FROM size WHERE size_id='$size_id'";
   $sqlpr="SELECT * FROM product WHERE p_id='$p_id'";
   $results=$con->query($sqls);
   $resultpr=$con->query($sqlpr);
   $rows=$results->fetch_assoc();
    $rowpr=$resultpr->fetch_assoc();                           
             $total=$total+($rowpr['p_price']*$rowc['s1']);                 
                                ?>
                            <tr>
                                <td>
<img src="../../system/images/product_images/<?php echo $rowpr['p_image']; ?>"
     width="50" height="auto"
     >
                                    &nbsp;</td>
                                <td><?php echo $rowpr['p_name']; ?>&nbsp;</td>
                                <td><?php echo $rows['size_code']; ?>&nbsp;</td>
                                <td><?php echo $rowc['s1']; ?>&nbsp;</td>
                                <td><?php echo "Rs. ".$rowpr['p_price']; ?>&nbsp;</td>
                                <td><?php echo "Rs. ".$rowpr['p_price']*$rowc['s1']; ?>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr> 
                            <?php } ?>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td>Total Price </td>
                                        <td>
                                    <?php 
    echo "Rs. ".$total."<BR />";
    
    $_SESSION['total']=$total;
    
    
    function convertCurrency($amount, $from, $to){
    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    return round($converted, 0);
}

$t=convertCurrency($total, "LKR", "USD");
                                    ?>
                                            
                                    </td>
                                    
                                    
                            </tr>                       
                            
                            
                        </table>
                            <p align="right">
                                <?php
                                
function paypal_items()
  {
	    global $order_id;
		global $con;
               
	//$bookid;
    $num=0;
	
	    //$id=substr($name,5,strlen($name)-5);
		$get=$con->query("SELECT sum(qua) as s1,p_id,size_id,qua FROM cart WHERE order_id='$order_id' GROUP BY p_id,size_id");
		while($get_row=$get->fetch_array(MYSQLI_ASSOC))
		{
                    $size_id=$get_row['size_id'];
                    $p_id=$get_row['p_id'];
                                
   $sqls="SELECT * FROM size WHERE size_id='$size_id'";
   $sqlpr="SELECT * FROM product WHERE p_id='$p_id'";
   $results=$con->query($sqls);
   $resultpr=$con->query($sqlpr);
   $rows=$results->fetch_assoc();
    $rowpr=$resultpr->fetch_assoc();                           
             
      $p=$rowpr['p_price']*$get_row['s1']; 
      $p=convertCurrency($p, "LKR", "USD");
			//$up=$get_row['unit_price'];
		  $num++;

		  echo '<input type="hidden" name="item_number_'.$num.'" value="'.$get_row['p_id'].'">';
		  echo '<input type="hidden" name="item_name_'.$num.'" value="'.$rowpr['p_name'].'">';
		  echo '<input type="hidden" name="amount_'.$num.'" value="'.$p.'">';
		  echo '<input type="hidden" name="quantity_'.$num.'" value="'.$get_row['s1'].'">';
		 
		}
  }                        
                                
                                ?>
                                
                                
                   
<form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">

<?php paypal_items(); ?>
<input type="hidden" name="item_name" value="Item Name">
<input type="hidden" name="currency_code" value="Rs">
  
   

    <input type="hidden" name="cpp_header_image" value="">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" 
       value="http://localhost/olsms/web_site/cancel.php">
    <input type="hidden" name="return" 
     value="http://localhost/olsms/web_site/src/checkoutprocess.php">
                                    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>  
                                
  
<a href="checkoutprocess.php">                   
     <button type="button" class="btn btn-success">Payment</button>
 </a>                            
                                
                        </p>    
                        
                        
                        
                        
                        
                </div>
                
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
        <h4 class="modal-title">Customer Login</h4>
      </div>
      <div class="modal-body">
          <form action="validate.php?order_id=<?php echo $order_id; ?>" method="post" onsubmit="return validate()">
              <p id="show"></p>
          <h4>
              <input type="text" name="uname" id="uname" required="" 
                     placeholder="Email Address" class="form-control" />
          </h4>
          
          <h4>
              <input type="password" name="pass" id="pass" required="" 
                     placeholder="Password" class="form-control" />
          </h4>
          <h4>
              <button type="submit" class="btn btn-success">
                  Login
              </button>
          </h4>
          <p><a href="forgotpassword.html">Forgot Password </a></p>
          <p><a href="signup.php">Sign Up </a></p>
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
