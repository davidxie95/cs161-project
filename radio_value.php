<?php
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
echo "<span>You have selected :<b> ".$_POST['radio']."</b></span><br/>";
}
else{ echo "<span>Please select one Radio button for Price or Mcap.</span>";}
}
?>



