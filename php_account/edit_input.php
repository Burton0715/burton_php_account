<?php

require "JsonDB.class.php";

//$db = new JsonDB("./data/"); //parameter => directory to your json files
$db2 = new JsonTable("./data.json"); //parameter => directory to your json files
#print_r($db2);
$ID = $_REQUEST["ID"];
#echo $ID;
$result = $db2->select("ID",$ID);
#print_r($result);
$money = $result[0]["money"];
$usage = $result[0]["usage"];
$type = $result[0]["type"];
$ID = $result[0]["ID"];
//$time = $_REQUEST["time"];
#echo $money.",".$usage.",".$type.",".$time.",".$ID;

?>


<html>
	<body bgcolor=#f0Fff0 text=#000000>
		<br>
		
		<h1 align=center>Hello Users</h1>
		<h2 align=center>This is Edit mode</h2>
		<h2 align=center>Please edit your data</h2>
		
		<form align=center action="edit_input_num.php">
			<input required name="money" type="text" placeholder="money" value='<?=$money?>' oninput="value=value.replace(/[^\d]/g,'')">
			<input required name="usage" type="text" placeholder="usage" value="<?=$result[0]["usage"]?>">
			
			<select id="type" name="type">
				<option value="out">expense</option>
				<option value="in">income</option>		
			<input type="hidden" name="time" value="<?=$result[0]["time"]?>">
			<input type="hidden" name="ID" value="<?=$result[0]["ID"]?>">
			<input type="submit" value="enter">
		</form>
	</body>
</html>

