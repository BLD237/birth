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



$sql = "CREATE TABLE `users` (
    `id` int(11) NOT NULL ,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `fullname` varchar(255) NOT NULL,
    `email`    varchar(255) NOT NULL,
    `idcard`   varchar(255) NOT NULL,
    `level`    int(11) NOT NULL ,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
      ) ";    

//   $conn = new Connection();
//   $connect = $conn->connect();
//   $result = $connect ->query($sql); 
//   var_dump($result);   
// $email = "muforbelmond20@gmail.com";
// $conn = new Connection();
// $connect = $conn->connect();
// $sql = "SELECT * FROM users WHERE email ='$email' ";
// $result = $connect->query($sql);
        
// var_dump($result);

