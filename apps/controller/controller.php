<?php
//To start session
session_start();
class controllerLogin{
    public function invoke(){
        if(!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
        
      //  echo $uri;
        
    $uri.=$_SERVER['HTTP_HOST'];
    header('Location: '.$uri.'/onlineorder/apps/view/login.php');        
    }
}


class controllerLogout{
    public function getOut(){
        $row=$_SESSION['userinfo'];        
        $session_id=$row[15];
     
       include '../common/dbconnection.php';
       $ob = new dbconnection();
       $con = $ob->connection();

        
        include '../model/logmodel.php';
        $ob=new logmodel();
        
        //To update log table
        $ob->logOut("LogOut", $session_id, $con);
        
        //To destroy session
        unset($_SESSION['userinfo']);
        
             
    //header('refresh:5,url=../view/login.php');        
    }
}

class controller {
   public $conn;
   function __construct() {
       include '../common/dbconnection.php';
       $ob = new dbconnection();
       $con = $ob->connection();
       $this->conn=$con;
   }

    
    public function logincontroller($email,$pwd){
        include '../model/login.php';
        include '../model/logmodel.php';
        $obj= new login();
        $r=$obj->userLogin($email, $pwd,$this->conn);
        
        if($r->rowCount()){
            
            $obl=new logmodel();
            //Redirect to dashboard         
         
            $row=$r->fetch(PDO::FETCH_BOTH);
             //echo $row[0];
             //echo $row['login_email'];
           
            
            //Log status
            $log_status="login";
            //Remote IP address
            $log_ip=$_SERVER['REMOTE_ADDR'];
            //User ID
            $user_id=$row['user_id'];
            //To create a session
           $session_id=$user_id."_".$log_ip."_".time();
           //To cal a method in logmodel class
  $res=$obl->logIn($log_ip, $log_status, $user_id, $session_id,$this->conn);
       $lastid=$this->conn->lastInsertId(); 
       
       array_push($row, $session_id);
       
      //print_r($row);
       
       
        $_SESSION['userinfo']=$row;
       
  //var_dump($res);           
            //print_r($_SESSION['userinfo']);
          header("location:../view/dashboard.php");
        }else{
     //Encode the message
     $err=base64_encode("Invalid email or password");
            header("location:../view/login.php?err=$err");
        }
        
        
        
    }
    
    public function aordcontroller($user_id,$value){
        include '../model/usermodel.php';
        $obu=new usermodel();
        $r=$obu->aordUser($this->conn, $user_id, $value);
        header("Location:../view/user.php");
    }
     public function addusercontroller($arruser,$image_name,$image_tmp)
             {
        include '../model/usermodel.php';
        $obu=new usermodel();
        $user_id=$r=$obu->addUser($this->conn, $arruser);
          
        
        include '../model/login.php';
        $obl=new login();
        $pwd=sha1("123");
        $r=$obl->addUserLogin($arruser['login_email'], $pwd, $user_id, $this->conn);
        
        //Adding an image in to user folder and reference to the user table
        if($image_name!=""){
            
            
            $image_new=$user_id."_".$image_name;            
            $path="../resources/images/user_images/".$image_new;
            move_uploaded_file($image_tmp, $path);
            
            
            $obu->updateUserImage($this->conn, $image_new, $user_id);
            
            
        }
        
        
        header("Location:../view/user.php");
    }
    public function updateusercontroller($arruser,$image_name,$image_tmp)
             {
        include '../model/usermodel.php';
        $obu=new usermodel();
        $r=$obu->updateUser($this->conn, $arruser);
          
        $user_id=$arruser['u_id'];
        //include '../model/login.php';
        //$obl=new login();
        //$pwd=sha1("123");
        //$r=$obl->addUserLogin($arruser['login_email'], $pwd, $user_id, $this->conn);
        
        //Adding an image in to user folder and reference to the user table
        if($image_name!=""){
            
            
           echo $image_new=$user_id."_".$image_name;            
            $path="../resources/images/user_images/".$image_new;
            move_uploaded_file($image_tmp, $path);
            
            
            $obu->updateUserImage($this->conn, $image_new, $user_id);
            
            
        }
        if(!isset($_SESSION)){
            session_start();
        }
             $page=$_SESSION['n'];
       
        header("Location:../view/user.php?page=$page");
    }
}