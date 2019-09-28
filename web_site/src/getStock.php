<?php
include 'dbconnection.php';
$size_id=$_GET['q'];
$p_id=$_GET['p_id'];


//$sql="SELECT sum(stock_qua) as sumq FROM stock WHERE "
       // . "p_id='$p_id' AND size_id='$size_id'";
$sql="SELECT * FROM stock_balance WHERE p_id='$p_id' AND size_id='$size_id'";
$result=$con->query($sql);
$row=$result->fetch_assoc();

if($row['balance']){
    echo $a=$row['balance'];
    ?>
<p>
    <input type="number" name="qua" id="qua" size="2" max="<?php echo $a; ?>"
                                              class="input-sm" />
                                       
</p>
<?php    
}else{
    echo "<span class='alert-warning'>Not Available</span>";
}   $a="";
?>







