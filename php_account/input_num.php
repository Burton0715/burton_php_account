<?php
require "JsonDB.class.php";
$money = $_REQUEST["money"];
$usage = $_REQUEST["usage"];
$type = $_REQUEST["type"];
$ID = 1;
date_default_timezone_set('Asia/Taipei');
$time = date("Y-m-d H:i");
$db = new JsonDB("./");
$result = $db->selectAll("data");
for($i=0;$i<=count($result);$i++){
	if($result[$i]["ID"]>=$ID){
		$ID = $result[$i]["ID"];
	}
}
$ID++;
$db = new JsonDB("./"); //parameter => directory to your json files
$new_entry = array("money"=>$money, "usage"=>$usage, "type"=>$type,"time"=>$time,"ID"=>$ID);
$db->insert("data", $new_entry); //storage => 檔名
?>
<meta http-equiv="refresh" content="0;url=form_list.php" />