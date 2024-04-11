<?php
require "JsonDB.class.php";


$money = $_REQUEST["money"];
$usage = $_REQUEST["usage"];
$type = $_REQUEST["type"];
$time = $_REQUEST["time"];
$ID = $_REQUEST["ID"];
echo $money.",".$usage.",".$type.",".$time.",".$ID;

$db = new JsonDB("./"); //parameter => directory to your json files
$new_entry = array("money"=>$money, "usage"=>$usage, "type"=>$type,"time"=>$time,"ID"=>$ID);
//$db->insert("data", $new_entry); //storage => 檔名
$db->update("data", "ID", $ID, $new_entry);
print_r($new_entry);
?>
<meta http-equiv="refresh" content="0;url=form_list.php" />
