<?php

date_default_timezone_set('Asia/Taipei');
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: *');
header('X-Requested-With:*');
header('Content-type: text/html; charset=utf-8');


try {
    include 'connectdB.php';
    $db = new PDO($dsn, $db_user, $db_password);
    $inputcarnum = $_POST['Carnum'];
    $sql = "SELECT Train,Taipei,Banqiao,Taoyuan,Hsinchu,Miaoli,Taichung,Changhua,Yunlin,Chiayi,Tainan,Zuoying "
            . "FROM south "
            . "WHERE Train='" . $inputcarnum . "'";
    $stmt = $db->query($sql);
    $row = $stmt->fetch();
    if (!empty($row)) {
        echo $row['Train'] . " " . $row['Taipei'] . " " . $row['Banqiao'] . " " . $row['Taoyuan'] . " " . $row['Hsinchu'] . " " . $row['Miaoli'] . " " . $row['Taichung'] . " " . $row['Changhua'] . " " . $row['Yunlin'] . " " . $row['Chiayi'] . " " . $row['Tainan'] . " " . $row['Zuoying'];
    } else {
        echo 'error';
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>