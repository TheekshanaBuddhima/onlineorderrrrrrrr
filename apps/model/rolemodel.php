<?php
class rolemodel {
    
    function getAllRole($con){
        $r=$con->prepare("SELECT * FROM role");
        $r->execute();
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
    }
    
    
}
