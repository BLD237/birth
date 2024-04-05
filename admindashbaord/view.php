<?php
include 'class.php';
if(!session_start()){
  session_start();
}
if($_SESSION['bcglevel']==1){

}else if($_SESSION['bcglevel']==2){
  include "user.php";
}else{
  header("LOCATION:  /birth/index.php?reference=notlogin");
}


if(isset($_GET)){

  $applicationnumber = $_GET['reference'];
  

  
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action){
      case"update":
        $statusaction = $_POST['status'];
        $registrar = $_POST['issue'];    
         $app = new Applicantion();
         $result = $app->update($applicationnumber, $statusaction);
        $sql = "SELECT * FROM application WHERE `application_number` = '$applicationnumber'";
       $bstatus =    $statusaction ;
       switch($bstatus){
        case "verified":
         
         
        $conn = new Connection();
        $birthid = $app->generateId();
        $connect = $conn->connect();
        $result = $connect->query($sql);
       
        while($row = $result->fetch_assoc()){
        $childid = $row['child_id'];       
        $fatherid = $row['father_id'];       
        $motherid = $row['mother_id'];         
        }
        $sql = "SELECT * FROM midwife WHERE `application_number` = '$applicationnumber'";
        $result = $connect ->query($sql);
        while($row = $result->fetch_assoc()){
          $witnessid = $row['midwife_id'];                  
              

        }
        $sql = "SELECT * FROM location WHERE `application_number`= '$applicationnumber'";
        $result = $connect->query($sql);
        while($row = $result->fetch_assoc()){
        $locationid = $row['location_id'];  
       
     }
    
        $sql = "INSERT INTO birthcerticate(birthcertificate_number, application_number, child_id, mother_id, father_id, location_id, registrar, midwife_id, status)
        values('$birthid', '$applicationnumber', '$childid','$motherid', '$fatherid', '$locationid', '$registrar', '$witnessid', '$bstatus')";
        $result = $connect->query($sql);
        if($result){

        }else{
          die("erro: " .$connect->error);
        }
        break;
      }       
               
        
        
        break;


    case"download":
     
      if(isset($_GET)){
        $applicationnumber = $_GET['reference'];
        $sql = "SELECT * FROM application WHERE `application_number` = '$applicationnumber'";
       
        $conn = new Connection();
        $connect = $conn->connect();
        $result = $connect->query($sql);
        while($row = $result->fetch_assoc()){
        $childid = $row['child_id'];
        $childlname = $row['child_name']; 
        $childdob = $row['child_dob'];
        $childplaceofbirth = $row['child_place_of_birth'];
        $fatherid = $row['father_id'];
       
        $motherid = $row['mother_id'];  
       
        }
      
        $sql = "SELECT * FROM fathers_info where `father_id` ='$fatherid'";
        $result = $connect->query($sql);
      while($row = $result->fetch_assoc()){ 
        $fathername = $row['father_name']; 
        $fatheraddress = $row['father_address'];
        $fatheroccupation = $row['father_occupation'];
        $fatherdob = $row['father_dob'];
        $fatherplaceofbirth = $row['father_place_of_birth'];
       
    
      }      
              $sql = "SELECT * FROM mothers_info where `mother_id` ='$motherid'";
                $result = $connect->query($sql);
                while($row = $result->fetch_assoc()){
                  $mothername = $row['mother_name'];
                  $motheroccupation = $row['mother_occupation'];
                  $motherdob = $row['mother_dob'];
                  $motherplaceofbirth = $row['mother_place_of_birth'];                  
                  $motheraddress = $row['mother_address'];
                
       
                }
                $sql = "SELECT * FROM midwife WHERE `application_number` = '$applicationnumber'";
                $result = $connect ->query($sql);
                while($row = $result->fetch_assoc()){
                  $witnesname = $row['midwife_name'];                  
                      
      
                }
                $sql = "SELECT * FROM location WHERE `application_number`= '$applicationnumber'";
                $result = $connect->query($sql);
                while($row = $result->fetch_assoc()){
                  $hospital = $row['healthcare_name'];
                  $town = $row['town'];
                }
                $sql = "SELECT * FROM child_info WHERE `child_id`= '$childid'";
                $result = $connect->query($sql);
                while($row = $result->fetch_assoc()){
                  $childfname = $row['child_fname'];
                  $childgender = $row['child_gender'];

                 
                }
                $sql = "SELECT * FROM `birthcerticate` WHERE `application_number`= '$applicationnumber'";
                $result = $connect->query($sql);
                while($row = $result->fetch_assoc()){
                $birthnumber = $row['birthcertificate_number'];
                 
                }
                
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
                 margin-left: 130px;
                 border: none;
               
              }
              h{
                  margin-left: 100px;
                  font-size: 17px;
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
                                      <p class="top-right"><b>No</b>____$birthnumber._____</p></p></h5>
                                  </div>
                              </div>
                          </div>
                          <!-- center end -->
              
                          <!-- information -->
                          <div class="container" class="info">
                              <span>Nom de famille de l'enfant<br>
                                  Surname of the child</span><h class"">$childfname</h><hr>
                              <span>Prénom(s) de l'enfant<br>
                                  Given name(s) of the child</span><h>$childlname</h><hr>
                              <span>Le-On the</span><h>$childdob</h><hr>
                              <span>Est né à -Was born in/at</span><h>$childplaceofbirth</h><hr>
                              <span>De Sexe-Sex</span><h>$childgender</h><hr>
                              <span>De-Of</span><h>$fathername</h><hr>
                              <span>Né à-Born in/at</span><h>$fatherplaceofbirth</h><hr>
                              <span>Le-On</span><h>$fatherdob</h><hr>
                              <span>Domicilié à-Residing at </span><h>$fatheraddress</h><hr>
                              <span>Profession-Occupation</span><h>$fatheroccupation</h><hr>
                              <span>Et de-And of</span><h>$mothername</h><hr>
                              <span>Né à-Born in/at(mother's city) </span><h>$motherplaceofbirth</h><hr>
                              <span>Le-On</span><h>$motherdob</h><hr>
                              <span>Domicilié à-Residing at</span><h>$motheraddress</h><hr>
                              <span>Profession-Occupation</span><h>$motheroccupation</h><hr>
                              <span>Dressé le<h></h><hr>
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
              
              $dompdf->stream("$applicationnumber$childfname.pdf", array("Attachment" => true));
      
              }          
              
      break;
      case'print':
        if(isset($_GET)){
          $applicationnumber = $_GET['reference'];
          $sql = "SELECT * FROM application WHERE `application_number` = '$applicationnumber'";
         
          $conn = new Connection();
          $connect = $conn->connect();
          $result = $connect->query($sql);
          while($row = $result->fetch_assoc()){
          $childid = $row['child_id'];
          $childlname = $row['child_name']; 
          $childdob = $row['child_dob'];
          $childplaceofbirth = $row['child_place_of_birth'];
          $fatherid = $row['father_id'];
         
          $motherid = $row['mother_id'];  
         
          }
        
          $sql = "SELECT * FROM fathers_info where `father_id` ='$fatherid'";
          $result = $connect->query($sql);
        while($row = $result->fetch_assoc()){ 
          $fathername = $row['father_name']; 
          $fatheraddress = $row['father_address'];
          $fatheroccupation = $row['father_occupation'];
          $fatherdob = $row['father_dob'];
          $fatherplaceofbirth = $row['father_place_of_birth'];
         
      
        }      
                $sql = "SELECT * FROM mothers_info where `mother_id` ='$motherid'";
                  $result = $connect->query($sql);
                  while($row = $result->fetch_assoc()){
                    $mothername = $row['mother_name'];
                    $motheroccupation = $row['mother_occupation'];
                    $motherdob = $row['mother_dob'];
                    $motherplaceofbirth = $row['mother_place_of_birth'];                  
                    $motheraddress = $row['mother_address'];
                  
         
                  }
                  $sql = "SELECT * FROM midwife WHERE `application_number` = '$applicationnumber'";
                  $result = $connect ->query($sql);
                  while($row = $result->fetch_assoc()){
                    $witnesname = $row['midwife_name'];                  
                        
        
                  }
                  $sql = "SELECT * FROM location WHERE `application_number`= '$applicationnumber'";
                  $result = $connect->query($sql);
                  while($row = $result->fetch_assoc()){
                    $hospital = $row['healthcare_name'];
                    $town = $row['town'];
                  }
                  $sql = "SELECT * FROM child_info WHERE `child_id`= '$childid'";
                  $result = $connect->query($sql);
                  while($row = $result->fetch_assoc()){
                    $childfname = $row['child_fname'];
                    $childgender = $row['child_gender'];
  
                   
                  }
                  $sql = "SELECT * FROM `birthcerticate` WHERE `application_number`= '$applicationnumber'";
                  $result = $connect->query($sql);
                  while($row = $result->fetch_assoc()){
                  $birthnumber = $row['birthcertificate_number'];
                   
                  }
                  
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
                   margin-left: 130px;
                   border: none;
                 
                }
                h{
                    margin-left: 100px;
                    font-size: 17px;
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
                                        <p class="top-right"><b>No</b>____$birthnumber._____</p></p></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- center end -->
                
                            <!-- information -->
                            <div class="container" class="info">
                                <span>Nom de famille de l'enfant<br>
                                    Surname of the child</span><h class"">$childfname</h><hr>
                                <span>Prénom(s) de l'enfant<br>
                                    Given name(s) of the child</span><h>$childlname</h><hr>
                                <span>Le-On the</span><h>$childdob</h><hr>
                                <span>Est né à -Was born in/at</span><h>$childplaceofbirth</h><hr>
                                <span>De Sexe-Sex</span><h>$childgender</h><hr>
                                <span>De-Of</span><h>$fathername</h><hr>
                                <span>Né à-Born in/at</span><h>$fatherplaceofbirth</h><hr>
                                <span>Le-On</span><h>$fatherdob</h><hr>
                                <span>Domicilié à-Residing at </span><h>$fatheraddress</h><hr>
                                <span>Profession-Occupation</span><h>$fatheroccupation</h><hr>
                                <span>Et de-And of</span><h>$mothername</h><hr>
                                <span>Né à-Born in/at(mother's city) </span><h>$motherplaceofbirth</h><hr>
                                <span>Le-On</span><h>$motherdob</h><hr>
                                <span>Domicilié à-Residing at</span><h>$motheraddress</h><hr>
                                <span>Profession-Occupation</span><h>$motheroccupation</h><hr>
                                <span>Dressé le<h></h><hr>
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
                
                $dompdf->stream("$applicationnumber$childfname.pdf", array("Attachment" => false));
        
                }  

        break;
    }
 
}
}




?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BCG-admin-Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">BCG-SYSTEM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn">.</i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>           
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-person"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['bcgusername'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['bcgusername'] ?></h6>
              <span><?php echo $_SESSION['bcgemail']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Birth certificate App..</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="newapplications.php">
              <i class="bi bi-circle"></i><span>New Applications</span>
            </a>
          </li>
          <li>
            <a href="verified.php">
              <i class="bi bi-circle"></i><span>Verified Applications</span>
            </a>
          </li>
          <li>
            <a href="rejected.php">
              <i class="bi bi-circle"></i><span>Rejected Applications</span>
            </a>
          </li>
          <li>
            <a href="allapplications.php">
              <i class="bi bi-circle"></i><span>All Applications</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Manage Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="register.php">
              <i class="bi bi-circle"></i><span>Create User</span>
            </a>
          </li>
          <li>
            <a href="manageusers.php">
              <i class="bi bi-circle"></i><span>Manage Admin users</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Manage users</span>
            </a>
          </li>
          
        </ul>

      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Search</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->   

   

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-left"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/birth/index.php">
          <i class="bi bi-file-earmark"></i>
          <span>Home</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">New Applications</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
       
        <div class="col">

<div class="card">
  <div class="card-body pt-3">
    <!-- Bordered Tabs -->
    <ul class="nav nav-tabs nav-tabs-bordered">

      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Father's information</button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Mother's information</button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Action</button>
      </li>

    </ul>
    <?php
    if(isset($_GET)){

  $applicationnumber = $_GET['reference'];
  $sql = "SELECT * FROM application WHERE `application_number` = '$applicationnumber'";
 
  $conn = new Connection();
  $connect = $conn->connect();
  $result = $connect->query($sql);
  while($row = $result->fetch_assoc()){
  $childid = $row['child_id'];
  $childname = $row['child_name']; 
  $childdob = $row['child_dob'];
  $childplaceOfBirth = $row['child_place_of_birth'];
  $fatherid = $row['father_id'];
  $fathername = $row['father_name'];
  $motherid = $row['mother_id'];
  $mothername = $row['mother_name']; 
  $status = $row['status'];
  }

  $sql = "SELECT * FROM fathers_info where `father_id` ='$fatherid'";
  $result = $connect->query($sql);
while($row = $result->fetch_assoc()){  
  $fatheraddress = $row['father_address'];
  $fatheroccupation = $row['father_occupation'];
  $fatherdob = $row['father_dob'];
  $fatherplaceofbirth = $row['father_place_of_birth'];
  $fathersubdivision = $row['father_subdivision'];
  $fatherphone = $row['father_phone'];
  $fatheremail = $row['father_email'];
          }

          $sql = "SELECT * FROM mothers_info where `mother_id` ='$motherid'";
          $result = $connect->query($sql);
          while($row = $result->fetch_assoc()){
            $mothername = $row['mother_name'];
            $motheroccupation = $row['mother_occupation'];
            $motherdob = $row['mother_dob'];
            $motherplaceofbirth = $row['mother_place_of_birth'];
            $mothersubdivision = $row['mother_subdivision'];
            $motheradress = $row['mother_address'];
            $motherphone = $row['mother_phone'];
            $motheremail = $row['mother_email'];
 
          }
          $sql = "SELECT * FROM midwife WHERE `application_number` = '$applicationnumber'";
          $result = $connect ->query($sql);
          while($row = $result->fetch_assoc()){
            $witnessname = $row['midwife_name'];
            $witnessid = $row['idcard_number'];
            $witnesscontact = $row['phone'];       

          }
          $sql = "SELECT * FROM location WHERE `application_number`= '$applicationnumber'";
          $result = $connect->query($sql);
          while($row = $result->fetch_assoc()){
            $region = $row['region'];
            $town = $row['town'];
          }

        }          
  

    
?>









    <div class="tab-content pt-2">

      <div class="tab-pane fade show active profile-overview" id="profile-overview">
        <h5 class="card-title">Application</h5>
        <p class="small fst-italic"></p>
        <div class="row">
          <div class="col-lg-3 col-md-4 label ">APPLICATION NUMBER</div>
          <div class="col-lg-9 col-md-8"><?php echo "$applicationnumber" ?></div>
        </div>
<br>
        <h5 class="card-title">Child information</h5>

        <div class="row">
          <div class="col-lg-3 col-md-4 label ">First name</div>
          <div class="col-lg-9 col-md-8"><?php echo $childname?></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Last name</div>
          <div class="col-lg-9 col-md-8">last name here</div>
        </div>
       <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">date of birth</div>
          <div class="col-lg-9 col-md-8"><?php echo $childdob?> </div>
        </div>
          <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Place of birth</div>
          <div class="col-lg-9 col-md-8"><?php echo  $childplaceOfBirth ?> </div>
        </div>
            <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Father's Name</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fathername ?></div>
        </div>
         <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Mother's name</div>
          <div class="col-lg-9 col-md-8"><?php echo  $mothername ?></div>
        </div>
         <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">witness name</div>
          <div class="col-lg-9 col-md-8"><?php echo  $witnessname ?></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">witness Id</div>
          <div class="col-lg-9 col-md-8"><?php echo $witnessid?></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Witness contact</div>
          <div class="col-lg-9 col-md-8"><?php echo  $witnesscontact ?></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Region</div>
          <div class="col-lg-9 col-md-8"><?php echo  $region ?></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Town</div>
          <div class="col-lg-9 col-md-8"><?php echo  $town ?></div>
        </div>

      </div>

      <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
     <!-- fathers info -->
        <!-- Profile Edit Form -->
      <!-- End Profile Edit Form -->
      <div class="tab-pane fade show active profile-overview" id="profile-overview">
        <h5 class="card-title">Father's information</h5>
       <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label "> Father Name</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fathername ?></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label "> Father's id</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatherid ?></div>
      </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Father's Occupation</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatheroccupation ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Father's DOB</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatherdob ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Place of birth</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatherplaceofbirth ?></div>
        </div>
<br>
<div class="row">
          <div class="col-lg-3 col-md-4 label">subdivision</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fathersubdivision ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Address</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatheraddress ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Phone</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatherphone ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Email</div>
          <div class="col-lg-9 col-md-8"><?php echo  $fatheremail?></div>
        </div>

      </div>

      </div>

      <div class="tab-pane fade pt-3" id="profile-settings">
<!-- mother info -->
        <!-- Settings Form -->
       <!-- End settings Form -->
       <div class="tab-pane fade show active profile-overview" id="profile-overview">   
       <h5 class="card-title">Mother's information</h5>       
        <br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label "> Mother's id</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motherid ?></div>
      </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label "> Mother's Name</div>
          <div class="col-lg-9 col-md-8"><?php echo  $mothername ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Mother's Occupation</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motheroccupation ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Mother's DOB</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motherdob ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Place of birth</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motherplaceofbirth ?></div>
        </div>
<br>
<div class="row">
          <div class="col-lg-3 col-md-4 label">Subdivision</div>
          <div class="col-lg-9 col-md-8"><?php echo  $mothersubdivision ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Address</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motheradress ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Phone</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motherphone ?></div>
        </div>
<br>
        <div class="row">
          <div class="col-lg-3 col-md-4 label">Email</div>
          <div class="col-lg-9 col-md-8"><?php echo  $motheremail ?></div>
        </div>

      </div>

      </div>
   
      <div class="tab-pane fade pt-3" id="profile-change-password">
        <!-- Change Password Form -->
        <form action="" method="post">

          <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Action</label>
            <div class="col-md-8 col-lg-9">
              <select name="status" id="" class="form-control" >
                <option value="">select action</option>
                <option value="verified">verify</option>
                <option value="rejected">reject</option>
                <option value="reviewing">reviewing</option>
              </select>
            </div>
          </div>


          <div class="row mb-3">
            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">ISSIUED BY</label>
            <div class="col-md-8 col-lg-9">
              <select name="issue" id="" class="form-control" >
                <option value="">Select ISSIUED Authority</option>
                <?php 
                  $sql = "SELECT * FROM  issue_authority";
                  $conn =  new Connection;
                  $connect = $conn->connect();
                  $result = $connect->query($sql);
                  while($row = $result->fetch_assoc()){
                    $name = $row['authority_name'];
                    $id = $row['issue_id'];
                    echo"<option value='$id'>$name</option>";
                  }?>
               
              </select>
            </div>
          </div>
              <?php
               switch($status){
                case"verified":
                echo "
                <div class='text-center'>
                <button type='submit' name='action' class='btn btn-primary' value='download' >Download</button>
                <button type='submit' name='action' class='btn btn-primary' value='print' >print</button>
              </div>
             
              
            


                ";
                break;
                case"":               
                echo "
                <div class='text-center'>
                <button type='submit' name='action' class='btn btn-primary' value='update' >submit</button>
              </div>

                ";
                break;
                case"rejected":
                  echo"                              This application was rejected ";
                  break;

               
              }
              ?>
        
        </form><!-- End Change Password Form -->

      </div>

    </div><!-- End Bordered Tabs -->

  </div>
</div>

</div>
       

      
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>BCG-SYSTEM</span></strong>. All Rights Reserved
    </div>
  
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

