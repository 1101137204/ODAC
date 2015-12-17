<?php

header('Content-type: text/html; charset=utf-8');
try {
    include 'connectdB.php';
    $uid = htmlspecialchars(@$_GET['uid']);
    $ups = base64_encode(htmlspecialchars(@$_GET['ups']));
    $name = htmlspecialchars(@$_GET['name']);

    if (!empty($uid) && !empty($ups) && !empty($name)) {
        $db = new PDO($dsn, $db_user, $db_password);
        $sql = "SELECT Member_ID, Identity, Name, Phone, Email, Password, Active 
                FROM member 
                WHERE Email='" . $uid . "' AND Password='" . base64_decode($ups) . "' AND Name='" . $name . "'";
        $stmt = $db->query($sql);
        $row = $stmt->fetch();
        if ($row['Active'] == true) {
            echo '帳號已認證';
            header("refresh:1; url=index.php");
        } else if (!empty($row)) {
            $sql2 = "UPDATE member SET Active = '1' 
                    WHERE Email='" . $uid . "' AND Password='" . base64_decode($ups) . "'AND Name='" . $name . "'";
            $count = $db->exec($sql2);
            echo '帳號認證成功!!';
            header("refresh:1; url=index.php");
        } else {
            echo '查無帳號';
        }
    } else {
        echo '帳號尚未認證!!';
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>