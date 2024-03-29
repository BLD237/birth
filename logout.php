<?php
session_start();
session_destroy();
header("LOCATION: index1.php");
exit();