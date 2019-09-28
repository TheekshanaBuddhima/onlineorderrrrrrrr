<?php

class login {
  private $login_email;
  private $login_pwd; 

          
  function userLogin($email,$pwd,$con){
      
      $r=$con->prepare("SELECT * FROM login l,user u,role r WHERE l.user_id=u.user_id AND r.role_id=u.role_id AND login_email=? AND login_pwd=? AND user_status=?");
      $r->execute(array($email,$pwd,"Active"));
      //echo $email;
      //echo $pwd;
      //var_dump($r);
      
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
      //echo $r->rowCount();
      
  }
  
  function addUserLogin($email,$pwd,$user_id,$con){
      
      $r=$con->prepare("INSERT INTO login (login_email,login_pwd,user_id) VALUES(?,?,?)");
      $r->execute(array($email,$pwd,$user_id));
            
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
      //echo $r->rowCount();
      
  }
  
  function checkEmail($email,$con){
      
      $r=$con->prepare("SELECT * FROM login WHERE login_email=?");
      $r->execute(array($email));
            
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
      //echo $r->rowCount();
      
  }
  
}
