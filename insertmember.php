<?php

header('Content-type: text/html; charset=utf-8');
	
try {
    include 'connectdB.php';
    $errormsg = null;
    $identity = htmlspecialchars(@$_POST["identity"]);
    $name = htmlspecialchars(@$_POST['name']);
    $phone = htmlspecialchars(@$_POST['phone']);
    $inputEmail = htmlspecialchars(@$_POST['inputEmail']);
    $inputPassword = htmlspecialchars(@$_POST['inputPassword']);
    $inputPassword2 = htmlspecialchars(@$_POST['inputPassword2']);
    if (!@preg_match('/^[A-Za-z]{1}[1-2]{1}[0-9]{8}$/', $identity)) {//判斷身分證格式
        $errormsg.='身分證格式錯誤</br>';
    } else {
        $db = new PDO($dsn, $db_user, $db_password);
        $sql = "SELECT Member_ID, Identity, Name, Phone, Email, Password "
                . "FROM member "
                . "WHERE Identity='" . $identity . "'"; //判斷此身分證是否重複
        $stmt = $db->query($sql);
        $row = $stmt->fetch();
        if (!empty($row)) {
            $errormsg.='此身分證已被註冊</br>';
        }
    }
    if (mb_strlen($name, 'utf8') > 10) {
        $errormsg.='姓名超過10個字</br>';
    } 
    if (!@preg_match('/^[09]{2}[0-9]{8}$/', $phone)) {//判斷手機格式
        $errormsg.='手機格式錯誤</br>';
    }
    //if (!@preg_match('/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/', $inputEmail)) {//判斷email格式
    if (!@preg_match('/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[edu.tw]+$/', $inputEmail)) {//判斷email格式
        $errormsg.='請使用學校Email</br>';
    } else {
        $db2 = new PDO($dsn, $db_user, $db_password);
        $sql2 = "SELECT Member_ID, Identity, Name, Phone, Email, Password "
                . "FROM member "
                . "WHERE Email='" . $inputEmail . "'"; //判斷此身分證是否重複
        $stmt = $db2->query($sql2);
        $row = $stmt->fetch();
        if (!empty($row)) {
            $errormsg.='Email已被註冊</br>';
        }
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
        header("refresh:3; url=signup.php");
    } else {
        try {
            $db3 = new PDO($dsn, $db_user, $db_password);
            $sql3 = "INSERT INTO member (Identity, Name,Phone, Email, Password)"
                    . " VALUES (:Identity,:Name,:Phone,:Email,:Password);";
            $stmt = $db3->prepare($sql3);
            $count = $stmt->execute(array(
                ":Identity" => $identity,
                ":Name" => $name,
                ":Phone" => $phone,
                ":Email" => $inputEmail,
                ":Password" => $inputPassword
            ));
            if ($count) {
                echo "註冊成功</br>";
                sendMail($inputEmail, $name, $inputPassword);
                header("refresh:1; url=index.php");
            } else {
                echo "註冊失敗</br>";
                header("refresh:1; url=signup.php");
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}

function sendMail($inputEmail, $name, $inputPassword) {
    $mailToname = $name;   //收件者
    $mailTo = $inputEmail;   //收件者
    $mailfromname = "Thunder點對點";  //寄件者姓名
    $mailfrom = "From:Thunder@gmail.com";  //寄件者電子郵件
    $mailSubject = "Thunder點對點會員註冊";    //主旨
    $mailContent = mailText($inputEmail, $name, $inputPassword);  //內容

    $mailTo = "=?UTF-8?B?" . base64_encode($mailToname) . "?= <" . $mailTo . ">";
    $mailfrom = "=?UTF-8?B?" . base64_encode($mailfromname) . "?= <" . $mailfrom . ">";
    $mailSubject = "=?UTF-8?B?" . base64_encode($mailSubject) . "?=";  //主旨編碼成UTF-8
    if (mail($mailTo, $mailSubject, $mailContent, "Mime-Version: 1.0\nFrom:" . $mailfrom . "\nContent-Type: text/html ; charset=UTF-8")) {
        echo "<b>請至信箱完成認證！！ </b></br>"; //寄信成功就會顯示的提示訊息
    } else {
        echo "<b>信件發送失敗！</b></br>"; //寄信失敗顯示的錯誤訊息
    }
}

function mailText($inputEmail, $name, $inputPassword) {
    $chklink = "<a href=http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/checkmail.php?uid=" . $inputEmail . "&ups=" . $inputPassword . "&name=" . $name . ">"
            . "http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/checkmail.php?uid=" . $inputEmail . "&ups=" . $inputPassword . "&name=" . $name . "</a>";
    $message = "";
    $message .="***************************************************<br>";
    $message .="請注意︰此郵件是系統自動傳送，請勿直接回覆此郵件。 <br>";
    $message .="***************************************************<br>";
    $message .="<br>";
    $message .="親愛的 " . $name . " 您好：<br>";
    $message .="<br>";
    $message .="這封認證信是由『 ( <a href=http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/index.php>Thunder點對點</a> )』發出，用以確認閣下身份。<br>";
    $message .="<br>";
    $message .="您所註冊的會員資料如下：<br>";
    $message .="<br>";
    $message .="帳號：" . $inputEmail . "<br>";
    $message .="密碼：" . $inputPassword . "<br>";
    $message .="<br>";
    $message .="點選或複製以下的連結至瀏覽器進行快速認證。<br>";
    $message .="<br>";
    $message .="$chklink<br>";
    $message .="<br>";
    return @$message;
}

?>