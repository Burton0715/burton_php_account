<?php
require "JsonDB.class.php";

$db2 = new JsonTable("./data.json"); //parameter => directory to your json files
$ID = $_REQUEST["ID"];
$result = $db2->select("ID",$ID);

/*
$money = $result[0]["money"];
$usage = $result[0]["usage"];
$type = $result[0]["type"];
$ID = $result[0]["ID"];
$time = $result[0]["time"];
echo $money.",".$usage.",".$type.",".$time.",".$ID."<br>";
*/
$db2->delete("ID",$ID);
print_r($db2);
?>
<meta http-equiv="refresh" content="0;url=form_list.php" />