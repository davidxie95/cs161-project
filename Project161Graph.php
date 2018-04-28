<!DOCTYPE html>
<html>
<head>
    <link href="css/style.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
<style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 200px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .column {
        width: 100%;
    }
}

/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
    
    
 select {
width:100%;
font-family:Sans-serif;
font-size:20px;
background:DodgerBlue;
padding:10px;
border:3px solid
}

 font{
font-family:Sans-serif;
font-size:20px; 
padding:10px;
border:3px solid
    }
    
</style>
    
    
<body>
 
<h1>Graph of Crypto Currency</h1>
  
<!----- Select Option Fields Starts Here ----->
<div class="row">
  <div class="column" style="background-color:#aaa;">
    
    <form action="#" method="post">
<select name="Currency">
<option value="Bitcoin">Bitcoin</option>
<option value="Litecoin">Litecoin</option>
<option value="Ethe">Etherium</option>
</select>
    <?php include'select_value.php'; ?>
</form>
      
      
<!---- Radio Button Starts Here ----->
      
   <label class="container">Price
  <input type="radio" checked="checked" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Mcap
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>
     
   </div>
    
    
    
  <div class="column" style="background-color:#bbb;">
    <form action="#" method="post">
<select name="Currency">
<option value="Bitcoin">Bitcoin</option>
<option value="Litecoin">Litecoin</option>
<option value="Ethe">Etherium</option>
</select>
</form>
   <label class="container">Price
  <input type="radio" checked="checked" name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Mcap
  <input type="radio" name="Bitcoin" value="Mcap">
  <span class="checkmark"></span>
</label>
  <?php include'radio_value.php'; ?>

</div>
 <br><br>
 
    
    
</form>

   
    
    <form action="Graph.php" method="post" enctype="multipart/form-data">
    <br>
    <br> 
        
    <br>
    <br>
    <input type="submit" value="Grahp" name="submit">
    </form>
    <br>
    <br>

    <form method='post'>
 

</body>
</html>



<?php //better continue.php

    require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
    
function endSession(){
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000,  "/");
    session_destroy();
}
    
function SessionValid(){  
    $hash = hash('ripemd128', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    if($hash !== $_SESSION['check']){
        endSession();
        return false; 
    } 
    return true; 
}
	echo "</table>";
 
// Function submit the input file
function SubmitInputFile()
{
   //echo "in submite input function<br>";
   if (isset($_POST["submit"])) 
   {
     //echo "inside post method <br>";
	main();
      // echo "Done";
   }
}
    
    
SubmitInputFile();
    
// Main function
function main()
{
   // Check if the file exist and in right type
   if (checker()) {
       $name = $_FILES['fileToUpload']['name']; 
       $path = $_FILES['fileToUpload']['tmp_name']; 
       echo "The input file is: \"", $name, "\"", "<br>";
       echo "<br>";
      
       
       //echo $line = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
       
       //$csv = array_map('str_getcsv', file($name));
       $csv = array_map('str_getcsv', file('test.csv'));
       array_walk($csv, function(&$a) use ($csv) {
       $a = array_combine($csv[0], $a);
        });
       array_shift($csv); # remove column header
       
       
        
       
       
   
	require_once 'login166.php';
	$conn =new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);
       

       
       
      // insert csv file to databse
       $sql = "LOAD DATA LOCAL INFILE 'test.csv'
       INTO TABLE test.price
       FIELDS TERMINATED BY ','
       OPTIONALLY ENCLOSED BY '\"'
       LINES TERMINATED BY '\r\n' 
       IGNORE 1 LINES;";
       
           
//       $sql = "LOAD DATA LOCAL INFILE 'litecoin_price.csv'
//       INTO TABLE test.litecoinprice
//       FIELDS TERMINATED BY ','
//       OPTIONALLY ENCLOSED BY '\"'
//       LINES TERMINATED BY '\r\n' 
//       IGNORE 1 LINES;";
       
       
  $sql="DELETE FROM test.price WHERE Date<20170510";
       
         
//      $sql= "INSERT INTO test.pricedata(Date,AvgPrice,Volume,MCap) SELECT Date,(HPrice+LPrice)/2,Volume,MCap FROM test.price";
//       
if ($conn->multi_query($sql)===TRUE) {
    echo "New records created successfully in the database.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
 
       
       
   }
}
    
 
    
  
echo "<br>";
    
    
// Function to check the input file
function checker(){
               
    //echo "iside checker method<br>";
               
   if ($_FILES['fileToUpload']['size'] === 0) {
       echo "Please select a data file to upload!!";
       return false;
   }
    
   return true;
}
    




    
    
  ?> 

    
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Date');
      data.addColumn('number', 'Bitcoin');
      data.addColumn('number', 'Litecoin');
      data.addColumn('number', 'Etherium');

      data.addRows([
        [1,  37.8, 80.8, 41.8],
        [2,  30.9, 69.5, 32.4],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 42.9, 14.8],
        [10, 12.8, 30.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);
        

      var options = {
        chart: {
          title: 'Graph of Bitcoin - Litecoin- Ehterium',
          subtitle: 'in millions of dollars (USD)'
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
        
        
    }
        
        
        
  </script>
</head>
<body>
  <div id="line_top_x"></div>
</body>
</html>
    
    
    
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Age', 'Weight'],
          [ 8,      12],
          [ 4,      5.5],
          [ 11,     14],
          [ 4,      5],
          [ 3,      3.5],
          [ 6.5,    7]
        ]);

          
//          $.get("testCore.csv", function(csvString) {
//      // transform the CSV string into a 2-dimensional array
//      var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});
//
//      // this new DataTable object holds all the data
//      var data = new google.visualization.arrayToDataTable(arrayData);
          
          
          
          
          
        var options = {
          hAxis: {minValue: 0, maxValue: 15},
          vAxis: {minValue: 0, maxValue: 15},
          chartArea: {width:'50%'},
          trendlines: {
            0: {
              type: 'linear',
              showR2: true,
              visibleInLegend: true
            }
          }
        };

        var chartLinear = new google.visualization.ScatterChart(document.getElementById('chartLinear'));
        chartLinear.draw(data, options);

        options.trendlines[0].type = 'exponential';
        options.colors = ['#6F9654'];

        var chartExponential = new google.visualization.ScatterChart(document.getElementById('chartExponential'));
        chartExponential.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chartLinear" style="height: 600px; width: 1400px"></div>
    <div id="chartExponential" style="height: 600px; width: 1400px"></div>
  </body>
</html>





