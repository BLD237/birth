<?php
if(!session_start()){
  session_start();
}
if($_SESSION['bcglevel']==1){
include"admin.php";
}else if($_SESSION['bcglevel']==2){
  include "user.php";
}else{
  header("LOCATION:  /birth/index.php?reference=notlogin");
}

?>



