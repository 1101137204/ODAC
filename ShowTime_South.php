<?php
date_default_timezone_set('Asia/Taipei');
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: *');
header('X-Requested-With:*');
header('Content-type: text/html; charset=utf-8');


try {
	
    //include 'connectdB.php';
    $inputcarnum = $_POST['Carnum'];
   
   

       
	$db = initDB();
   
   $sql = "SELECT Train,Taipei,Banqiao,Taoyuan,Hsinchu,Miaoli,Taichung,Changhua,Yunlin,Chiayi,Tainan,Zuoying "
        . "FROM south "
        . "WHERE Train='" . $inputcarnum ."'";
    $stmt = $db->query($sql);
    $row = $stmt->fetch();
    if (!empty($row)) {
     
      echo $row['Train'] ." ". $row['Taipei'] ." ". $row['Banqiao'] ." ". $row['Taoyuan'] ." ". $row['Hsinchu'] ." ". $row['Miaoli'] ." ". $row['Taichung'] ." ". $row['Changhua'] ." ". $row['Yunlin'] ." ". $row['Chiayi'] ." ". $row['Tainan'] ." ". $row['Zuoying'];

      
       
       
            
        }
    else {
        echo 'error';
        
    };




} catch (Exception $exc) {
    echo $exc->getMessage();
}


function initDB() {
    try {
         	$db_host = 'www.db4free.net:3306';
		    $db_name = 'odac';
		    $db_user = 'odac2015';
		    $db_password = 'odac2015';
		    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
			$db = new PDO($dsn, $db_user, $db_password);
			return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} 


?>