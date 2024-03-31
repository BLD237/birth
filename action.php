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
                    $applicantName = $_POST['fname'];
                    $applicantContact = $_POST['lname'];
                    $applicantIdNumber = $_POST['applicantidnumber'];                    
                    $applicant = new Applicantion();
                    $applicationnumber = $applicant->generateId();
                    $applicant->setapplicant($applicantName, $applicantContact, $applicantIdNumber, $applicationnumber);                  
                    // Child's Information
                    $childFirstName = $_POST['fname'];
                    $childLastName = $_POST['lname'];
                    $childDateOfBirth = $_POST['child'];
                    $childGender = $_POST['gender'];
                    $childPlaceOfBirth = $_POST['placeofbirth'];
                    $childWeight = $_POST['weight'];
                    $childHeight = $_POST['height'];
                    $childid = $applicant->generateId();
                    $child = new Child;
                    $child->setchild($childid,$childFirstName, $childLastName, $childDateOfBirth, $childGender, $childPlaceOfBirth, $childWeight, $childHeight);
                    $child->createchild($childid, $childFirstName, $childLastName, $childDateOfBirth, $childGender, $childPlaceOfBirth, $childWeight, $childHeight, $fatherIdCardNumber, $motherIdCardNumber);
                     // Father's Information
                    $fatherName = $_POST['fathername'];
                    $fatherAddress = $_POST['fatheraddress'];
                    $fatherPlaceOfBirth = $_POST['fatherplaceofbirth'];
                    $motherSubdivision = $_POST['mothersubdivision'];
                    $fatherDateOfBirth = $_POST['fatherdob'];
                    $fatherOccupation = $_POST['fatheroccupation'];
                    $fatherIdCardNumber = $_POST['fatheridcard'];
                    $fatherPhone = $_POST['fatherphone'];
                    $fatherEmail = $_POST['fatheremail'];
                    $father = new father();
                    $father->setfather($fatehername, $fatherAddress, $fatherPlaceOfBirth, $fatherSubdivision, $fatherDateOfBirth, $fatherOccupation, $fatherIdCardNumber, $fatherEmail, $fatherPhone);
                    $father->createfather($fatherName, $fatherAddress, $fatherPlaceOfBirth, $fatherSubdivision, $fatherDateOfBirth, $fatherOccupation, $fatherIdCardNumber, $fatherEmail, $fatherPhone, $motherIdCardNumber);
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
                    $mother->createmother($motherName, $motherAddress, $motherPlaceOfBirth, $motherSubdivision, $motherDateOfBirth, $motherOccupation, $motherIdCardNumber, $motherEmail, $motherPhone);
                    //location
                    $nationality = $_POST['nationality'];
                    $hospitalName = $_POST['hospital_name'];
                    $region = $_POST['region'];
                    $division = $_POST['division'];
                    $town = $_POST['town'];
                    $location = new location();
                    $location->setlocation($nationality, $hospitalName, $region, $division, $town);       
                    $location->createlocation($applicationNumber ,$nationality, $hospitalName , $region,$division, $town);
                    //witness         
                    $witnessNationality = $_POST['witness_nationality'];
                    $witnessIdCard = $_POST['witness_idcard'];
                    $midwifeName = $_POST['midwife_name'];
                    $midwifePhone = $_POST['midwife_phone'];
                    $witness = new midwife();
                    $witness->setwitness($midwifeid,$witnessNationality, $witnessIdCard, $midwifeName, $midwifePhone);
                    $witness->createwitness($midwifeid,$applicationNumber,$witnessNationality, $witnessIdCard, $midwifeName, $midwifePhone);


                     break;     
        }
    }
}