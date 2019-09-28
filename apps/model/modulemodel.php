<?php
class modulemodel {
    
    function getUserModules($role_id,$con){
        $r=$con->prepare("SELECT * FROM module m,module_role mr WHERE m.m_id=mr.m_id AND mr.role_id=?");
        $r->execute(array($role_id));
          
      if($r->errorCode()!=0){
           $errors = $r->errorInfo();
           echo $errors[2];
       }
      
      return $r;
        
    }
    
    
}
