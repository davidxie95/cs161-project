<html>
<body>
      
<style>
form {
    border: 3px solid #f1f1f1;
}
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 16px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
button:hover {
    opacity: 0.8;
}
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}
img.avatar {
    width: 50%;
    border-right:50%;
}
.container {
    padding: 25px;
}
p.center {
            text-align: center;
            color: blue;
            font-size: 40px
             }
/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>

<body>
<form method="POST" 		enctype="multipart/form-data">
   <p class="center">Please select a data file to upload:</p>
   
   <br>
   <input type="file" name="fileToUpload" id="fileToUpload" 	size="1" accept="text/plain">
   <br> <br>
   <input type="submit" value="Upload File" name="submit">
   </form>


<form method='post'>
  <div class="imgcontainer">
    <img src="chartImage.jpg" alt="Avatar" class="avatar">
  </div>

  
  </body>
</html>



<?php //better continue.php
	session_start();
    if(!SessionValid()) header('Location: test.php');
       
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
       echo "Content in the text file: ";
       echo "<br>";
       
       //echo $line = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

       
       //$csv = array_map('str_getcsv', file($name));
       $csv = array_map('str_getcsv', file('test.csv'));
       array_walk($csv, function(&$a) use ($csv) {
       $a = array_combine($csv[0], $a);
        });
       array_shift($csv); # remove column header
      

//         echo '<pre>';
//         print_r($csv);
//         echo '</pre>';
       
   
	require_once 'login166.php';
	$conn =new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die($conn->connect_error);
       
       // insert csv file to databse
       $sql = "LOAD DATA LOCAL INFILE 'test.csv'
       INTO TABLE test166.price
       FIELDS TERMINATED BY ','
       OPTIONALLY ENCLOSED BY '\"' 
       LINES TERMINATED BY '\n' 
       IGNORE 1 LINES;";
       
    $sql="DELETE FROM price WHERE Date<'20161010'";
       
//         echo '<pre>';
//         print_r($csv);
//         echo '</pre>';
       
       
//$sql = "INSERT INTO price(Date, OPrice,HPrice,LPrice,CPrice,Volumn,MCap)
//VALUES (20160304, 11231, 11578,1121,123242,56576,678854);";

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