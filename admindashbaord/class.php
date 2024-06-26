<?php
class Connection{
    private $dbname;
    private $hostname;
    private $username;
    private $password;
    public function connect(){
        $this->hostname = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "bcgsystem";
        $connect = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if(!$connect){
            die("Connection failed: ". mysqli_connect_error());
        }
        return $connect;
    }
}
class User{
    public $username;   
    public $password;
    public $fullname;
    public $email;
    public $idcardnumber;    
    public $phone;
    public $level;
    public $gender;
    public function setuser($username,$password,$fullname,$email, $phone, $idcardnumber, $gender, $level){
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->idcardnumber = $idcardnumber;
        $this->gender = $gender;
        $this->level = $level;
    }

    public function signup($username, $password, $fullname, $email, $phone, $idcardnumber, $gender, $level){
        $conn = new  Connection();
        $connect = $conn->connect();
        $sql = "INSERT INTO users(username, password, fullname, email, phone, idcard, gender, level)
        VALUES('$username', '$password', '$fullname', '$email', '$phone', '$idcardnumber', '$gender', '$level')";
        $result = $connect->query($sql);
        return $result;
    }  
  public function selectuser($username, $email, $password){
    $conn = new Connection();
    $connect = $conn->connect();
    $sql = "SELECT * FROM users WHERE email ='$email' ";
    $result = $connect->query($sql);
    if($result){
       return $result;
    }else{
       return $result =false;
    }

   }
private function authenticate($username, $email, $password){
    $user = new User();
    $result = $user->selectuser($username, $email, $password);
    if($result){
    while($row=$result->FETCH_ASSOC()){
        $dbpassword = $row["password"];
        if($dbpassword == md5($password)){
            return $result;
      }else{
        $result = 0;
        return $result;
      }
    }
}else{
    return false;
}
}
private function setsession($dbid,$dbusername,$dbpassword,$dbfullname,$dbemail,$dbphone,$dbidcard,$dbgender,$dblevel){
    if(!session_start()){
        session_start();
    }
    $_SESSION['bcgid'] = $dbid;
    $_SESSION['bcgusername'] = $dbusername;
    $_SESSION['bcgpassword'] = $dbpassword;
    $_SESSION['bcgfullname'] = $dbfullname;
    $_SESSION['bcgemail'] = $dbemail;
    $_SESSION['bcgphone'] = $dbphone;
    $_SESSION['bcgiidcard'] = $dbidcard;
    $_SESSION['bcggender'] = $dbgender;
    $_SESSION['bcglevel'] = $dblevel;
}   
   public function login($username, $email, $password){
    $conn = new Connection();
    $connect = $conn->connect();
    $user = new User();    
    $result = $user->authenticate($username, $email, $password);
    if($result){
        $result = $user->selectuser($username, $email, $password);
        while($row=$result->fetch_assoc()){
            $dbid = $row['id'];
            $dbusername = $row['username'];
            $dbpassword= $row['password'];
            $dbfullname = $row['fullname'];
            $dbemail = $row['email'];
            $dbphone = $row['phone'];
            $dbidcard = $row['idcard'];
            $dbgender = $row['gender'];
            $dblevel = $row['level'];

        }
        $user->setsession($dbid,$dbusername,$dbpassword,$dbfullname,$dbemail,$dbphone,$dbidcard,$dbgender,$dblevel);
        return $result = true;

    }else{
        return $result=0;

    }


   }
}
class Applicantion{
    private $applicationNumber;
    private $applicantName;
    private $applicantContact;
    private $applicantIdNumber;

    public function generateId(){
        return mt_rand(100000000, 999999999);
    }
    public function setapplicant($applicationNumber,$applicantname, $applicantContact, $applicantIdNumber){
        $this->applicationNumber=$applicationNumber;
        $this->applicantName = $applicantname;
        $this->applicantContact = $applicantContact;
        $this->applicantIdNumber = $applicantIdNumber;

    }
    public function getapplicantname(){
        return $this->applicantName;
    }
    public function getapplicantcontact(){
        return $this->applicantContact;
    } 
    public function getapplicantidnumber(){
        return $this->applicantIdNumber;
    }
    public function createapplication($applicationNumber, $applicantName, $applicantContact, $applicantIdNumber, $childid, $childLastName, $childDateOfBirth, $childPlaceOfBirth, $fatherIdCardNumber , $fatherName, $fatherDateOfBirth, $fatherPlaceOfBirth, $motherIdCardNumber,$motherDateOfBirth , $motherPlaceOfBirth){
        $sql  = "INSERT INTO application(application_number, applicant_name, applicant_contact, child_id, child_name, child_dob, child_place_of_birth, father_id, father_name, father_dob,father_place_of_birth, mother_id, mother_dob, mother_place_of_birth)
        VALUES ('$applicationNumber', '$applicantName', '$applicantContact', '$childid', '$childLastName', '$childDateOfBirth', '$childPlaceOfBirth', '$fatherIdCardNumber' , '$fatherName', '$fatherDateOfBirth', '$fatherPlaceOfBirth', '$motherIdCardNumber','$motherDateOfBirth' , '$motherPlaceOfBirth');";
        $conn = new Connection();
        $connect = $conn ->connect();
        $result = $connect->query($sql);
        if($result){
            return $result;
        }else{
            echo 1;
            die("ERROR: ".$connect->error);
        }

    }
    public function getapplications(){
        $sql = "SELECT * FROM application";
        $conn = new Connection();
        $connect = $conn->connect();
        $result = $connect->query($sql);
        if($result){
            return $result;
        }else{
            die("ERROR:" .$connect->error);
        }
    }
    public function update($applicantIdNumber, $status){
        $sql = "UPDATE  application SET `status`= '$status' WHERE   `application_number` ='$applicantIdNumber'";
        $conn = new Connection();
        $connect = $conn->connect();
        $result = $connect->query($sql);
        if($result){
            return $result;
        }else{
            die("ERROR:" .$connect->error);
        }
        
    }

}
class Child{    
    public $childid;
    private $childFirstName;
    private $childLastName;
    private $childDateOfBirth;
    private $childGender;
    private $childPlaceOfBirth;
    private $childWeight;
    private $childHeight;
    public function setchild($childid, $childFirstName, $childLastName, $childDateOfBirth, $childGender, $childPlaceOfBirth, $childWeight, $childHeight){
     $this->childid = $childid;
     $this->childFirstName=$childFirstName;
     $this->childLastName = $childLastName;
     $this->childDateOfBirth = $childDateOfBirth;
     $this->childGender = $childGender;
     $this->childPlaceOfBirth = $childPlaceOfBirth;
     $this->childWeight = $childWeight;
     $this->childHeight = $childHeight;
    }
    public function getchildid(){
        return $this->childid;
    }
    public function  getchildfirstname(){
        return $this->childFirstName;
    }
     public function getchildlastname(){
        return $this->childLastName;

     }
     public function getchilddateofbirth(){
        return $this->childDateOfBirth;
     }
     public function getchildgender(){
        return $this->childGender;
     }
     public function getchildplaceofbirth(){
        return $this->childPlaceOfBirth;
     }
     public function getchildweight(){
      return $this->childWeight;
     }
     public function getchildhieght(){
        return $this->childHeight;
     }
     public function createchild($childid, $applicationNumber, $childFirstName, $childLastName, $childDateOfBirth, $childGender, $childPlaceOfBirth, $childWeight, $childHeight, $fatherIdCardNumber, $motherIdCardNumber){
     $sql="INSERT INTO child_info(child_id , application_number ,child_fname, child_lname, child_dob, child_gender, child_placeofbirth, child_wieght, child_hieght, father_id, mother_id)
    VALUES ('$childid',$applicationNumber,'$childFirstName', '$childLastName', '$childDateOfBirth', '$childGender', '$childPlaceOfBirth', '$childWeight', '$childHeight', '$fatherIdCardNumber', '$motherIdCardNumber');";

$conn = new Connection();
$connect = $conn->connect();
$result = $connect->query($sql);
if($result){
    $connect->close(); 
    return $result;
}else{
    echo 2;
  die("ERROR:".$connect->error);
}
 
 }



}
class father{
    private $fatherName;
    private $fatherAddress;
    private $fatherPlaceOfBirth;
    private $fatherSubdivision;
    private $fatherDateOfBirth;
    private $fatherOccupation;
    private $fatherIdCardNumber;
    private $fatherPhone;
    private $fatherEmail;
    public function setfather($fatherName, $fatherAddress, $fatherPlaceOfBirth, $fatherSubdivision, $fatherDateOfBirth, $fatherOccupation, $fatherIdCardNumber, $fatherEmail, $fatherPhone){
        $this->fatherName = $fatherName;
        $this->fatherAddress = $fatherAddress;
        $this->fatherPlaceOfBirth = $fatherPlaceOfBirth;
        $this->fatherSubdivision = $fatherSubdivision;
        $this->fatherDateOfBirth = $fatherDateOfBirth;
        $this->fatherOccupation = $fatherOccupation;
        $this->fatherIdCardNumber = $fatherIdCardNumber;
        $this->fatherPhone = $fatherPhone;
        $this->fatherEmail = $fatherEmail; 

    }
    public function getfathername(){
        return $this->fatherName;
    }
    public function getfatheraddress(){
        return $this->fatherAddress;
    }
    public function getfatherplaceofbirth(){
        return $this->fatherPlaceOfBirth;
    }
    public function getfathersubdivision(){
        return $this->fatherSubdivision;
    }
    public function getfatherdateofbirth(){
        return $this->fatherDateOfBirth;
    }
    public function getfatheroccupation(){
        return $this->fatherOccupation;
    }
    public function getfatheridcardnumber(){
        return $this->fatherIdCardNumber;
    }
    public function getfatherphone(){
        return $this->fatherPhone;
    }
    public function getfatheremail(){
        return $this->fatherEmail;
    }
    public function createfather($fatherName, $fatherAddress, $fatherPlaceOfBirth, $fatherSubdivision, $fatherDateOfBirth, $fatherOccupation, $fatherIdCardNumber, $fatherEmail, $fatherPhone, $motherIdCardNumber){
        $sql = "INSERT INTO fathers_info(father_name, father_address, father_place_of_birth, father_subdivision, father_dob, father_occupation, father_id, father_email, father_phone, mother_id)
        VALUES ('$fatherName', '$fatherAddress', '$fatherPlaceOfBirth', '$fatherSubdivision', '$fatherDateOfBirth', '$fatherOccupation', '$fatherIdCardNumber', '$fatherEmail', '$fatherPhone', '$motherIdCardNumber');";
        $conn = new Connection();
        $connect = $conn -> connect();
        $result = $connect->query($sql);
        if($result){
            return $result;
        }else{
            echo 3;
            die("ERROR:" .$connect->error);
        }
    }
    }


class mother{
    private $motherName;
    private $motherAddress;
    private $motherPlaceOfBirth;    
    private $motherSubdivision;
    private $motherDateOfBirth;
    private $motherOccupation;
    private $motherIdCardNumber;
    private $motherPhone;
    private $motherEmail;
    public function setmother($motherName, $motherAddress, $motherPlaceOfBirth, $motherSubdivision, $motherDateOfBirth, $motherOccupation, $motherIdCardNumber, $motherEmail, $motherPhone){
        $this->motherName = $motherName;
        $this->motherAddress = $motherAddress;
        $this->motherPlaceOfBirth = $motherPlaceOfBirth;
        $this->motherSubdivision = $motherSubdivision;
        $this->motherDateOfBirth = $motherDateOfBirth;
        $this->motherOccupation = $motherOccupation;
        $this->motherIdCardNumber = $motherIdCardNumber;
        $this->motherEmail = $motherEmail;
        $this->motherPhone = $motherPhone;
    }
    public function getmothername(){
        return $this->motherName;
    }
    public function getmotheraddress(){
        return $this->motherAddress;
    }

    public function getmotherplaceofbirth(){
        return $this->motherPlaceOfBirth;
    }
    public function getmothersubdivision(){
        return $this->motherSubdivision;
    }
    
    public function getmotherdateofbirth(){
        return $this->motherDateOfBirth;
    }
    public function getmotheroccupation(){
        return $this->motherOccupation;
    }
    public function getmotheridcardnumber(){
        return $this->motherIdCardNumber;
    }
    public function getmotherphone(){
        return $this->motherPhone;
    }
    public function getmotheremail(){
        return $this->motherEmail;
    }
    public function createmother($motherName, $motherAddress, $motherPlaceOfBirth, $motherSubdivision, $motherDateOfBirth, $motherOccupation, $motherIdCardNumber, $motherEmail, $motherPhone){
        $sql = "INSERT INTO mothers_info(mother_name, mother_address, mother_place_of_birth, mother_subdivision, mother_dob, mother_occupation, mother_id, mother_email, mother_phone)
        VALUES ('$motherName', '$motherAddress', '$motherPlaceOfBirth', '$motherSubdivision', '$motherDateOfBirth', '$motherOccupation', '$motherIdCardNumber', '$motherEmail', '$motherPhone');";
    $conn = new Connection();
    $connect = $conn->connect();
    $result = $connect->query($sql);    
    if($result){
        return $result;
    }else{
        echo 4;
        die("ERROR: " .$connect->error);
    }
}


}
class location{                
    private $nationality;
    private $hospitalName;
    private $region;
    private $division;
    private $town;
    public function setlocation($nationality, $hospitalName , $region,$division, $town){
        $this->nationality = $nationality;
        $this->hospitalName = $hospitalName;
        $this->region = $region;
        $this->division = $division;
        $this->town = $town;
    }
    public function getnationality(){
        return $this->nationality;
    }
    public function gethospitalname(){
        return $this->hospitalName;
    }
    public function getregion(){
        return $this->region;
    }
    public function getdivision(){
        return $this->division;
    }
    public function gettown(){
        return $this->town;
    }
    public function createlocation($applicationNumber ,$nationality, $hospitalName , $region,$division, $town){
        $sql = "INSERT INTO location(nationality, application_number, healthcare_name, region, town)
        VALUES ('$nationality',$applicationNumber, '$hospitalName', '$region',  '$town');";
        $conn = new Connection();
        $connect= $conn->connect();
        $result = $connect->query($sql);
        if($result){
            return $result;
        }
        else{
            echo 5;
            die("ERROR: " .$connect->error);
        }
    }

}
class midwife{
    public $midwifeid;
    public $witnessNationality;
    public $witnessIdCard;
    public $midwifeName;
    public $midwifePhone;
    public function setwitness($midwifeid, $witnessNationality, $witnessIdCard, $midwifeName, $midwifePhone){
        $this->midwifeid = $midwifeid;
        $this->witnessNationality =$witnessNationality;
        $this->witnessIdCard =$witnessIdCard;
        $this->midwifeName = $midwifeName;
        $this->midwifePhone = $midwifePhone;
    }
    public function getwitnessnationality(){
        return $this->witnessNationality;
    }
    public function getwitnessidcard(){
        return $this->witnessIdCard;
    }
    public function getmidwifename(){
        return $this->midwifeName;
    }
    public function getmidwifephone(){
        return $this->midwifePhone;
    }
    public function getmidwifeid(){
        return $this->midwifeid;
    }
    public function createwitness($midwifeid,$applicationNumber,$witnessNationality, $witnessIdCard, $midwifeName, $midwifePhone){
        $sql = "INSERT INTO midwife(midwife_id,application_number,nationality, idcard_number, midwife_name, Phone)
        VALUES ('$midwifeid','$applicationNumber','$witnessNationality', '$witnessIdCard', '$midwifeName', '$midwifePhone');";
        $conn =  new Connection;
        $connect = $conn->connect();
        $result = $connect->query($sql);
        if(!$result){
            echo 6;
            die("ERROR:" .$connect->error);

        }
        else{
            return $result;
        }
    }

}
class general{
    public function counter(){
        $sql = "SELECT * FROM `application`";
        $conn =  new Connection;
        $connect = $conn->connect();
        $result = $connect->query($sql);
        $counter = 0;
        while($row = $result->fetch_assoc()){
            $counter = $counter + 1;
        }
        return $counter;
        

    }
}
class registrer{
    public $id;
    public $name;
    public $address;
    public $contact;
    public function setregistrer($id , $name, $address, $contact){
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->contact = $contact;
    }
    public function getid(){
        return $this->id;

    }
    public function getname(){
        return $this->name;
    }
    public function getaddress(){
        return $this->address;
    }
    public function getcontact(){
        return $this->contact;
    }

    public function createregistrar($id , $name, $address, $contact){
       $sql = "INSERT INTO issue_authority(issue_id, authority_name, authority_address, contact)
       VALUES('$id', '$name', '$address', '$contact')";
   $conn =  new Connection;
   $connect = $conn->connect();
   $result = $connect->query($sql);
   if($result){
    return $result;
   }else{
    die("erro" .$connect->error);
   }

    }


    public function selectregistrer(){      
    $sql = "SELECT * FROM ` issue_authority`";
    $conn =  new Connection;
    $connect = $conn->connect();
    $result = $connect->query($sql);
    if($result){
     return $result;
    }else{
     die("erro" .$connect->error);
    }
 
     }


}
class birth{
    public function generatebirth(){
        require_once 'vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf();
        $html =<<<EOD
        <!DOCTYPE html>
        <html lang="en" max-width="800px">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Birth Certificate</title>
           <style>
           html{
            max-width: 700px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 13px;
          
        }
        hr{
           background: black;
           margin-left: 200px;
           border: none;
         
        }
        h{
            margin-left: 350px;
            font-size: 12px;
        }
        
        .certificate {
            width: 700px;
            height: 1300px;
            border: 1px solid #ccc;
            padding: 50px;
            box-sizing: border-box;
            font-size: smaller;
            display: block;
        }
        
        .row {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .label {
            width: 200px;
            font-weight: bold;
        }
        
        .value {
            width: 600px;
        }
        
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .container{
            position: relative;
        }
        .center{
            text-align:center;
        }
        .top-right{
            position: absolute;
            top: 8px;
            right: 16px;
        }
        .of{
            text-align: right;
        }
        .body{
            border-radius: 5px;
            border: 100px;
            padding: 10px;
        }
        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
        }
        .bottom-left {
            position: absolute;
            bottom: 8px;
            left: 16px;
          }
        .info{
            justify-content: left;
            word-wrap: break-word;
          }
        </style>
        </head>
        <body>
            <div class="certificate" class="body">
                <!-- header -->
                <div class="container">
                    <!-- left side -->
                    <div class="top-left">
                        <div>
                            <b>PROVINCE</b><br>
                          <u>NORTH WEST REGION</u>
                        </div>
                        <div>
                            <b>DEPARTMENT/DIVISION </b><br>
                            <u>MEZEM</u>
                        </div>
                        <div>
                            <b>ARRONDISSEMENT/SUBDIVISION </b><br>
                            <u>Bamenda subdivision</u></p>
                        </div>
                    </div>
                    <!-- end left side -->
        
                    <!-- right side -->
                    <div class="top-right">
                        <div class="center">
                            <p><b>REPUBLIQUE DU CAMEROUN</b><br>
                            Paix-Travail-Patrie <br>
                            <b>REPUBLIC OF CAMEROON</b><br>
                            Peace-Work-Fatherland</p>
                        </div>
                    </div>
                    <!-- end right side -->
                </div>
                <!-- end header -->
        
                <!-- form start -->
                <div class="container">
                    <!-- center start -->
                    <div class="container">
                        <div class="center">
                        <br><br>
                            <b>CENTRE D'ETAIT CIVIL</b><br>
                            CIVIL STATUS REGISTRATION CENTRE
                        </div>
                        <div class="of"><b>De</b>-Of ________________________________________________</div>
                        <div class="container">
                            <div class="top-left">
                               <h5><b>ACTE DE NAISSANCE</b><br>
                                BIRTH CERTIFICATE                   
                                <p class="top-right"><b>No</b>_________</p></p></h5>
                            </div>
                        </div>
                    </div>
                    <!-- center end -->
        
                    <!-- information -->
                    <div class="container" class="info">
                        <span>Nom de famille de l'enfant(surname)<br>
                            Surname of the child</span><h></h><hr>
                        <span>Prénom(s) de l'enfant(given name)<br>
                            Given name(s) of the child</span><h></h><hr>
                        <span>Le-On the(DOB)</span><h></h><hr>
                        <span>Est né à -Was born in/at(city)</span><h></h><hr>
                        <span>De Sexe-Sex(sex) </span><h></h><hr>
                        <span>De-Of(father's name) </span><h></h><hr>
                        <span>Né à-Born in/at(father's city)</span><h></h><hr>
                        <span>Le-On(father's DOB) </span><h></h><hr>
                        <span>Domicilié à-Residing at(father's address) </span><h></h><hr>
                        <span>Profession-Occupation(father's occupation) </span><h></h><hr>
                        <span>Et de-And of(mother's name) </span><h></h><hr>
                        <span>Né à-Born in/at(mother's city) </span><h></h><hr>
                        <span>Le-On(mother's DOB)</span><h></h><hr>
                        <span>Domicilié à-Residing at(mother's address)</span><h></h><hr>
                        <span>Profession-Occupation(mother's occupation)</span><h></h><hr>
                        <span>Dressé le(date of verification)<h></h><hr>
                         Drawn up on</span><br>
                        <span>Sur la decleration de________________________________________________</span><br>
                        <span>In accordance with the decleration of___________________________________________</span><br>
                        <span>Les quels ont certifié la sincerité de la présente décleration. <br>
                            Who attended to the truth of this document</span><br>
                        <span>Par nous_____________________________________________________Officer</span><br>
                        <span>De l'état civil du centre de________________________________________________<br>
                            By Us Civil Register for </span><br>
                        <span>Assisté de_________________________________________________Secrétaire d'Etat Civil<br>Civil Satus Secetary
                            In the presence of <br>   
                    </div>
                    <div class="container"><br><br><br>
                        <div class="top-left">Le Déclerant:<br>
                        The declerant<br><br>
                        _______________________</div>
                        <div class="top-right"><br><br><br>Signature de l'Officier d'Etat Civil: <br>
                        Signature of Civil Status Register<br><br>
                        _______________________</div>
                    </div>
                    <!-- information --> 
                </div>
                <!-- end form -->
            </div>
        </body>
        </html>
        EOD;
        
        $dompdf->load_html($html);
        
        $dompdf->set_paper('A4', 'portrait');
        
        $dompdf->render();
        
        $dompdf->stream("laporan.pdf", array("Attachment" => false));
        

    }
}



