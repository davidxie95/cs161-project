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
            color: red;
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

<p class="center">Cryptocurrency Analysis</p>

<form method='post'>
  <div class="imgcontainer">
    <img src="dataAnalysis.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password ( User or Admin)</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <input type="checkbox" checked="checked"> Remember me
  </div>
    
       <p>Hint:</p>
       <p>- Username: Tien ;  Password: tientran</p>
       <p>- Adminname: Admin ; Password: trantien</p> 

  </body>
</html>

      
      
<?php
session_start();
      
require_once 'login.php';
      
if($_POST){
   $username = $_POST['uname'];
    $password = $_POST['psw'];
    $conn = new mysqli($hn, $un, $pw, $db);
    //echo "$hn, $un, $pw, $db"; 
    if(isset($_POST['psw']))
        $password = mysql_entities_fix_string($conn,$_POST['psw']); 
    if(isset($_POST['uname']))
        $username = mysql_entities_fix_string($conn, $_POST['uname']);
   $password =   hash('ripemd128','gdgd'.$password . 'qwert' );
   // echo "<br>User: $password";
   // echo "<br>password: $password";
    $stmt = $conn->prepare("select id from user where name = ? and password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_NUM);
    $stmt->close();
   
    if(!$row) echo "<br>Invalide user/password combination ";
    else{
        
        startSession($row[0], $username);
        header('Location: user166.php');
        if($username=="Admin") header('Location: Admin.php');
        else header('Location: user166.php');
    } 


    
    $conn->close();
    
}      
	

	function mysql_entities_fix_string($conn, $string) {
		return htmlentities(mysql_fix_string($conn, $string));
	}
	function mysql_fix_string($conn, $string) {
		if (get_magic_quotes_gpc()) $string = stripslashes($string);
			return $conn->real_escape_string($string);
	}


function startSession($id, $username){

    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
}

?>