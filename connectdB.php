<?php

try {
    $db_host = 'www.db4free.net:3306';
    $db_name = 'odac';
    $db_user = 'odac2015';
    $db_password = 'odac2015';
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>