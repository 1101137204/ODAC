<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if (isset($_SESSION["inputEmail"]) && $_SESSION["start"] === true) {
    $loginuser = $_SESSION["inputEmail"];
    $Memberid = $_SESSION["Member_ID"];
    $Name = $_SESSION["Name"];

    include 'connectdB.php';
    $db = new PDO($dsn, $db_user, $db_password);

    $sql = "SELECT Member_ID,Identity,Name,Phone,Email,Password,Active "
            . "FROM member "
            . "WHERE Email='" . $loginuser . "' AND Name='" . $Name . "' AND Member_ID='" . $Memberid . "'";
    $stmt = $db->query($sql);
    $row = $stmt->fetch();
} else {
    session_unset();
    session_destroy();
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>會員資料</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.minlogin.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="container">
            <form action="memberupdate.php" method="POST" class="form-signin">
                <h2 class="form-signin-heading" style="text-align: center">會員資料</h2>
                <div>
                    <input type="hidden" id="Member_ID" name="Member_ID" value="<?php echo $row['Member_ID'] ?>"/>
                </div>
                <div>
                    <label class="sr-only">身分證</label>
                    <input type="text" id="identity" name="identity" class="form-control" value="<?php echo $row['Identity'] ?>" placeholder="身分證" required required autofocus/>
                </div>
                <div>
                    <label class="sr-only">姓名</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['Name'] ?>" placeholder="姓名" required/>
                </div>
                <div>
                    <label class="sr-only">手機</label>
                    <input type="tel" id="name" name="phone" class="form-control" value="<?php echo $row['Phone'] ?>" placeholder="手機" required/>
                </div>
                <div>
                    <label for="inputEmail" class="sr-only">信箱</label>
                    <input type="email" id="inputEmail" name="inputEmail" value="<?php echo $row['Email'] ?>" class="form-control" placeholder="信箱" required/> 
                </div>
                <div>
                    <label for="inputPassword" class="sr-only">密碼</label>
                    <input type="text" id="inputPasswordpassword" name="inputPassword" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="密碼" required/>
                    <input type="text" id="inputPassword2" name="inputPassword2" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="密碼確認" required/>
                </div>
                <div>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">確認</button>
                    <a class="btn btn-lg btn-primary btn-block" role="button" href="home.php">首頁</a>
                    <input type="hidden" name="refer" value="refer" >
                </div>
            </form>

        </div> <!-- /container -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
