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
    $inputpath = $_POST['Path'];
    $inputstart = $_POST['Start'];
    $inputend = $_POST['To'];
    $Memberid = $_POST['Memberid'];
    $Publish_Time = date('Y-m-d H:i:s');

    $North_Delivery_Case_Status = "等待媒合";
    $stmt = $db->prepare("INSERT INTO north_delivery_case(Train, Member_ID, Starts, Tos, North_Delivery_Case_Status, Publish_Time) VALUES(?,?,?,?,?,?)");
    $count = $stmt->execute(array($inputcarnum, $Memberid, $inputstart, $inputend, $North_Delivery_Case_Status, $Publish_Time));

    if ($count != 1) {
        echo 'UnSuccess! 請重新刊登!';
    } else {
        $Q = "SELECT max(North_Delivery_Case_ID) FROM north_delivery_case";
        $stmt = $db->query("$Q");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $North_Delivery_Case_ID = $row['max(North_Delivery_Case_ID)'];
        }
        echo $North_Delivery_Case_ID;
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>