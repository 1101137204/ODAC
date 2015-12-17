<?php

try {
    $db_host = 'www.db4free.net:3306';
    $db_name = 'odac';
    $db_user = 'odac2015';
    $str='b2RhYzIwMTU=';
    $db_password = base64_decode($str);
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>