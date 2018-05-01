<?php 

// db connection might be different
$dbhandle = new mysqli('localhost','root','','cryptocurrency');
echo $dbhandle->connect_error;

//--------------------------------------------------------------------------//

// change start and end date for GUI

$startDate = '2018-01-01';
$endDate = '2018-02-01';
$tableName = 'bitcoin';

$query3 = "SELECT open FROM $tableName WHERE 
date < '$endDate' and date >= '$startDate'";

$res = $dbhandle->query($query3);

while($row=$res->fetch_assoc()){
	$temp_array[] = $row['open'];
}

echo '<pre>'."First element is the endDate ";
print_r($temp_array); echo '</pre>';

for ($i = 0; $i < count($temp_array)-1; $i++) {
	
	$percent_array[$i] = number_format((($temp_array[$i] - 
	$temp_array[$i+1])*100)/($temp_array[$i+1]), 2, '.', '');
} 

echo '<pre>'."Difference in Percentage "; print_r($percent_array); echo '</pre>';

//total change
$totalChange = array_sum($percent_array);
echo "Total change during the month is ".$totalChange."%"."<br>";

//average change
$averageChangePercent = array_sum($percent_array) / count($percent_array);
echo "Average change per day during the month is: "
.number_format($averageChangePercent, 2, '.', '')."%"."<br>";

//calculate estimate value
//estimate value = current price + (cValue * trend * ratio)
//cValue = price difference in 24hr
//trend = positive or negative gain
//ratio = TBE

$cValue = $temp_array[0] - $temp_array[1];
//if sum of percentage change is >5% for the last 7 days, 
//positive trend
//else negative trend

$sum =0;
for ($j = 0; $j < 7; $j++){
	$sum += $percent_array[$j];
}

if ($sum >=5){
	$trend = 1;
}else{
	$trend = -1;
}
//echo "The sum of change in precentage is ".$sum."<br>";

//Ratio = TBE
$ratio = 1.0;


//echo $ratio."<br>";

$estimateNextVal = $temp_array[0] + ($cValue * $trend * $ratio);
echo "The estimated value is ".$estimateNextVal;









?>

