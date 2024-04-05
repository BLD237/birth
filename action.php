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
                       header("refresh:0;url=admindashbaord/index.php");
                    }else{
                         header("refresh:0;url=admindashbaord/index.php");
                    }    
                }else{
                    header("refresh:1; url=index.php?reference=loginerror");

                }
               
          
                break;
             
            case 'AdminRegister':
                $user = new User();
                    $username = $_POST['username'];
                    $fullname = $_POST['fullname'];
                    $email    = $_POST['email'];
                    $phone = $_POST['phone' ];
                    $password = $_POST['password'];
                    $gender = $_POST['gender'];
                    $idcard = $_POST['idcard']; 
                    $level = 1;
                    $password = md5($password); 
                    $result=$user->selectuser($username, $email, $password);
                    if($row =$result->fetch_assoc() > 0){
                        
                        header("refresh:0;url=admindashbaord/register.php?reference=emailexist");

                    } else{                                  
                    $user->setuser($username, $password, $fullname, $email,  $phone, $idcard, $gender, $level);  
                    $result = $user->signup($username, $password, $fullname, $email, $phone, $idcard, $gender, $level);  
                    if($result){
                        header("refresh:1;url=admindashbaord/index.php");
                    }   
                    else{
                        
                    } 
                } 
                break; 
            case 'test':
                    $username = $_POST['username'];
                    $fullname = $_POST['fullname'];
                    $email    = $_POST['email'];
                    $phone = $_POST['phone' ];
                    $password = $_POST['password'];
                    $gender = $_POST['gender'];
                    $idcard = $_POST['idcard']; 
                    $level = 1;
                   
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
                 case 'register':
                    $applicantName = $_POST['applicantname'];
                    $applicantContact = $_POST['applicantcontact'];
                    $applicantIdNumber = $_POST['applicantidnumber'];                    
                    $applicant = new Application();
                    $applicationnumber = $applicant->generateId();
                    $applicant->setapplicant($applicantName, $applicantContact, $applicantIdNumber, $applicationnumber);                  
                    // Child's Information
                    $childFirstName = $_POST['fname'];
                    $childLastName = $_POST['lname'];
                    $childDateOfBirth = $_POST['childdob'];
                    $childGender = $_POST['gender'];
                    $childPlaceOfBirth = $_POST['placeofbirth'];
                    $childWeight = $_POST['wieght'];
                    $childHeight = $_POST['hieght'];
                    $childid = $applicant->generateId();
                    $child = new Child;
                    $child->setchild($childid,$childFirstName, $childLastName, $childDateOfBirth, $childGender, $childPlaceOfBirth, $childWeight, $childHeight);
                    
                     // Father's Information
                    $fatherName = $_POST['fathername'];
                    $fatherAddress = $_POST['fatheraddress'];
                    $fatherPlaceOfBirth = $_POST['fatherplaceofbirth'];
                    $fatherSubdivision = $_POST['fathersubdivision'];
                    $fatherDateOfBirth = $_POST['fatherdob'];
                    $fatherOccupation = $_POST['fatheroccupation'];
                    $fatherIdCardNumber = $_POST['fatherid'];
                    $fatherPhone = $_POST['fatherphone'];
                    $fatherEmail = $_POST['fatheremail'];
                    $father = new father();
                    $father->setfather($fatherName, $fatherAddress, $fatherPlaceOfBirth, $fatherSubdivision, $fatherDateOfBirth, $fatherOccupation, $fatherIdCardNumber, $fatherEmail, $fatherPhone);
                  
                    //mothers information
                    $motherName = $_POST['mothername'];
                    $motherAddress = $_POST['motheraddress'];
                    $motherPlaceOfBirth = $_POST['mother_place_of_birth'];
                    $motherSubdivision = $_POST['mother_subdivision'];
                    $motherDateOfBirth = $_POST['mother_date_of_birth'];
                    $motherOccupation = $_POST['mother_occupation'];
                    $motherIdCardNumber = $_POST['mother_idcard_number'];
                    $motherPhone = $_POST['mother_phone'];
                    $motherEmail = $_POST['mother_email'];
                    $mother = new mother();
                    $mother->setmother($motherName, $motherAddress, $motherPlaceOfBirth, $motherSubdivision, $motherDateOfBirth, $motherOccupation, $motherIdCardNumber, $motherEmail, $motherPhone);
                    
                    //location
                    $nationality = $_POST['nationality'];
                    $hospitalName = $_POST['hospital_name'];
                    $region = $_POST['region'];
                    $division = $_POST['division'];
                    $town = $_POST['town'];
                    $location = new location();
                    $location->setlocation($nationality, $hospitalName, $region, $division, $town);      
                    
                    //witness         
                    $witnessNationality = $_POST['witness_nationality'];
                    $witnessIdCard = $_POST['witness_idcard'];
                    $midwifeName = $_POST['midwife_name'];
                    $midwifePhone = $_POST['midwife_phone'];
                    $midwifeid = $applicant->generateId();
                    $witness = new midwife();
                    $witness->setwitness($midwifeid,$witnessNationality, $witnessIdCard, $midwifeName, $midwifePhone);
                    $child->createchild($childid,$applicationnumber, $childFirstName, $childLastName, $childDateOfBirth, $childGender, $childPlaceOfBirth, $childWeight, $childHeight, $fatherIdCardNumber, $motherIdCardNumber);
                    $result = $father->checkfather( $fatherIdCardNumber);
                    if($rows = $result->fetch_assoc()>0){

                    }else{  
                    $father->createfather($fatherName, $fatherAddress, $fatherPlaceOfBirth, $fatherSubdivision, $fatherDateOfBirth, $fatherOccupation, $fatherIdCardNumber, $fatherEmail, $fatherPhone, $motherIdCardNumber);
                    }
                    $result = $mother->checkmother( $motherIdCardNumber);
                    if($rows = $result->fetch_assoc()>0){

                    }else{  
                        $mother->createmother($motherName, $motherAddress, $motherPlaceOfBirth, $motherSubdivision, $motherDateOfBirth, $motherOccupation, $motherIdCardNumber, $motherEmail, $motherPhone);
                     }        
                    
                    
                    $location->createlocation($applicationnumber ,$nationality, $hospitalName , $region,$division, $town);
                    $witness->createwitness($midwifeid,$applicationnumber,$witnessNationality, $witnessIdCard, $midwifeName, $midwifePhone);
                   
                    $result = $applicant->createapplication($applicationnumber, $applicantName, $applicantContact, $applicantIdNumber, $childid, $childLastName, $childDateOfBirth, $childPlaceOfBirth, $fatherIdCardNumber , $fatherName, $fatherDateOfBirth, $fatherPlaceOfBirth, $motherIdCardNumber,$motherDateOfBirth , $motherPlaceOfBirth);
                    if($result){
                        
                       header("LOCATION:contact.php?reference=applicatonsubmited&&applicationnumber=$applicationnumber&&name=$applicantName&&child=$childFirstName");
                    }else{
                        echo "faild";
                    }

       

                     break;     
                     case 'registral':
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $address = $_POST['address'];
                        $contact = $_POST['contact'];                     
                        
                        break;


                    case'send':
                        
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'];
                    $mesage = $_POST['message'];
                    $status = 'unread';
                    $message = new message();
                    $result = $message->send($fname, $lname, $email, $mesage, $status);
                    if($result){
                        header("LOCATION: help.php?reference=sent");
                    }
                        
                        break;
        }
    }
}