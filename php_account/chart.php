<?php
require "JsonDB.class.php";
$db = new JsonDB("./");
$result = $db->selectAll("data");
$month_list_cost = "";
$month_list_income = "";
$index = "";
$index_cost = "";
$index_income = "";
$list_cost = "";
$list_income = "";
$spend_month_chart = Array(); //今年的十二個月份的消費金額
$income_month_chart = Array(); //今年的十二個月份的消費金額
$income = Array(); //讀取收入比例
$cost = Array(); //讀取支出比例
date_default_timezone_set('Asia/Taipei');
$year = date("Y");

for($i=1;$i<13;$i++){ //初始化年月份花費金額hash_arr
	$i = str_pad($i,2,"0",STR_PAD_LEFT);
	$year_month = $year."-".$i;
	#echo $year_month;
	$spend_month_chart[$year_month] = 0;
	$income_month_chart[$year_month] = 0;
}

for($i=0;$i<count($result);$i++){ //增加花費金額
	$year_month =  substr($result[$i]['time'],0,7); //取得時間
	$category = $result[$i]["usage"];
	
	if($result[$i]["type"]=="out"){
		if(isset($spend_month_chart[$year_month])){
			$spend_month_chart[$year_month] = $spend_month_chart[$year_month] + $result[$i]["money"]; // 金額加上金額
		}
		else{
			#Array_push($spend,$year_month,$result[$i][]);
			$spend_month_chart[$year_month] = $result[$i]["money"]; // 定義 2024--1  金額
		}
	}
	else{
		if(isset($income_month_chart[$year_month])){
			$income_month_chart[$year_month] = $income_month_chart[$year_month] + $result[$i]["money"]; // 金額加上金額
		}
		else{
			#Array_push($spend,$year_month,$result[$i][]);
			$income_month_chart[$year_month] = $result[$i]["money"]; // 定義 2024--1  金額
		}
	}
	
	if($result[$i]["type"]=="out"){ //$cost
		if(isset($cost[$result[$i]["usage"]])){
			$cost[$result[$i]["usage"]] = $cost[$result[$i]["usage"]] + $result[$i]["money"];
		}
		else{
			$cost[$result[$i]["usage"]] = $result[$i]["money"];
		}
	}
	else{
		if(isset($income[$result[$i]["usage"]])){
			$income[$result[$i]["usage"]] = $income[$result[$i]["usage"]] + $result[$i]["money"];
		}
		else{
			$income[$result[$i]["usage"]] = $result[$i]["money"];
		}
	}
}
#print_r($income);
#print_r($cost);

//-----------------------------------------------------------------------------keys

for($i=0;$i<count(array_keys($spend_month_chart));$i++){ //spend 的 keys 塞入字串樣式
	$index .=  "'".array_keys($spend_month_chart)[$i]."', ";	
}
for($i=0;$i<count(array_keys($cost));$i++){ //spend 的 keys 塞入字串樣式
	$index_cost .=  "'".array_keys($cost)[$i]."', ";	
}
for($i=0;$i<count(array_keys($income));$i++){ //spend 的 keys 塞入字串樣式
	$index_income .=  "'".array_keys($income)[$i]."', ";	
}

//-----------------------------------------------------------------------------values
#echo "<br>";

for($i=0;$i<12;$i++){ // 塞入月份花費金額
	$month_list_cost .= Array_values($spend_month_chart)[$i].", ";
}
for($i=0;$i<12;$i++){ // 塞入月份所得金額
	$month_list_income .= Array_values($income_month_chart)[$i].", ";
}
for($i=0;$i<count(array_values($cost));$i++){ //spend 的 keys 塞入字串樣式
	$list_cost .=  "'".array_values($cost)[$i]."', ";	
}
for($i=0;$i<count(array_values($income));$i++){ //spend 的 keys 塞入字串樣式
	$list_income .=  "'".array_values($income)[$i]."', ";	
}


    
//-----------------------------------------------------------------------------
//二分法投入個別hash_arr --> cost, income
#foreach($spend_month_chart as $key => $val)
#   echo $key . " " . $val . "<br>";

?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	.chartBlock {
    height: 300px;
    width: 300px;
    margin: 0 auto;
}
</style>
</head>

<body align=center style="border:8px #C6EAB9 groove;" cellpadding="10" border='0' face="Times New Roman">
    <!-- 長條圖顯示的位置 -->
	<caption>
    <h1>
    收支出紀錄
	</h1>
  </caption>
    <div class="chartblock">
		<canvas id="myChart"></canvas>
	</div>
	<div class="chartblock" style="text-align:center;">
		<canvas id="donut_Chart_cost"></canvas>
	</div>
	<div class="chartblock">	
		<canvas id="donut_Chart_income"></canvas>
	</div>
    <!-- 長條圖的原始程式碼, 可以移除掉長條圖就會消失 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        
		const chartElement = document.getElementById('myChart'); //支出折線圖
        /*
		const data = {
            labels: [ <?=$index?> ],
            datasets: [{
                label: '花費金額',
                data: [<?=$month_list_cost?>],
            }]
        };*/
        new Chart(chartElement, {
            //type: 'line',
            data: {
                labels: [<?=$index?>],
                datasets: [
                    {
                    type: 'line',
                    label: '花費金額',
                    data: [<?=$month_list_cost?>],
					},{
                    type: 'line',
                    label: '所得金額',
                    data: [<?=$month_list_income?>],
					}
				],
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						y: {
							beginAtZero: true,
						}
					}
				}
        }});
		
		const chart_Element = document.getElementById('donut_Chart_cost'); // 支出圓餅圖
        const data_2 = {
            labels: [<?=$index_cost?>],
            datasets: [{
                label: '花費金額',
                data: [<?=$list_cost?>],
				options: {
					responsive: true,
					maintainAspectRatio: false
				}
            }]
        };
        new Chart(chart_Element, {
            type: 'doughnut',
            data: data_2,
        });
		const chart_Element2 = document.getElementById('donut_Chart_income'); // 收入圓餅圖
        const data_3 = {
            labels: [<?=$index_income?>],
            datasets: [{
                label: '花費金額',
                data: [<?=$list_income?>],
				options: {
					responsive: true,
					maintainAspectRatio: false
				}
            }]
        };
        new Chart(chart_Element2, {
            type: 'doughnut',
            data: data_3,
        });
    </script>

</body>
</html>