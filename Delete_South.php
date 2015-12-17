<?php
date_default_timezone_set('Asia/Taipei');
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: *');
header('X-Requested-With:*');
header('Content-type: text/html; charset=utf-8');


try {
	
       $inputdel = $_POST['Del'];
	   $Member_ID = $_POST['Member'];
   

       
	$db = initDB();
   
    $sql = "SELECT * "
            . "FROM south_delivery_case "
            . "WHERE South_Delivery_Case_ID='" . $inputdel ."'AND Member_ID='". $Member_ID ."'";
    $stmt = $db->query($sql);
    $row = $stmt->fetch();
    if (!empty($row)) {
     
      echo $row['South_Delivery_Case_ID'] ." ". $row['Train'] ." ". $row['Starts'] ." ". $row['Tos'];

      
       
       
            
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