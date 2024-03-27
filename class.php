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
class adminuser{
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $idcardnumber;
    public $level;

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


