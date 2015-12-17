<?php

header('Content-type: text/html; charset=utf-8');

try {
    include 'connectdB.php';
    $errormsg = null;
    $memberid = htmlspecialchars(@$_POST["Member_ID"]);
    $identity = htmlspecialchars(@$_POST["identity"]);
    $name = htmlspecialchars(@$_POST['name']);
    $phone = htmlspecialchars(@$_POST['phone']);
    $inputEmail = htmlspecialchars(@$_POST['inputEmail']);
    $inputPassword = htmlspecialchars(@$_POST['inputPassword']);
    $inputPassword2 = htmlspecialchars(@$_POST['inputPassword2']);
    if (!@preg_match('/^[A-Za-z]{1}[1-2]{1}[0-9]{8}$/', $identity)) {//判斷身分證格式
        $errormsg.='身分證格式錯誤</br>';
    }
    if (mb_strlen($name, 'utf8') > 10) {
        $errormsg.='姓名超過10個字</br>';
    }
    if (!@preg_match('/^[09]{2}[0-9]{8}$/', $phone)) {//判斷手機格式
        $errormsg.='手機格式錯誤</br>';
    }
    if (!@preg_match('/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[edu.tw]+$/', $inputEmail)) {//判斷email格式
        $errormsg.='請使用學校Email</br>';
    }
    if (!@preg_match('/^[A-Za-z0-9]{8,}$/', $inputPassword)) {//判斷密碼格式
        $errormsg.='密碼需8個字</br>';
    } else {
        if ($inputPassword != $inputPassword2) {
            $errormsg.= '密碼輸入不同</br>';
        }
    }
    if ($errormsg != null) {
        echo '錯誤訊息：</br></br><b>' . $errormsg . '</b></br>3秒後重新整理.....';
        header("refresh:3; url=member.php");
    } else {
        try {
            $db3 = new PDO($dsn, $db_user, $db_password);
            $sql2 = "UPDATE member "
                    . "SET Identity =?, Name =?, Phone =?, Email =?, Password =?"
                    . "WHERE Member_ID =?";
            $stmt = $db3->prepare($sql2);
            $count = $stmt->execute(array($identity, $name, $phone, $inputEmail, $inputPassword, $memberid));


            if ($count > 0) {
                echo "修改成功</br></br>"
                . "<b>請重新登入!!!</b>";
                session_start(); 
                session_unset();
                session_destroy();
                header("refresh:1; url=index.php");
            } else {
                echo "修改失敗</br>";
                header("refresh:1; url=member.php");
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>