<?php

header('Content-type: text/html; charset=utf-8');
try {

    include 'connectdB.php';
    $inputEmail = htmlspecialchars(@$_POST['inputEmail']);
    $inputPassword = htmlspecialchars(@$_POST['inputPassword']);
    $db = new PDO($dsn, $db_user, $db_password);
/*
    $sql = "SELECT Member_ID,Identity,Name,Phone,Email,Password,Active 
            FROM member 
            WHERE Email='" . $inputEmail . "' AND Password='" . $inputPassword . "'";
    $stmt = $db->query($sql);
    */
    $sql = "SELECT Member_ID,Identity,Name,Phone,Email,Password,Active 
            FROM member 
            WHERE Email =:username and Password =:password";
    $query = $db->prepare($sql);
    $query->execute(array(':username' => $inputEmail,':password' => $inputPassword));
    
    $row = $query->fetch();
    if (!empty($row)) {
        if ($row['Active']) {
            session_start();
            $_SESSION['Member_ID'] = $row['Member_ID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['inputEmail'] = $inputEmail;
            $_SESSION['start'] = true;
            header("refresh:0; url=home.php");
        } else {
            echo '帳號尚未認證! 請先認證在登入!!';
            header("refresh:1; url=index.php");
        }
    } else {
        echo '輸入錯誤!!!';
        header("refresh:1; url=login.php");
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>