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
    $sql = "SELECT F.South_Established_Case_ID,F.`Name` AS 'sender',C.Train,C.`Name` AS 'Postman' ,C.`Starts`,C.Tos,F.South_Established_CaseStatus
FROM(
SELECT A.Member_ID,A.South_Delivery_Case_ID,B.`Name`,A.Train,A.`Starts`,A.Tos,A.South_Delivery_Case_Status
FROM south_delivery_case AS A,member AS B
WHERE A.Member_ID=B.Member_ID
)AS C,
(
SELECT D.Member_ID,D.South_Established_Case_ID,D.South_Delivery_Case_ID,E.`Name`,D.South_Established_CaseStatus
FROM south_established_case AS D,member AS E
WHERE D.Member_ID=E.Member_ID
)AS F
WHERE C.South_Delivery_Case_ID=F.South_Delivery_Case_ID
AND F.Member_ID='".$Memberid."'
UNION
SELECT F.South_Established_Case_ID,F.`Name` AS 'sender',C.Train,C.`Name` AS 'Postman' ,C.`Starts`,C.Tos,F.South_Established_CaseStatus
FROM(
SELECT A.Member_ID,A.South_Delivery_Case_ID,B.`Name`,A.Train,A.`Starts`,A.Tos,A.South_Delivery_Case_Status
FROM south_delivery_case AS A,member AS B
WHERE A.Member_ID=B.Member_ID
)AS C,
(
SELECT D.Member_ID,D.South_Established_Case_ID,D.South_Delivery_Case_ID,E.`Name`,D.South_Established_CaseStatus
FROM south_established_case AS D,member AS E
WHERE D.Member_ID=E.Member_ID
)AS F
WHERE C.South_Delivery_Case_ID=F.South_Delivery_Case_ID
AND C.Member_ID='".$Memberid."'";
    $stmt = $db->query($sql);

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $data [] = array(
            'South_Established_Case_ID' => $row ['South_Established_Case_ID'],
            'Train' => $row ['Train'],
            'Sender'=>$row['sender'],
            'Postman' => urlencode($row ['Postman']),
            'Starts' => urlencode($row ['Starts']),
            'Tos' => urlencode($row ['Tos']),
            'South_Established_CaseStatus' => urlencode($row ['South_Established_CaseStatus']),
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
    echo $exc->getTraceAsString();
}
?>