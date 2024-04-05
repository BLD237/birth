<?php
$id = $_GET['id'];
include 'class.php';
$sql = "DELETE FROM users WHERE id= $id";
$conn = new Connection();
$connect = $conn->connect();
$result = $connect->query($sql);
if($result){
    header("LOCATION: manageusers.php?reference=deleted");
}

