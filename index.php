<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test Upload</title>
        <link rel ="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id ="content">
            <form method="POST" action ="index.php" enctype ="multipart/form-data">
                <input type="hidden" name ="size" value ="1000000">
                <div>
                    <input type="file" name ="datafile">
                </div>
                <div>
                    <button type ="submit" name ="upload">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
$db = mysqli_connect("localhost", "root", "", "cryptocurrency") or die(msql_error());
$createPriceTable = "CREATE TABLE IF NOT EXISTS PRICE(PRICE_ID INTEGER PRIMARY KEY, NAME VARCHAR(64), DATE VARCHAR(64), AVERAGE INTEGER)";
$createVolumeTable = "CREATE TABLE IF NOT EXISTS VOLUME(VOLUME_ID INTEGER PRIMARY KEY, NAME VARCHAR(64), DATE VARCHAR(64), VOLUME INTEGER)";
$createMarketCapTable = "CREATE TABLE IF NOT EXISTS MARKET_CAP(MARKET_CAP_ID INTEGER PRIMARY KEY, NAME VARCHAR(64), DATE VARCHAR(64), MARKET_CAP INTEGER)";
mysqli_query($db, $createPriceTable);
mysqli_query($db, $createVolumeTable);
mysqli_query($db, $createMarketCapTable);

if (isset($_POST['upload'])) {
    $insertPriceTable = "INSERT INTO PRICE VALUES('1', 'test', '11/2/14', '11456')";
    $insertVolumeTable = "INSERT INTO VOLUME VALUES('1', 'test', '11/3/14', '1433')";
    $insertMarketCapTable = "INSERT INTO MARKET_CAP VALUES('1', 'test', '11/5/14', '42564')";
    mysqli_query($db, $insertPriceTable);
    mysqli_query($db, $insertVolumeTable);
    mysqli_query($db, $insertMarketCapTable);
}
?>
