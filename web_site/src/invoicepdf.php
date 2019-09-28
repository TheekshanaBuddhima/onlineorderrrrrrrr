<?php
if(!isset($_SESSION)){
    session_start();
 }
 //ERROR REPORTING
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include 'dbconnection.php';
$order_id=$_GET['order_id'];

$sql="SELECT * from category";
$result=$con->query($sql);

$sqlpay="SELECT * from payment p,customer c WHERE c.cus_id=p.cus_id AND p.order_id='$order_id'";
$resultpay=$con->query($sqlpay);
$rowpay=$resultpay->fetch_assoc();

/*$sqlp="SELECT * from orders WHERE order_id='$order_id'";
$resultp=$con->query($sqlp);
$rowp=$resultp->fetch_assoc();
$order_id=$rowp['order_id'];
 * /
 */

//To get cart items
//
$sqlc="SELECT sum(qua) as s1,p_id,size_id FROM cart "
        . "WHERE order_id='$order_id' GROUP BY p_id,size_id";
//$sqlc="SELECT * FROM cart c,product p, size s WHERE c.p_id=p.p_id AND c.size_id=s.size_id AND c.order_id='$order_id'";

$resultc=$con->query($sqlc);
include_once '../dompdf/dompdf_config.inc.php';
$html='

                        <h3 style="text-align: center">Invoice</h3>
                        
                            <table class="table table-bordered" 
                  width="90%" border="1" align="center">
                                    <tr>
                                        <th>Invoice No </th> 
                                        <th>:'.$rowpay['pay_id'].'</th> 
                                        <th>Date </th> 
                                        <th>:'.$rowpay['pdate'].'</th> 
                                    </tr>
                                    <tr>
                                        <th>Customer Name </th> 
                                        <th>:'.$rowpay['cus_name'].' </th> 
                                        <th>Email </th> 
                                        <th>:'.$rowpay['cus_email'].'</th> 
                                    </tr>                               
                                
                            </table>
                                            
                <hr />
                        <table class="table table-bordered" 
                  width="90%" border="1" align="center"
                  style="border-collapse: collapse">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Product Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Price</th>
                                                                                  
                            </tr>';
                          
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
                                
                          $html.='<tr>
                                <td>
<img src="../../system/images/product_images/"'.$rowpr['p_image'].'" width="30" height="55">
                                    &nbsp;</td>
                                <td>'.$rowpr['p_name'].'&nbsp;</td>
                                <td>'.$rows['size_code'].'&nbsp;</td>
                                <td>'.$rowc['s1'].'&nbsp;</td>
                                <td>Rs. '.$rowpr['p_price'].'</td>
                                <td>Rs. '.$rowpr['p_price']*$rowc['s1'].'</td>
                             
                            </tr>'; 
                            } 
                             $html.='<tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td>Total Price </td>
                                        <td> Rs.'.$total.
   
    
    
                                            
                                    '</td>
                                    
                                    
                            </tr>                       
                            
                            
                        </table>';
         
                             
$pdf_name=$rowpay['pay_id'];      
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$pdf = $dompdf->output();
$file_location = "../pdf/".$pdf_name.".pdf";
file_put_contents($file_location,$pdf);
$dompdf->stream("invoice.pdf",
array("Attachment" => false));
exit(0);