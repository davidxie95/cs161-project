<?php

$db = mysqli_connect("localhost", "root", "", "cryptocurrency") or die(msql_error());

$createBitcoinTable = "CREATE TABLE IF NOT EXISTS BITCOIN(ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
DATE VARCHAR(64), OPEN DOUBLE,
HIGH DOUBLE,LOW DOUBLE,CLOSE DOUBLE,
VOLUME VARCHAR(64), MARKETCAP VARCHAR(64)
)";

mysqli_query($db, $createBitcoinTable);

include("csv.php");
$csv = new csv();

if (isset($_POST['sub'])){
	
	$csv->import($_FILES['file']['tmp_name']);
}

?>
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
            <form method="post" enctype ="multipart/form-data">

                <input type="file" name ="file">
                <input type ="submit" name ="sub" value = "Import">

            </form>
        </div>
    </body>
</html>
