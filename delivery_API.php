<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('X-Requested-With:*');
header("Content-Type:text/html; charset=utf-8");

if (isset($_POST["path"])) {
    $path = $_POST["path"];
}
if (!mysql_connect("db4free.net:3306", "odac2015", "odac2015")) {
    die('連線資料庫失敗');
} else {
    mysql_select_db("odac");
}
try {
    if ($path == 'north') {
        $SQL = 'SELECT  TABLE2.Train,TABLE2.Zuoying,TABLE2.Tainan,TABLE2.Chiayi,TABLE2.Taichung,
							TABLE2.Hsinchu,TABLE2.Taoyuan,TABLE2.Banqiao,TABLE2.Taipei,TABLE1.OK
					FROM (
							SELECT t1.Train , COUNT(t2.North_Delivery_Case_ID) AS OK
							FROM north AS t1
							LEFT OUTER JOIN north_delivery_case AS t2 ON t1.Train=t2.Train
							GROUP BY t1.Train
							) AS TABLE1
					JOIN north AS TABLE2 ON TABLE1.Train=TABLE2.Train';
    } else {
        $SQL = 'SELECT  TABLE2.Train,TABLE2.Zuoying,TABLE2.Tainan,TABLE2.Chiayi,TABLE2.Taichung,
							TABLE2.Hsinchu,TABLE2.Taoyuan,TABLE2.Banqiao,TABLE2.Taipei,TABLE1.OK
					FROM (
							SELECT t1.Train , COUNT(t2.South_Delivery_Case_ID) AS OK
							FROM south AS t1
							LEFT OUTER JOIN south_delivery_case AS t2 ON t1.Train=t2.Train
							GROUP BY t1.Train
							) AS TABLE1
					JOIN south AS TABLE2 ON TABLE1.Train=TABLE2.Train';
    }

    $result = mysql_query($SQL);
    $station = array('0', '左營站', '台南站', '嘉義站', '台中站', '新竹站', '桃園站', '板橋站', '台北站');

    $strTable = '';
    if (mysql_num_rows($result) > 0) {
        while ($rows = mysql_fetch_array($result)) { //欄位用陣列方式
            $strTable = $strTable . '<tr align="left"> ';
            $strTable = $strTable . '<td>' . $rows[0] . '</div></td>';

            if ($path == 'north') {
                $i = 1;
                while ($i <= 8) {
                    if ($rows[$i] != '00:00:00') {
                        $strTable = $strTable . '<td>' . $station[$i] . '</td>';
                        $strTable = $strTable . '<td>' . $rows[$i] . '</td>';
                        $i = 9;
                    } else {
                        $i++;
                    }
                };
                $i = 8;
                while ($i >= 1) {
                    if ($rows[$i] != '00:00:00') {
                        $strTable = $strTable . '<td>' . $station[$i] . '</td>';
                        $strTable = $strTable . '<td>' . $rows[$i] . '</td>';
                        $i = 0;
                    } else {
                        $i--;
                    }
                };
            } else {
                $i = 8;
                while ($i >= 1) {
                    if ($rows[$i] != '00:00:00') {
                        $strTable = $strTable . '<td>' . $station[$i] . '</td>';
                        $strTable = $strTable . '<td>' . $rows[$i] . '</td>';
                        $i = 0;
                    } else {
                        $i--;
                    }
                };
                $i = 1;
                while ($i <= 8) {
                    if ($rows[$i] != '00:00:00') {
                        $strTable = $strTable . '<td>' . $station[$i] . '</td>';
                        $strTable = $strTable . '<td>' . $rows[$i] . '</td>';
                        $i = 9;
                    } else {
                        $i++;
                    }
                };
            }

            if ($path == 'north') {
                if ($rows[9] > 0) {
                    $strTable = $strTable . '<td> ';
                    for ($count = 0; $count < $rows[9]; $count++) {
                        $strTable = $strTable . '<i id="IconNorth" class="fa fa-user" onclick="phone(this)"></i>';
                    }
                    $strTable = $strTable . '</td>';
                } else {
                    $strTable = $strTable . '<td></td>';
                }
                $strTable = $strTable . '</tr>';
            } else {
                if ($rows[9] > 0) {
                    $strTable = $strTable . '<td> ';
                    for ($count = 0; $count < $rows[9]; $count++) {
                        $strTable = $strTable . '<i id="IconSouth" class="fa fa-user" data-toggle="modal" data-target="#showtimeModal" onclick="phone(this)"></i>';
                    }
                    $strTable = $strTable . '</td>';
                } else {
                    $strTable = $strTable . '<td></td>';
                }
                $strTable = $strTable . '</tr>';
            }
        }
    }
    echo $strTable;
} catch (Exception $e) {
    $array = array(
        'data' => null,
        'message' => $e->getMessage(),
        'success' => false,
        'count' => 0
    );
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
    mysql_close();
}
?>