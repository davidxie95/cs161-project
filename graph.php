<?php
$dbhandle = new mysqli('localhost', 'root', '', 'cryptocurrency');
echo $dbhandle->connect_error;
$query = "SELECT high, low FROM bitcoin group by high";
$res = $dbhandle->query($query);
if (isset($_POST['sub'])) {

    $csv->import($_FILES['file']['tmp_name']);
}
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
                                <a class="nav-link" href="var.html">
                                    <span data-feather="file"></span>
                                    Value at Risk
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">LINEAR REGRESSION (price vs. price)</h1>
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
                </main>
            </div>
        </div>    
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>