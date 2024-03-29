<?php
function generateid(){
    return mt_rand(100000000, 999999999);

}
$idcard = generateid();
echo"unique id: $idcard";