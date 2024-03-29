<?php
include"class.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && !empty($_POST['action'])) {

        $action = $_POST['action'];

        switch($action){

            case 'login':                
                $username = $_POST["username"];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = new User();
                $result = $user->login($username, $email, $password);
                if ($result) {
                 if(!session_start()){
                    session_start();
                }
                    if($_SESSION['bcglevel'] == 1){
                       header("refresh:1;url=admindashbaord/index.php");
                    }else{
                         header("refresh:1;url=index.php");
                    }    
                }else{
                    header("refresh:1; url=index.php?reference=loginerror");

                }
               
          
                break;
             
            case 'signup':
                $user = new User();
                    $username = $_POST['username'];
                    $fullname = $_POST['fullname'];
                    $email    = $_POST['email'];
                    $phone = $_POST['phone' ];
                    $password = $_POST['password'];
                    $gender = $_POST['gender'];
                    $idcard = $_POST['idcard']; 
                    $level = 2;
                    $password = md5($password); 
                    $result=$user->selectuser($username, $email, $password);
                    if($row =$result->fetch_assoc() > 0){
                        header("refresh:1;url=signup/index.php?reference=emailexist");

                    } else{                                  
                    $user->setuser($username, $password, $fullname, $email,  $phone, $idcard, $gender, $level);  
                    $result = $user->signup($username, $password, $fullname, $email, $phone, $idcard, $gender, $level);  
                    if($result){
                        header("refresh:1;url=index.php");
                    }   
                    else{
                        
                    } 
                } 
                break; 
            case 'AdminRegister':
                    $username = $_POST['username'];
                    $fullname = $_POST['fullname'];
                    $email    = $_POST['email'];
                    $phone = $_POST['phone' ];
                    $password = $_POST['password'];
                    $gender = $_POST['gender'];
                    $idcard = $_POST['idcard']; 
                    $level = 1;
                    die(); 
                    $password = md5($password); 
                    $user = new User();  
                    $user->setuser($username, $password, $fullname, $email,  $phone, $idcard, $gender, $level);  
                    $result = $user->signup($username, $password, $fullname, $email, $phone, $idcard, $gender, $level);  
                    if($result){
                        header("refresh:1;url=admindashbaord/index.php");
                    }   
                    else{
                        echo "erro";
                    }   
                    break;   
        }
    }
}