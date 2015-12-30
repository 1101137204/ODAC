<?php
session_start();
if (isset($_SESSION["inputEmail"]) && $_SESSION["start"] === true) {
    $loginuser = $_SESSION["inputEmail"];
    $Memberid = $_SESSION["Member_ID"];
    $Name = $_SESSION["Name"];
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>THUNDER點對點</title>
        <meta name="description" content="THUNDER點對點_悲慘專題第四集，馬的希望不要有第五集">
        <meta name="author" content="THUNDER點對點">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-select.css" rel="stylesheet">
        <link rel="manifest" href="/android-chrome-manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link href='http://fonts.googleapis.com/css?family=Montserrat|Varela+Round' rel='stylesheet' type='text/css'>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/style.min.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <script src="js/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="css/sweetalert2.css">
        <script src="js/pace.js"></script>  
        <link href="css/pace-theme-flash.min.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <script src="js/jquery-1.11.3.js"></script>  
        <script src="js/bootstrap.min.js"></script>  <!--   bootstrap.min.js一定要放在jquery-ui.js上面    -->
        <script src="js/jquery-ui.js"></script>    <!--   bootstrap.min.js一定要放在jquery-ui.js上面    -->
        <script src="js/jquery-ui.min.js"></script>  <!--   bootstrap.min.js一定要放在jquery-ui.js上面    -->   
        <script type="text/javascript">
            function deletecheck() {
                if (document.getElementById("inputdel").value != "") {
                    if (document.getElementById("inputdelpath").value == "south") {
                        var Member_ID = "<?php echo $Memberid; ?>";
                        $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/Delete_South.php",
                                {Del: document.getElementById("inputdel").value,
                                 Member: Member_ID},
                        function (data, status) {
                            var newdata = data.split(" ");
                            if (data != 'error') {
                                swal({
                                    type: "warning",
                                    title: "刊登編號:" + newdata[0],
                                    text: "車次:" + newdata[1] + "，起點站：" + newdata[2] + "，終點站：" + newdata[3] + "。",
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "確定刪除",
                                    cancelButtonText: "取消",
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        var Member_ID = "<?php echo $Memberid; ?>";
                                        $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/Confirm_Del_South.php",
                                                {Del: document.getElementById("inputdel").value,
                                                 Member: Member_ID},
                                        function (data, status) {
                                            if (status == 'success') {swal("完成", "已刪除刊登", "success");}
                                            else {swal("取消", "已取消刪除", "error");}
                                        });
                                    } else {swal("取消", "已取消刪除", "error");}
                                });
                            }else {swal("錯誤", "查詢失敗，請再次確認您的刊登編號", "error");}
                        });
                    } else{
                        var Member_ID = "<?php echo $Memberid; ?>";
                        $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/Delete_North.php",
                                {Del: document.getElementById("inputdel").value,
                                 Member: Member_ID},
                        function (data, status)
                        {var newdata = data.split(" ");
                         if (data != 'error') {
                                swal({
                                    title: "刊登編號:" + newdata[0],
                                    text: "車次:" + newdata[1] + "，起點站：" + newdata[2] + "，終點站：" + newdata[3] + "。",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "確定刪除",
                                    cancelButtonText: "取消",
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        var Member_ID = "<?php echo $Memberid; ?>";
                                        $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/Confirm_Del_North.php",
                                                {Del: document.getElementById("inputdel").value,
                                                 Member: Member_ID},
                                        function (data, status)
                                        {if (status == 'success') {swal("完成", "已刪除刊登", "success");}
                                            else {swal("取消", "已取消刪除", "error");}
                                        });
                                    } else {swal("取消", "已取消刪除", "error");}
                                });
                            }else {swal("錯誤", "查詢失敗，請再次確認您的刊登車次", "error");}
                        });
                    }
                }
                else {swal("錯誤", "請輸入刊登編號", "error");}
            }
            function nullcheck() {
                if (document.getElementById("estation").innerHTML != document.getElementById("sstation").innerHTML) {
                    if (document.getElementById("estation").innerHTML != "" && document.getElementById("sstation").innerHTML != "") {
                        var Member_ID = "<?php echo $Memberid; ?>";
                        if (document.getElementById("inputpath").value == "south")
                        {
                            $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/Publish_South.php",
                                    {
                                        Carnum: document.getElementById("inputcarnum").value,
                                        Path: document.getElementById("inputpath").value,
                                        Start: document.getElementById("sstation").innerHTML,
                                        To: document.getElementById("estation").innerHTML,
                                        Memberid: Member_ID
                                    },
                            function (data, status)
                            {
                                if (status == 'success') {
                                    swal("成功", "恭喜刊登成功，您的刊登編號為：" + data, "success");
                                    $('.sendbutton').addClass('hide');
                                }
                                else {
                                    swal("錯誤", "刊登失敗，請再次確認", "error");
                                }
                            });
                        } else
                        {
                            $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/Publish_North.php",
                                    {
                                        Carnum: document.getElementById("inputcarnum").value,
                                        Path: document.getElementById("inputpath").value,
                                        Start: document.getElementById("sstation").innerHTML,
                                        To: document.getElementById("estation").innerHTML,
                                        Memberid: Member_ID
                                    },
                            function (data, status)
                            {
                                if (status == 'success') {
                                    swal("成功", "恭喜刊登成功，您的刊登編號為：" + data, "success");
                                    $('.sendbutton').addClass('hide');
                                }
                                else {
                                    swal("錯誤", "刊登失敗，請再次確認", "error");
                                }
                            });
                        }
                    }
                    else
                    {
                        swal("錯誤", "請輸入起點站或終點站", "error");
                    }
                }
                else
                {
                    swal("錯誤", "起點站不可等於終點站", "error");
                }

            }
            function showtime() {
                var carnum = document.getElementById("inputcarnum").value;  //車次
                var path = document.getElementById("inputpath").value;      //南下or北上
                if (document.getElementById("inputcarnum").value != "")
                {
                    if (document.getElementById("inputpath").value == "south") {
                        $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC2/ShowTime_South.php",
                                {
                                    Carnum: document.getElementById("inputcarnum").value,
                                    Path: document.getElementById("inputpath").value,
                                },
                                function (data, status)
                                {
                                    if (data != 'error') {
                                        var newdata = data.split(" ");
                                        var enddata = new Array();
                                        for (i = 1; i <= 11; i++)
                                        {
                                            enddata[i] = newdata[i].slice(0, 5);
                                            if (enddata[i] == "00:00")
                                            {
                                                enddata[i] = "-";

                                            }
                                            else
                                            {
                                                $('.s' + i).removeClass('hide');
                                                $('.e' + i).removeClass('hide');
                                                $('.e' + i).addClass('disabled').attr('disabled', true);
                                            }
                                        }
                                        document.getElementById("carnum").innerHTML = newdata[0];
                                        document.getElementById("Taipei").innerHTML = enddata[1];
                                        document.getElementById("Banqiao").innerHTML = enddata[2];
                                        document.getElementById("Taoyuan").innerHTML = enddata[3];
                                        document.getElementById("Hsinchu").innerHTML = enddata[4];
                                        document.getElementById("Miaoli").innerHTML = enddata[5];//苗栗
                                        document.getElementById("Taichung").innerHTML = enddata[6];
                                        document.getElementById("Changhua").innerHTML = enddata[7];//彰化
                                        document.getElementById("Yunlin").innerHTML = enddata[8];//雲林
                                        document.getElementById("Chiayi").innerHTML = enddata[9];
                                        document.getElementById("Tainan").innerHTML = enddata[10];
                                        document.getElementById("Zuoying").innerHTML = enddata[11];
                                        $('.showtimer').removeClass('hide');
                                        $('.inputcarnum').addClass('disabled').attr('disabled', true);
                                        $('.inputpath').addClass('disabled').attr('disabled', true);
                                        $('.research').removeClass('hide');
                                        $('.search').addClass('hide');
                                        $('.sendbutton').removeClass('hide');
                                    }
                                    else
                                    {
                                        $('.sendbutton').addClass('hide');
                                        swal("錯誤", "請確認車次或方向是否輸入正確", "error");

                                    }
                                });
                    }
                    else
                    {
                        $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC2/ShowTime_North.php",
                                {
                                    Carnum: document.getElementById("inputcarnum").value,
                                    Path: document.getElementById("inputpath").value,
                                },
                                function (data, status)
                                {
                                    if (data != 'error') {
                                        var newdata = data.split(" ");
                                        var enddata = new Array();
                                        for (i = 1; i <= 11; i++)
                                        {
                                            enddata[i] = newdata[i].slice(0, 5);
                                            if (enddata[i] == "00:00")
                                            {
                                                enddata[i] = "-";
                                            }
                                            else
                                            {
                                                $('.s' + i).removeClass('hide');
                                                $('.e' + i).removeClass('hide');
                                                $('.e' + i).addClass('disabled').attr('disabled', true);
                                            }
                                        }
                                        document.getElementById("carnum").innerHTML = newdata[0];
                                        document.getElementById("Taipei").innerHTML = enddata[1];
                                        document.getElementById("Banqiao").innerHTML = enddata[2];
                                        document.getElementById("Taoyuan").innerHTML = enddata[3];
                                        document.getElementById("Hsinchu").innerHTML = enddata[4];
                                        document.getElementById("Miaoli").innerHTML = enddata[5];//苗栗
                                        document.getElementById("Taichung").innerHTML = enddata[6];
                                        document.getElementById("Changhua").innerHTML = enddata[7];//彰化
                                        document.getElementById("Yunlin").innerHTML = enddata[8];//雲林
                                        document.getElementById("Chiayi").innerHTML = enddata[9];
                                        document.getElementById("Tainan").innerHTML = enddata[10];
                                        document.getElementById("Zuoying").innerHTML = enddata[11];

                                        $('.showtimer').removeClass('hide');
                                        $('.inputcarnum').addClass('disabled').attr('disabled', true);
                                        $('.inputpath').addClass('disabled').attr('disabled', true);
                                        $('.research').removeClass('hide');
                                        $('.search').addClass('hide');
                                        $('.sendbutton').removeClass('hide');
                                    }
                                    else {
                                        $('.sendbutton').addClass('hide');
                                        swal("錯誤", "請確認車次或方向是否輸入正確", "error");
                                    }
                                });
                    }
                }
                else
                {swal("錯誤", "請輸入車次！", "error");}
            }
            function research() {
                $('.showtimer').addClass('hide');
                $('.inputcarnum').addClass('disabled').attr('disabled', false);
                $('.inputpath').addClass('disabled').attr('disabled', false);
                $('.research').addClass('hide');
                $('.search').removeClass('hide');
                $('.sendbutton').addClass('hide');
                document.getElementById("sstation").innerHTML = "";
                document.getElementById("estation").innerHTML = "";
                for (z = 1; z <= 11; z++) {
                    $('.s' + z).addClass('hide');
                    $('.e' + z).addClass('hide');
                }  //重新查詢
            }
            function startstation(start_id) {
                $('.w').removeClass('disabled').attr('disabled', false);
                var getstartstation = document.getElementById("str").getElementsByClassName("q");
                for (i = 0; i <= 10; i++) {
                    if (start_id != getstartstation[i].id)
                    {$('.s' + (i + 1)).addClass('hide');}
                    else {
                        document.getElementById("sstation").innerHTML = start_id;
                        $('.e' + (i + 1)).addClass('hide');
                        if (document.getElementById("inputpath").value == "south")
                        {
                            var x = i + 1;
                            for (y = 0; y < x; y++) {
                                $('.e' + (y + 1)).addClass('hide');
                            }
                        }
                        else {
                            var x = i + 1;
                            for (y = 11; y >= x; y--) {
                                $('.e' + (y + 1)).addClass('hide');
                            }
                        }
                    }
                }
            }
            function endstation(end_id) {
                var test = document.getElementById("end").getElementsByClassName("w");
                for (i = 0; i <= 10; i++) {
                    if (end_id != test[i].id) {$('.e' + (i + 1)).addClass('hide');}
                    else {document.getElementById("estation").innerHTML = end_id;}
                }
            }
            function Nor_record() {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/NDCase.php",
                        {whatever: "qq"},
                function (data, status) {
                    if (data.count != 0) {
                        $('#shownorrecord tbody').empty();
                        $.each(data.data, function (index, jsonData) {
                            var newRowContent =
                                    "<tr>" +
                                    "<td>" + jsonData.North_Delivery_Case_ID + "</td>" +
                                    "<td>" + jsonData.Train + "</td>" +
                                    "<td>" + jsonData.Starts + "</td>" +
                                    "<td>" + jsonData.Tos + "</td>" +
                                    "<td>" + jsonData.North_Delivery_Case_Status + "</td>" +
                                    "<td>" + jsonData.Publish_Time + "</td>" +
                                    "</tr>";
                            $("#shownorrecord tbody").append(newRowContent);
                        });
                    }else {}
                }, "json");
            }
            function Sou_record() {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/SDCase.php",
                        {whatever: "qq"},
                function (data, status) {
                    if (data.count != 0) {
                        $('#showsourecord tbody').empty();
                        $.each(data.data, function (index, jsonData) {
                            var newRowContent =
                                    "<tr>" +
                                    "<td>" + jsonData.South_Delivery_Case_ID + "</td>" +
                                    "<td>" + jsonData.Train + "</td>" +
                                    "<td>" + jsonData.Starts + "</td>" +
                                    "<td>" + jsonData.Tos + "</td>" +
                                    "<td>" + jsonData.South_Delivery_Case_Status + "</td>" +
                                    "<td>" + jsonData.Publish_Time + "</td>" +
                                    "</tr>";
                            $("#showsourecord tbody").append(newRowContent);
                        });
                    }else {}
                }, "json");
            }
            function Sou_trade() {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/SECase.php",
                        {whatever: "qq"},
                function (data, status) {
                    if (data.count != 0) {
                        $('#showsoutrade tbody').empty();
                        $.each(data.data, function (index, jsonData) {
                            var newRowContent =
                                    "<tr>" +
                                    "<td>" + jsonData.South_Established_Case_ID + "</td>" +
                                    "<td>" + jsonData.Train + "</td>" +
                                    "<td>" + jsonData.Sender
                                    + "</td>" +
                                    "<td>" + jsonData.Postman + "</td>" +
                                    "<td>" + jsonData.Starts + "</td>" +
                                    "<td>" + jsonData.Tos + "</td>" +
                                    "<td>" + jsonData.South_Established_CaseStatus + "</td>" +
                                    "<td>";
                            if (jsonData.Sender == "<?php echo $Name; ?>" && jsonData.South_Established_CaseStatus == "媒合成功") {
                                newRowContent = newRowContent +
                                        "<a class='btn btn-success'>" +
                                        '<i class="fa  fa-envelope-o" onclick="Sou_status_change(' + jsonData.South_Established_Case_ID + ',1);">交貨完成</i>' +
                                        "</a>";}
                            if (jsonData.Sender == "<?php echo $Name; ?>" && jsonData.South_Established_CaseStatus == "待領收") {
                                newRowContent = newRowContent +
                                        "<a class='btn btn-success'>" +
                                        '<i class="fa  fa-envelope-o" onclick="Sou_status_change(' + jsonData.South_Established_Case_ID + ',3);">確認領收</i>' +
                                        "</a>";}
                            if (jsonData.Postman == "<?php echo $Name; ?>" && jsonData.South_Established_CaseStatus == "運送中") {
                                newRowContent = newRowContent +
                                        "<a class='btn btn-primary'>" +
                                        '<i class="fa  fa-envelope-o" onclick="Sou_status_change(' + jsonData.South_Established_Case_ID + ',2);">已交貨</i>' +
                                        "</a>";}
                            newRowContent = newRowContent +
                                    "</td>" +
                                    "</tr>";
                            $("#showsoutrade tbody").append(newRowContent);
                        });
                    }else {}
                }, "json");
            }
            function Nor_trade() {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/NECase.php",
                        {whatever: "qq"},
                function (data, status) {
                    if (data.count != 0) {
                        $('#shownortrade tbody').empty();
                        $.each(data.data, function (index, jsonData) {
                            var newRowContent =
                                    "<tr>" +
                                    "<td>" + jsonData.North_Established_Case_ID + "</td>" +
                                    "<td>" + jsonData.Train + "</td>" +
                                    "<td>" + jsonData.Sender + "</td>" +
                                    "<td>" + jsonData.Postman + "</td>" +
                                    "<td>" + jsonData.Starts + "</td>" +
                                    "<td>" + jsonData.Tos + "</td>" +
                                    "<td>" + jsonData.North_Established_Case_Status + "</td>" +
                                    "<td>";
                            if (jsonData.Sender == "<?php echo $Name; ?>" && jsonData.North_Established_Case_Status == "媒合成功") {
                                newRowContent = newRowContent +
                                        "<a class='btn btn-success'>" +
                                        '<i class="fa  fa-envelope-o" onclick="Nor_status_change(' + jsonData.North_Established_Case_ID + ',1);">交貨完成</i>' +
                                        "</a>";}
                            if (jsonData.Sender == "<?php echo $Name; ?>" && jsonData.North_Established_Case_Status == "待領收") {
                                newRowContent = newRowContent +
                                        "<a class='btn btn-success'>" +
                                        '<i class="fa  fa-envelope-o" onclick="Nor_status_change(' + jsonData.North_Established_Case_ID + ',3);">確認領收</i>' +
                                        "</a>";}
                            if (jsonData.Postman == "<?php echo $Name; ?>" && jsonData.North_Established_Case_Status == "運送中") {
                                newRowContent = newRowContent +
                                        "<a class='btn btn-primary'>" +
                                        '<i class="fa  fa-envelope-o" onclick="Nor_status_change(' + jsonData.North_Established_Case_ID + ',2);">已交貨</i>' +
                                        "</a>";}
                            newRowContent = newRowContent +
                                    "</td>" +
                                    "</tr>";
                            $("#shownortrade tbody").append(newRowContent);});
                    }else {}
                }, "json");
            }
            function Sou_status_change(id, num) {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137249/changeSouthStatus_API.php",
                        {
                            Status_ID: id,
                            Status: num
                        }, function (data, status) {
                    if (data == 'success') {
                        swal("成功", "狀態已更新", "success");
                        location.reload();}
                    else {swal("錯誤", "狀態更新失敗", "error");}});
            }
            function Nor_status_change(id, num) {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137249/changeNorthStatus_API.php",
                        {Status_ID: id,
                         Status: num
                        }, function (data, status) {
                    if (data == 'success') {
                        swal("成功", "狀態已更新", "success");
                        location.reload(true);
                    }
                    else {
                        swal("錯誤", "狀態更新失敗", "error");
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="button-container" id="toggle">
            <span class="top"></span>
            <span class="middle"></span>
            <span class="bottom"></span>
        </div>
        <div class="overlay" id="overlay">
            <nav class="overlay-menu">
                <ul>
                    <li><a href = "home.php">嗨！<?php echo $Name; ?></a></li>
                    <li><a href = "member.php">會員資料</a></li>
                    <li><a data-toggle="modal" data-target="#recordModal" onclick="Nor_record();
                            Sou_record();">刊登紀錄</a></li>
                    <li><a data-toggle="modal" data-target="#overModal" onclick="Sou_trade();
                            Nor_trade();
                           ">媒合紀錄</a></li> 
                    <li><a data-scroll id="maker1" href="#maker">刊登</a></li>
                    <li><a href = "logout.php">登出</a></li>           
                </ul>
            </nav>
        </div>
        <div class="modal fade" id="recordModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $Name; ?>的刊登資料</h4>
                    </div>
                    <div class="modal-header">

                        <h4 class="modal-title">北上</h4>
                    </div>
                    <div class="modal-body">

                        <div class="table-responsive">
                            <table id="shownorrecord" class="table table-hover">
                                <thead >
                                    <tr>
                                        <th>刊登編號</th>
                                        <th>班次</th>
                                        <th>起點站</th>
                                        <th>終點站</th>
                                        <th>狀態</th>
                                        <th>刊登時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-header ">
                        <h4 class="modal-title" >南下</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="showsourecord" class="table table-hover">
                                <thead >
                                    <tr>
                                        <th>刊登編號</th>
                                        <th>班次</th>
                                        <th>起點站</th>
                                        <th>終點站</th>
                                        <th>狀態</th>
                                        <th>刊登時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="overModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $Name; ?>的媒合資料</h4>
                    </div>
                    <div class="modal-header">
                        <h4 class="modal-title">北上</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="shownortrade" class="table table-hover">
                                <thead >
                                    <tr>
                                        <th>媒合編號</th>
                                        <th>班次</th>
                                        <th>寄件人</th>
                                        <th>運送人</th>
                                        <th>起點站</th>
                                        <th>終點站</th>
                                        <th>狀態</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-header ">
                        <h4 class="modal-title" >南下</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="showsoutrade" class="table table-hover">
                                <thead >
                                    <tr>
                                        <th>媒合編號</th>
                                        <th>班次</th>
                                        <th>寄件人</th>
                                        <th>運送人</th>
                                        <th>起點站</th>
                                        <th>終點站</th>
                                        <th>狀態</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="container-fluid intro-lg  bkg">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
            <h3 id="supra" class="animated fadeInUp">點對點</h3>
            <h1 id="title" class="animated fadeInUp">Thunder</h1>
            <h3 id="sub" class="animated bounceIn">將重新定義<span >貨物傳輸的</span><span >最短時間</span></h3>
            <div class="divider divider-intro animated bounceIn"></div>
            <a data-scroll id="btn-intro" href="#timer" class="btn btn-custom animated fadeInUp">查詢時刻</a>
        </div>
    </header>
    <div class="expertise">
        <div class="row">
            <div class="col-lg-12">
                <h2 id="services" class="uppercase wow">提供的服務</h2>
                <div class="divider"></div>	
            </div>
        </div>
        <div class="container expertise">
            <div class="col-xs-10 col-xs-offset-2 col-md-10 col-centered">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 wow fadeIn">
                        <i class="fa fa-rocket fa-5x"></i>
                        <h4 class="uppercase">快速</h4>
                        <div class="divider-small"></div>
                        <p>突破以往動則2~3天的運送時間，將物品流動時間降到最低。</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 wow fadeIn">
                        <i class="fa fa-globe fa-5x"></i>
                        <h4 class="uppercase">環保</h4>
                        <div class="divider-small"></div>
                        <p>全程均使用大眾運輸工具，為我們的地球減少碳排放量！</p>       
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 wow fadeIn">
                        <i class="fa fa-check-square-o fa-5x"></i>
                        <h4 class="uppercase">方便</h4>
                        <div class="divider-small"></div>
                        <p>快去查看時刻表，並且輕易可查出今天幫您送貨的乘客！</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="expertise">
        <div class="row">
            <div class="col-lg-12">
                <h2 id="" class="uppercase wow">介紹影片</h2>
                <div class="divider"></div>	
            </div>
        </div>
        <div align="center" class="embed-responsive embed-responsive-16by9">
            <video  controls  class="embed-responsive-item">
                <source src="img/in_thunder.mp4" type=video/mp4>
            </video>
        </div>
    </div> 
    <div class="container-fluid recent-work">
        <div id="maker" class="col-xs-12 col-md-8 col-md-offset-2">
            <h3 class="text-center uppercase">刊登</h3>
            <div class="divider"></div> 
            <div class="col-xs-5 input-group">
                <span class="input-group-addon" id="sizing-addon2">車次</span>
                <input type="number" min="0" data-bind="value:replyNumber" class="form-control inputcarnum" placeholder="輸入車次" aria-describedby="sizing-addon2" id="inputcarnum" >
            </div>	 
            </br>       
            方<n>&nbsp;&nbsp;</n>向：
            <select id="inputpath" class="selectpicker inputpath" data-width="auto" >
                <option value="north">北上</option>
                <option value="south">南下</option>
            </select>	   
            </br></br>

            <button type="button" class="btn btn-success search" onclick="showtime();">查詢</button>
            <button type="button" class="btn btn-danger research hide" onclick="research();">重新查詢</button>
            </br></br></br> 

            <div class="col-lg-12 col-md-12 col-xs-12 panel panel-info hide showtimer ">
                <div class="panel-body ">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead >
                                <tr>
                                    <th>班次</th>
                                    <th>台北</th>
                                    <th>板橋</th>
                                    <th>桃園</th>
                                    <th>新竹</th>
                                    <th>苗栗</th>
                                    <th>台中</th>
                                    <th>彰化</th>
                                    <th>雲林</th>
                                    <th>嘉義</th>
                                    <th>台南</th>
                                    <th>左營</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><div id="carnum" ></div></td>
                                    <td><div id="Taipei" ></div></td>
                                    <td><div id="Banqiao" ></div></td>                                            
                                    <td><div id="Taoyuan" ></div></td>
                                    <td><div id="Hsinchu" ></div></td>
                                    <td><div id="Miaoli" ></div></td>                                          
                                    <td><div id="Taichung" ></div></td>
                                    <td><div id="Changhua" ></div></td>
                                    <td><div id="Yunlin" ></div></td>
                                    <td><div id="Chiayi" ></div></td>
                                    <td><div id="Tainan" ></div></td>
                                    <td><div id="Zuoying" ></div></td>
                                </tr>
                            </tbody>
                            <tbody>

                                <tr id="str" >
                                    <td>起點站：</div></td>
                                    <td><a id="台北" class="btn btn-success s1 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="板橋" class="btn btn-success s2 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="桃園" class="btn btn-success s3 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="新竹" class="btn btn-success s4 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="苗栗" class="btn btn-success s5 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>

                                    <td><a id="台中" class="btn btn-success s6 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="彰化" class="btn btn-success s7 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="雲林" class="btn btn-success s8 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>



                                    <td><a id="嘉義" class="btn btn-success s9 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="台南" class="btn btn-success s10 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>
                                    <td><a id="左營" class="btn btn-success s11 hide q" onclick="startstation(this.id);"><i class="fa fa-arrow-up fa-lg"></i> </a></td>                                            
                                </tr>

                            </tbody>
                            <tbody>
                                <tr id="end">
                                    <td>終點站：</div></td>
                                    <td><a id="台北" class="btn btn-danger e1 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="板橋" class="btn btn-danger e2 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="桃園" class="btn btn-danger e3 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="新竹" class="btn btn-danger e4 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="苗栗" class="btn btn-danger e5 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="台中" class="btn btn-danger e6 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="彰化" class="btn btn-danger e7 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="雲林" class="btn btn-danger e8 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="嘉義" class="btn btn-danger e9 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="台南" class="btn btn-danger e10 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>
                                    <td><a id="左營" class="btn btn-danger e11 hide w" onclick="endstation(this.id);"><i class="fa fa-arrow-down fa-lg"></i> </a></td>                               
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </br></br></br>                  
            起點站：<div id="sstation"></div>				 
            <br/>
            終點站：<div id="estation"></div> 
            <br/><br/>
            <button type="button" class="btn btn-primary hide sendbutton" onclick="nullcheck();">確定刊登</button>  
            <h3 class="text-center uppercase">刪除</h3>
            <div class="divider"></div>
            <div class="col-xs-7 input-group">
                <span class="input-group-addon" id="sizing-addon4">刊登編號</span>
                <input type="number" min="0" data-bind="value:replyNumber" class="form-control inputdel" placeholder="輸入刊登編號" aria-describedby="sizing-addon4" id="inputdel" >
            </div>   
            </br> 
            方<n>&nbsp;&nbsp;</n>向：
            <select id="inputdelpath" class="selectpicker inputdelpath" data-width="auto" >
                <option value="north">北上</option>
                <option value="south">南下</option>
            </select>    
            </br></br>
            <button type="button" class="btn btn-danger" onclick="deletecheck();">刪除</button>
        </div>
    </div>
</div>

<div id="timer" class="container-fluid timer ">
    <h2 class="text-center uppercase">時刻表</h2>
    <a class="btn btn-default btn-xl wow tada" onclick="callSouthDelivery()" style="visibility: visible; animation-name: tada;">南下</a>
    <a class="btn btn-default btn-xl wow tada" onclick="callNorthDelivery()" style="visibility: visible; animation-name: tada;">北上</a>
    <div class="divider"></div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default ">
                <div class="panel-body ">
                    <div class="table-responsive">
                        <table id="tb" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>班次</th>
                                    <th>起點站</th>
                                    <th>出發時間</th>
                                    <th>終點站</th>
                                    <th>抵達時間</th>
                                    <th>可運送人數</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="showtimeModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">可運送人資料</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="showDeliveryList" class="table table-hover">
                        <thead align="center" >
                            <tr>
                                <td>會員</td>
                                <td>姓名</td>
                                <td>出發站</td>
                                <td>終點站</td>
                                <td>狀態</td>
                                <td>媒合</td>
                            </tr>
                        </thead>
                        <tbody align="center">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" >Ok</button>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    function callSouthDelivery()
    {
        var Member_ID = "<?php echo $Memberid; ?>";
        $.post("http://fs.mis.kuas.edu.tw/~s1101137249/homeDelivery_API.php",
                {path: 'south',
                 mID: Member_ID},
        function (data, status) {
            if (status == 'success') {
                var newRowContent = '' + data;
                $('#tb tbody').empty();
                $("#tb tbody").append(newRowContent);
            }
            else {alert("error");}
        });
    }
    function callNorthDelivery()
    {
        var Member_ID = "<?php echo $Memberid; ?>";
        $.post("http://fs.mis.kuas.edu.tw/~s1101137249/homeDelivery_API.php",
                {path: 'north',
                 mID: Member_ID},
        function (data, status) {
            if (status == 'success') {
                var newRowContent = '' + data;
                $('#tb tbody').empty();
                $("#tb tbody").append(newRowContent);
            }
            else {alert("error");}
        });
    }
    function phone(obj)
    {
        var id = obj.parentNode.parentNode.rowIndex;
        var Train = document.getElementById("tb").rows[id].cells[0];
        $('#showDeliveryList tbody').empty();
        callPOST(Train.innerHTML, obj.id);
    }
    function callPOST(carTrain, SouthNorth)
    {
        var strPath = '';
        if (SouthNorth == 'IconNorth')
        {strPath = 'north';} 
        else {strPath = 'south';}
        $.post("http://fs.mis.kuas.edu.tw/~s1101137249/showDelivery_API.php",
                {train: carTrain,
                 path: strPath},
        function (data, status) {
            if (status == 'success') {
                $.each(data.data, function (index, jsonData) {
                    var Member_ID = "<?php echo $Memberid; ?>";
                    if (jsonData.會員編號 != Member_ID) {
                        var newRowContent =
                                "<tr align='center'>" +
                                "<td>" + jsonData.會員編號 + "</td>" +
                                "<td>" + jsonData.姓名 + "</td>" +
                                "<td>" + jsonData.出發站 + "</td>" +
                                "<td>" + jsonData.終點站 + "</td>" +
                                "<td>" + jsonData.狀態 + "</td>" +
                                "<td>";

                        if (jsonData.狀態 == '等待媒合')
                        {
                            newRowContent = newRowContent +
                                    "<a class='btn btn-success'>" +
                                    '<i class="fa  fa-envelope-o" id="sendBtn"  onclick="showSwal(' + jsonData.會員編號 + ',\'' + jsonData.信箱 + '\',' + jsonData.刊登編號 + ',\'' + strPath + '\')" > 邀請</i>' +
                                    "</a>";
                        }
                        newRowContent = newRowContent +
                                "</td>" +
                                "</tr>";
                        $("#showDeliveryList tbody").append(newRowContent);
                    }
                });
            }
            else {alert("error");}
        }, "json");

    }
    ;
    function showSwal(id, email, dID, strPath)
    {
        swal(
                {
                    title: '確定發出邀請嗎?',
                    text: '你 將 會 寄 出 託 運 邀 請 給 會 員 編 號 ' + id + '!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '好, 發出邀請!',
                    cancelButtonText: '不, 取消邀請!',
                    confirmButtonClass: 'confirm-class',
                    cancelButtonClass: 'cancel-class',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
        function (isConfirm) {
            if (isConfirm) {
                $.post("http://fs.mis.kuas.edu.tw/~s1101137237/ODAC/sendmail.php",
                        {
                            sendmember: "<?php echo $Memberid; ?>",
                            getid: id,
                            Delivery_Case_ID: dID,
                            path: strPath
                        },
                function (data, status) {
                    if (data == 'success') {swal('送出!', '你已經寄出邀請給會員編號 ' + id + ' ,  ' + email + ' !', 'success');}
                    else {swal('失敗', '重新查詢', 'error');}
                });
            } else {swal('取消!', '您已經取消邀請給會員編號 ' + id + ' !', 'error');}
        }
        )
    }
</script>
<footer>
    <ul class="list-inline social">
        <li><a href="https://twitter.com/" target="_blank" class="social-twitter"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></i></a></li>
        <li><a href="https://codepen.io/" target="_blank" class="social-codepen"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-codepen fa-stack-1x fa-inverse"></i></i></a></li>
        <li><a href="https://dribbble.com/" target="_blank" class="social-dribbble"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-dribbble fa-stack-1x fa-inverse"></i></i></a></li>
        <li><a href="mailto:gravity820305@gmail.com" class="social-mail"><i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></i></a></li>
    </ul>
    <p>Made with <span class="fa fa-heart animated pulse"></span> in KUAS MIS.</p>
    <p>&copy; 2015 Eric. All rights reserved.</p>
</footer>   
<script src="js/bootstrap-select.js"></script>
<script src="js/smooth-scroll.js"></script>
<script> smoothScroll.init();</script>
<script src="js/menu.js"></script>
</body>
</html>