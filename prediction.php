<?php 

// db connection might be different
$dbhandle = new mysqli('localhost','root','','cryptocurrency');
echo $dbhandle->connect_error;

//--------------------------------------------------------------------------//

// change start and end date for GUI

$startDate = '2017-01-01';
$endDate = '2018-02-20';
$tableName = 'bitcoin';

$query = "SELECT open FROM $tableName WHERE 
date < '$endDate' and date >= '$startDate'";

$query2 = "select open from bitcoin 
where date = '$startDate' or date = '$endDate'";

$res = $dbhandle->query($query);

while($row=$res->fetch_assoc()){
	$temp_array[] = $row['open'];
}

$res2 = $dbhandle->query($query2);

while($row=$res2->fetch_assoc()){
	$temp2_array[] = $row['open'];
}

for ($i = 0; $i < count($temp_array)-1; $i++) {
	
	$percent_array[$i] = number_format((($temp_array[$i] - 
	$temp_array[$i+1])*100)/($temp_array[$i+1]), 2, '.', '');
} 

//total change
$totalChange = array_sum($percent_array);

//average change
$averageChangePercent = array_sum($percent_array) / count($percent_array);


function printMeanPerMonth($param, $param2, $param3) {
echo "Percentage change during $param2 to $param3: ".
$param."%"."<br>";
}

function printMeanPerDay($param) {
echo "Mean (average change per day): "
.number_format($param, 2, '.', '')."%"."<br>";
}

printMeanPerMonth($totalChange, $startDate, $endDate);
printMeanPerDay($averageChangePercent);























?>

