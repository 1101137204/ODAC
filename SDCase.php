<?php

header('Content-type: text/html; charset=utf-8');
session_start();
if (isset($_SESSION["inputEmail"]) && $_SESSION["start"] === true) {
    $Memberid = $_SESSION["Member_ID"];
} else {
    session_unset();
    session_destroy();
    header("location:index.php");
}
try {
    include 'connectdB.php';
    $db = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT G.South_Delivery_Case_ID,G.Train,G.`Starts`,G.Tos,G.Publish_Time,G.South_Delivery_Case_Status "
            . "FROM ( "
            . "SELECT C.Member_ID,C.South_Delivery_Case_ID,C.Train,C.`Starts`,C.Tos,C.Publish_Time,C.South_Delivery_Case_Status "
            . "FROM south_delivery_case AS C,member AS D "
            . "WHERE C.Member_ID=D.Member_ID "
            . ")AS G "
            . "WHERE G.Member_ID='" . $Memberid . "'";
    $stmt = $db->query($sql);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $data [] = array(
            'South_Delivery_Case_ID' => $row ['South_Delivery_Case_ID'],
            'Train' => $row ['Train'],
            'Starts' => urlencode($row ['Starts']),
            'Tos' => urlencode($row ['Tos']),
            'South_Delivery_Case_Status' => urlencode($row ['South_Delivery_Case_Status']),
            'Publish_Time' => $row ['Publish_Time']
        );
    }
    if (empty($data)) {
        $output = array(
            'data' => 'No Result !',
            'message' => 'Access',
            'success' => true,
            'count' => 0
        );
        $json = urldecode(json_encode($output));
        echo $json;
    } else {
        $output = array(
            'data' => $data,
            'message' => 'Access',
            'success' => true,
            'count' => count($data)
        );
        $json = urldecode(json_encode($output));
        echo $json;
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>