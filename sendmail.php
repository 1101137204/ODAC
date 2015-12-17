<?php

header('Content-type: text/html; charset=utf-8');
try {
    if (isset($_POST["sendmember"])) {
        $sendmember = $_POST["sendmember"];
    }
    if (isset($_POST["getid"])) {
        $getid = $_POST["getid"];
    }
    include 'connectdB.php';
    $db = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT Name, Email FROM member WHERE Member_ID='" . $getid . "'";
    $stmt = $db->query($sql);
    $row = $stmt->fetch();
    $getname = $row['Name'];
    $getmail = $row['Email'];
    $db2 = new PDO($dsn, $db_user, $db_password);
    $sql2 = "SELECT Name, Email FROM member WHERE Member_ID='" . $sendmember . "'";
    $stmt2 = $db2->query($sql2);
    $row2 = $stmt2->fetch();
    $sendname = $row2['Name'];
    $sendmail = $row2['Email'];

    send($getmail, $getname, $sendmail, $sendname);
} catch (Exception $exc) {
    echo $exc->getMessage();
}

function send($getmail, $getname, $sendmail, $sendname) {
    $mailToname = $getname;   //收件者姓名
    $mailTo = $getmail;   //收件者郵件
    $mailfromname = $sendname;  //寄件者姓名
    $mailfrom = $sendmail;  //寄件者電子郵件
    $mailSubject = "確認信件";    //主旨
    $mailContent = mailText($getname, $sendname);  //內容

    $mailTo = "=?UTF-8?B?" . base64_encode($mailToname) . "?= <" . $mailTo . ">";
    $mailfrom = "=?UTF-8?B?" . base64_encode($mailfromname) . "?= <" . $mailfrom . ">";
    $mailSubject = "=?UTF-8?B?" . base64_encode($mailSubject) . "?=";  //主旨編碼成UTF-8
    if (mail($mailTo, $mailSubject, $mailContent, "Mime-Version: 1.0\nFrom:" . $mailfrom . "\nContent-Type: text/html ; charset=UTF-8")) {
        echo "success"; //寄信成功就會顯示的提示訊息
    } else {
        echo "error"; //寄信失敗顯示的錯誤訊息
    }
}
function mailText($getname, $sendname) {
    $chklink = "<a href=http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/check.php>"
            . "http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/checkmail.php</a>";
    $message = "";
    $message .="***************************************************<br>";
    $message .="請注意︰此郵件是系統自動傳送，請勿直接回覆此郵件。 <br>";
    $message .="***************************************************<br>";
    $message .="<br>";
    $message .="親愛的 " . $getname . " 您好：<br>";
    $message .="<br>";
    $message .="這封信是由使用者 " . $sendname . " 所發出，用以做確認動作<br>";
    $message .="<br>";
    $message .="點選或複製以下的連結至瀏覽器進行確認。<br>";
    $message .="<br>";
    $message .="$chklink<br>";
    $message .="<br>";
    return @$message;
}
?>