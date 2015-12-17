<?php
date_default_timezone_set('Asia/Taipei');
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: *');
header('X-Requested-With:*');
header('Content-type: text/html; charset=utf-8');


try {
	
    //include 'connectdB.php';
    $inputcarnum = $_POST['Carnum'];
    $inputpath = $_POST['Path'];
    $inputstart = $_POST['Start'];
    $inputend = $_POST['To'];

    $Publish_Time = date('Y-m-d H:i:s');
    $South_Delivery_Case_Status = "案件成立";
    $South_ID="26";
    $Member_ID="1";

       
        echo $Publish_Time;
	$db = initDB();
    $stmt = $db->prepare("INSERT INTO south_delivery_case(South_ID, Member_ID, Starts, Tos, South_Delivery_Case_Status, Publish_Time) VALUES(?,?,?,?,?,?)");
    $count = $stmt->execute(array($South_ID,$Member_ID,$inputstart,$inputend,$South_Delivery_Case_Status,$Publish_Time));
    
    

	
  if ($count != 1)
    {
        echo 'UnSuccess! 請重新刊登!';
    }
    else
    {
    $Q="SELECT max(South_Delivery_Case_ID) FROM south_delivery_case";
    $stmt = $db->query("$Q");
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
      $South_Delivery_Case_ID = $row['max(South_Delivery_Case_ID)']; 
    }
      //echo 'asgasf';                
    echo $South_Delivery_Case_ID;       
    }





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