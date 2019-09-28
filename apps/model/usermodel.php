<?php
class usermodel {
    public function viewAllUsers($con){
        $r=$con->prepare("SELECT * FROM user u,role r,login l WHERE "
                . "u.role_id=r.role_id AND u.user_id=l.user_id");
        $r->execute();
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
        
        
    } 
    
    public function viewSearchUsers($con,$key){
        $r=$con->prepare("SELECT * FROM user u,role r,login l WHERE "
                . "u.role_id=r.role_id AND u.user_id=l.user_id AND (u.user_fname LIKE '$key%'OR u.user_lname LIKE '$key%'OR u.user_id= '$key%'OR r.role_name LIKE '$key%'OR u.user_status LIKE '$key%')");
        $r->execute(array($key));
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
        
        
    } 
    public function viewUserPerPage($start,$dev,$con){
        $r=$con->prepare("SELECT * FROM user u,role r,login l WHERE u.role_id=r.role_id AND u.user_id=l.user_id LIMIT $start,$dev");
        $r->execute(array($start,$dev));
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
        
        
    }

    public function viewSearchUserPerPage($start,$dev,$key,$con){
        $r=$con->prepare("SELECT * FROM user u,role r,login l WHERE u.role_id=r.role_id AND u.user_id=l.user_id AND (u.user_fname LIKE '$key%' OR u.user_lname LIKE '$key%' OR u.user_id= '$key%' OR r.role_name LIKE '$key%' OR u.user_status LIKE '$key%') LIMIT $start,$dev");
        $r->execute(array($start,$dev));
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
        
        
    }
    
    
    public function aordUser($con,$user_id,$value){
        
        $r=$con->prepare("UPDATE user SET user_status=? WHERE user_id=?");
        $r->execute(array($value,$user_id));
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
    }
    
    public function addUser($con,$arr){
        
        $r=$con->prepare("INSERT INTO user (user_fname,user_lname,user_dob,user_nic,user_tel,user_gender,user_status,role_id) VALUES (?,?,?,?,?,?,?,?)");
        $r->execute(array($arr['user_fname'],$arr['user_lname'],$arr['user_dob'],$arr['user_nic'],$arr['user_tel'],$arr['user_gender'],'Active',$arr['role_id']));
        $user_id=$con->lastinsertId();
       
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $user_id;
        
    }
       public function updateUser($con,$arr){
        
        $r=$con->prepare("UPDATE user SET user_fname=?,user_lname=?,user_dob=?,user_nic=?,user_tel=?,user_gender=?,role_id=? WHERE user_id=?");
        $r->execute(array($arr['user_fname'],$arr['user_lname'],$arr['user_dob'],$arr['user_nic'],$arr['user_tel'],$arr['user_gender'],$arr['role_id'],$arr['u_id']));
        //$user_id=$con->lastinsertId();
       
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
       return $arr['u_id'];
        
    }
    
     public function updateUserImage($con,$user_image,$user_id){
        
        $r=$con->prepare("UPDATE user SET user_image=? WHERE user_id=?");
        $r->execute(array($user_image,$user_id));   
       
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
    }



public function viewAUser($con,$u_id){
        
        $r=$con->prepare("SELECT *FROM user u INNER JOIN role r ON u.role_id=r.role_id INNER JOIN login l ON u.user_id=l.user_id WHERE u.user_id=?");
        $r->execute(array($u_id));   
       
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
    }    
}


