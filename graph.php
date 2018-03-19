
<?php
$dbhandle = new mysqli("localhost", "root", "", "cryptocurrency" );
$dbhandle->connect_error;

$query = "SELECT high, low from BITCOIN";
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
          ['high', 'low'],
			<?php 
			while($row=$res->fetch_assoc())
			{
				echo "['".$row['high']."',".$row['low']."],";
			}

			?>
        ]);

        var options = {
          title: 'high vs low',
          hAxis: {title: 'high', minValue: 0, maxValue: 15},
          vAxis: {title: 'low', minValue: 0, maxValue: 15},
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