<table>
<?php
require "JsonDB.class.php";

$db = new JsonDB("./");

$result = $db->selectAll("data");
$table_content = "";
$cost = 0;
$income = 0;
for($i=0; $i<count($result); $i++){	
	$table_content .= "<tr><td align=right>".$result[$i]["money"];
	$table_content .= "<td>".$result[$i]["type"];
	$table_content .= "<td>".$result[$i]["usage"];
	$table_content .= "<td>".$result[$i]["time"];
	$table_content .= "<input type='submit' name='ID' value=".$result[$i]["ID"].">";
	$table_content .="<td><input type='button' value='Edit' onclick=\"location.href='./edit_input.php?ID=".$result[$i]["ID"]."'\">";
	$table_content .="<td><input type='button' value='Delete' onclick=\"location.href='./delete.php?ID=".$result[$i]["ID"]."'\">";
	$table_content .= "<br>";
	$table_content .= "<br>";
	if($result[$i]["type"]=="out"){
		$cost = $cost + $result[$i]["money"];
	}
	if($result[$i]["type"]=="in"){
		$income = $income + $result[$i]["money"];
	}
}
$total = $income - $cost;
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
<body align=center>
<input type='button' value='back to home' onclick="location.href='./input.php'">
<input type='button' value='chart' onclick="location.href='./chart.php'">
</body>
<table bgcolor=#f0fff0 align=center style="border:8px #C6EAB9 groove;" cellpadding="10" border='0' face="Times New Roman">
	
  <caption>
    <h1>
    收支出紀錄
	</h1>
  </caption>
  <thead>
    <tr>
      <th scope="col"><h3>money &#20</h3></th>
      <th scope="col"><h3>in/out &#20</h3></th>
	  <th scope="col"><h3>Usage &#20</h3></th>
	  <th scope="col"><h3>time &#20</h3></th>
	  <!--<th scope="col"><h3>ID &#20</h3></th>-->
    </tr>
	
  </thead>
  <tbody>
    <?=$table_content?>
  </tbody>
  <tfoot>
    <tr>
      <th scope="row" colspan="2">total cost</th>
      <td><?=$cost?></td>
    <th scope="row" colspan="2">total income</th>
    <td><?=$income?></td>
	</tr>
	<tr>
	  <th scope="row" colspan="2">total</th>
	  <td><?=$total?></td>
	  
	</tr>
  </tfoot>
</table>
</html>