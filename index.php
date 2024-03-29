<?php
if(!$_GET){
    include"index1.php";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['reference']) && !empty($_GET['reference'])) {
        $action = $_GET['reference'];
        switch($action){
            case 'login':
                include"login/index.php";
                break;
            case 'signup':
                include"signup/index.php";
                break;    
                case 'notlogin':
                    include"index1.php";
                    echo"<script>alert('Login Required to acceess this page')</script>";
                    break;     
        }
    }
}