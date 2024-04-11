


<html>
	<body bgcolor=white text=#000000>
		<br>
		
		<h1 align=center>Data Delete mode</h1>
		<h2 align=center>Are you sure to delete your data</h2>
	</body>
</html>
<table>
<?php
require "JsonDB.class.php";
$db2 = new JsonTable("./data.json");
$ID = $_REQUEST["ID"];

$result = $db2->select("ID",$ID);
$money = $result[0]["money"];
$usage = $result[0]["usage"];
$type = $result[0]["type"];
$time = $result[0]["time"];


$table_content = "";
$table_content .= "<tr><td align=right>".$result[0]["money"];
$table_content .= "<td align=center>".$result[0]["type"];
$table_content .= "<td align=center>".$result[0]["usage"];
$table_content .= "<td align=center>".$result[0]["time"];
$table_content .= "<br>";
#print_r($table_content);
?>
</table>

<style>
  table{
    border:2px solid #000;
  }
  td{
    border:1px solid #000;
    padding:25px;
  }
</style>

<html>
<table bgcolor=#f0fff0 align=center style="border:8px #C6EAB9 groove;" cellpadding="10" border='0' face="Times New Roman">
  <caption>
  <div class="icon">
		<img src="./photo/warning_word.jpg" width="300" a0lt>
		</div>
  </caption>
  <thead>
    <tr>
      <th scope="col"><h3>money &#20</h3></th>
      <th scope="col"><h3>in/out &#20</h3></th>
	  <th scope="col"><h3>Usage &#20</h3></th>
	  <th scope="col"><h3>time &#20</h3></th>
    </tr>
	
  </thead>
  <tbody>
    <?=$table_content?>
	
  </tbody>
</table>
<br><br>
<form align=center action="delete_num.php">
			<input name="ans" type="submit" value="Delete">
			<input name="ans" type="submit" value="Cancel">
			<input type="hidden" name="ID" value="<?=$ID?>">

</html>

