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
        <title>註冊</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.minlogin.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="js/ie-emulation-modes-warning.js"></script>
        <script src="js/jquery-1.11.3.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            $(function () {
                $("#signup").attr("disabled", true);
                $("#checkbox").change(function () {
                    if ($("#checkbox").prop('checked') == true) {
                        $("#signup").attr("disabled", false);
                    }else{
                        $("#signup").attr("disabled", true);
                    }
                });
            });
        </script>
    </head>

    <body>
        <div class="container">
            <form action="insertmember.php" method="POST" class="form-signin">
                <h2 class="form-signin-heading" style="text-align: center">註冊</h2>
                <div>
                    <label class="sr-only">身分證</label>
                    <input type="text" id="identity" name="identity" class="form-control" placeholder="身分證" required required autofocus/>
                </div>
                <div>
                    <label class="sr-only">姓名</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="姓名(請使用真實姓名)" required/>
                </div>
                <div>
                    <label class="sr-only">手機</label>
                    <input type="tel" id="name" name="phone" class="form-control" placeholder="手機" required/>
                </div>
                <div>
                    <label for="inputEmail" class="sr-only">信箱</label>
                    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="信箱" required/> 
                </div>
                <div>
                    <label for="inputPassword" class="sr-only">密碼</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="密碼" required/>
                    <input type="password" id="inputPassword2" name="inputPassword2" class="form-control" placeholder="密碼確認" required/>
                </div>
                <div>
                    <div style="text-align: center"><input type="checkbox" id="checkbox"><a href="warning.php">請確認同意會員使用規範</a></div><br/>
                    <button class="btn btn-lg btn-danger btn-block" type="submit" id="signup">註冊</button>
                    <a class="btn btn-lg btn-primary btn-block" role="button" href="index.php">首頁</a>
                    <input type="hidden" name="refer" value="refer" >
                </div>
            </form>

        </div> <!-- /container -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
