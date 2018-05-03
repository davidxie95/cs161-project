<?php
$dbhandle = new mysqli('localhost', 'root', '', 'cryptocurrency');
echo $dbhandle->connect_error;
$query = "select ROUND(PCHANGE, 0) FROM bitcoin";
$res = $dbhandle->query($query);
$var = "TEST";
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <link href="crypto.css" rel="stylesheet">
        <title>Crypto</title>
    </head>
    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">CRYPTO</a>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#">CS161</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">
                                    <span data-feather="home"></span>
                                    Load Data <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="graph.php">
                                    <span data-feather="file"></span>
                                    Linear Regression
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="var.php">
                                    <span data-feather="file"></span>
                                    Value at Risk
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">VALUE AT RISK</h1>
                    </div>

                    <div id="chart_div" style="width: 1200px; height: 500px;"></div>

                    <h2>TABLE 1</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Percent Change</th>
                                    <th scope="col">placeholder</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td><?php echo $var; ?></td>
                                    <td>Feb 1st, 2018</td>
                                    <td>+5%</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>asdhasdh</td>
                                    <td>asdhasdh</td>
                                    <td>asdhasdh</td>
                                    <td>asdhasdh</td>
                                </tr>
                                <tr>
                                    <td>asdhasdh</td>
                                    <td>asdhasdh</td>
                                    <td>asdhasdh</td>
                                    <td>asdhasdh</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <h2>TABLE 2</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Mean</th>
                                    <th>Variance</th>
                                    <th>Confidence Interval</th>
                                    <th>asdfasdf</th>
                                    <th>asdgasdg</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1,001</td>
                                    <td>Lorem</td>
                                    <td>ipsum</td>
                                    <td>dolor</td>
                                    <td>sit</td>
                                </tr>
                                <tr>
                                    <td>1,002</td>
                                    <td>amet</td>
                                    <td>consectetur</td>
                                    <td>adipiscing</td>
                                    <td>elit</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>Integer</td>
                                    <td>nec</td>
                                    <td>odio</td>
                                    <td>Praesent</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>    
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['TBE'],
					<?php
					while ($row = $res->fetch_assoc()) {
						echo "[" . $row['ROUND(PCHANGE, 0)'] ."],";
					}
					?>
                ]);
                var options = {
                    chartArea: {
                        backgroundColor: {
                            stroke: '#1E90FF',
                            strokeWidth: 1
                        }
                    },
					
                    title: 'Title TBE',
                    hAxis: {title: 'This is X Axis'},
                    vAxis: {title: 'This is Y Axis'},
                    legend: 'none',
                };
                var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    </body>
</html>