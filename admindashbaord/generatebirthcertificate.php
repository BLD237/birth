<?php
class generatebirthcertificate{
  public function generate($childfname, $childlname, $childdob, $childplaceOfbirth, $childgender, $fathername, $fatherplaceofbirth, $fatherdob, $fatheraddress,  $fatheroccupation, $mothername, $motherplaceofbirth, $motherdob, $motheraddress, $motheroccupation, $issuedate, $witnesname, $athurityname){
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
                    Surname of the child</span><h>$childfname</h><hr>
                <span>Prénom(s) de l'enfant(given name)<br>
                    Given name(s) of the child</span><h>$childlname</h><hr>
                <span>Le-On the(DOB)</span><h>$childdob</h><hr>
                <span>Est né à -Was born in/at(city)</span><h>$childplaceOfbirth</h><hr>
                <span>De Sexe-Sex(sex) </span><h>$childgender</h><hr>
                <span>De-Of(father's name) </span><h>$fathername</h><hr>
                <span>Né à-Born in/at(father's city)</span><h>$fatherplaceofbirth</h><hr>
                <span>Le-On(father's DOB) </span><h>$fatherdob</h><hr>
                <span>Domicilié à-Residing at(father's address) </span><h>$fatheraddress</h><hr>
                <span>Profession-Occupation(father's occupation) </span><h>$fatheroccupation</h><hr>
                <span>Et de-And of(mother's name) </span><h>$mothername</h><hr>
                <span>Né à-Born in/at(mother's city) </span><h>$motherplaceofbirth</h><hr>
                <span>Le-On(mother's DOB)</span><h>$motherdob</h><hr>
                <span>Domicilié à-Residing at(mother's address)</span><h>$motheraddress</h><hr>
                <span>Profession-Occupation(mother's occupation)</span><h>$motheroccupation</h><hr>
                <span>Dressé le(date of verification)<h>$issuedate</h><hr>
                 Drawn up on</span><br>
                <span>Sur la decleration de________________________________________________</span><br>
                <span>In accordance with the decleration of_____________________ .$witnesname.______________________</span><br>
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
                ___________ .$athurityname.____________</div>
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
  