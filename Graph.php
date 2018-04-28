<?php 
$dbhandle = new mysqli('localhost','root','','test');
echo $dbhandle->connect_error;
$query = "SELECT OPrice, HPrice FROM price group by OPrice";
$res = $dbhandle->query($query);
?>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['OPrice', 'HPrice'],
         <?php 
			while($row=$res->fetch_assoc())
			{
				echo "['".$row['OPrice']."',".$row['HPrice']."],";
			}
          ?>
        ]);

        var options = {
          title: 'Age vs. Weight comparison',
          hAxis: {title: 'OPrice', minValue: 0, maxValue: 15},
          vAxis: {title: 'HPrice', minValue: 0, maxValue: 15},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>





<?php

if(isset($_POST['submit'])){
if(!empty($_POST['Currency'])) {
echo "<span>You have selected :</span><br/>";
    
// As output of $_POST['Color'] is an array we have to use Foreach Loop to display individual value
foreach ($_POST['Currency'] as $select)
{
echo "<span><b>".$select."</b></span><br/>";
}
}
else { echo "<span>Please Select At least One Currency.</span><br/>";}
}


if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
echo "<span>You have selected :<b> ".$_POST['radio']."</b></span><br/>";
}
else{ echo "<span>Please choose any radio button.</span>";}
}






?>