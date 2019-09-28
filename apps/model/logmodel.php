<?php

class logmodel {
  public $session_id;
 
          
  function logIn($log_ip,$log_status,$user_id,$session_id,$con){      
      $r=$con->prepare("INSERT INTO log (log_in,log_ip,"
              . "log_status,user_id,session_id) VALUES(NOW(),?,?,?,?)");
      $r->execute(array($log_ip,$log_status,$user_id,$session_id));
         
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
          
  }
  
  function logOut($log_status,$session_id,$con){      
      $r=$con->prepare("UPDATE log SET log_out=NOW(),log_status=? WHERE session_id=?");
      $r->execute(array($log_status,$session_id));
         
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
          
  }
  
}
