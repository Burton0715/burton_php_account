<?php
require "JsonDB.class.php";
?>
<html>
	<body align=center bgcolor=#f0Fff0 text=#000000>
		<br>
		<h1 align=center>Hello Users</h1>
		<h2 align=center>This is your personal accounting software</h2>
		<h2 align=center>Please enter your data</h2>
		<form align=center action="input_num.php">
			<input type="hidden" name="ID" value=>
			<input required name="money" type="text" placeholder="money" oninput="value=value.replace(/[^\d]/g,'')">
			<input required name="usage" type="text" placeholder="usage">
			<select id="type" name="type">
				<option value="out">expense</option>
				<option value="in">income</option>	
			<input type="submit" value="enter">
			<input type="reset" value="reset">
		</form>
		<a href="form_list.php">
		<button>總表</button>
		</a> 
	</body>
</html>