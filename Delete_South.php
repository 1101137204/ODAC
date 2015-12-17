<?php

date_default_timezone_set('Asia/Taipei');
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: *');
header('X-Requested-With:*');
header('Content-type: text/html; charset=utf-8');


try {
    include 'connectdB.php';
    $db = new PDO($dsn, $db_user, $db_password);
    $inputdel = $_POST['Del'];
    $Member_ID = $_POST['Member'];

    $db = initDB();
    $sql = "SELECT * "
            . "FROM south_delivery_case "
            . "WHERE South_Delivery_Case_ID='" . $inputdel . "'AND Member_ID='" . $Member_ID . "'";
    $stmt = $db->query($sql);
    $row = $stmt->fetch();
    if (!empty($row)) {
        echo $row['South_Delivery_Case_ID'] . " " . $row['Train'] . " " . $row['Starts'] . " " . $row['Tos'];
    } else {
        echo 'error';
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>