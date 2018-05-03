<?php
$dbhandle = new mysqli('localhost', 'root', '', 'cryptocurrency');
echo $dbhandle->connect_error;
$yaxis = (isset($_GET['Yaxis']) ? $_GET['Yaxis'] : null);
$xaxis = (isset($_GET['Xaxis']) ? $_GET['Xaxis'] : null);
if ($yaxis == "Bitcoin") {
    if ($xaxis == "Litecoin") {
        $query = "SELECT bitcoin.open, litecoin.close from bitcoin, litecoin where bitcoin.id = litecoin.id and bitcoin.date > '2017-02-01' group by bitcoin.open";
    } else if ($xaxis == "Ethereum") {
        $query = "SELECT bitcoin.open, ethereum.close from bitcoin, ethereum where bitcoin.id = ethereum.id and bitcoin.date > '2017-02-01' group by bitcoin.open";
    }
}
if ($yaxis == "Litecoin") {
    if ($xaxis == "Bitcoin") {
        $query = "SELECT litecoin.open, bitcoin.close from litecoin, bitcoin where litecoin.id = bitcoin.id and litecoin.date > '2017-02-01' group by litecoin.open";
    } else if ($xaxis == "Ethereum") {
        $query = "SELECT litecoin.open, ethereum.close from litecoin, ethereum where litecoin.id = ethereum.id and litecoin.date > '2017-02-01' group by litecoin.open";
    }
}
if ($yaxis == "Ethereum") {
    if ($xaxis == "Bitcoin") {
        $query = "SELECT ethereum.open, bitcoin.close from ethereum, bitcoin where ethereum.id = bitcoin.id and ethereum.date > '2017-02-01' group by ethereum.open";
    } else if ($xaxis == "Litecoin") {
        $query = "SELECT ethereum.open, litecoin.close from ethereum, litecoin where ethereum.id = litecoin.id and ethereum.date > '2017-02-01' group by ethereum.open";
    }
}
$res = $dbhandle->query($query);
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
                        <h1 class="h2">LINEAR REGRESSION (open vs. close price)</h1>
                    </div>
                    <form role="form" action="lr.php">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="Yaxis">
                                        <optgroup label="Y-Axis">
                                            <option>Bitcoin</option>
                                            <option>Litecoin</option>
                                            <option>Ethereum</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="Xaxis">
                                        <optgroup label="X-Axis">
                                            <option>Bitcoin</option>
                                            <option>Litecoin</option>
                                            <option>Ethereum</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input name="submit" type="submit" class="btn btn-primary btn-block te" value="Show Chart">
                    </form>
                    <div id="chart_div" style="width: 1200px; height: 500px;"></div>
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
                    ['High', '(Open, Close)'],
					<?php
						while ($row = $res->fetch_assoc()) {
							echo "[" . $row['open'] . ", " . $row['close'] . "],";
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
                    title: 'Open vs. Close comparison',
                    hAxis: {title: <?php echo "'".$_GET['Yaxis']."'"; ?>},
                    vAxis: {title: <?php echo "'".$_GET['Xaxis']."'"; ?>},
                    legend: 'none',
                    trendlines: { 0: {
                        color: 'purple',
                        lineWidth: 5,
                        opacity: 0.2,
                    } }
                };
                var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    </body>