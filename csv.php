<?php
class csv extends mysqli
{
	private $state_csv = false;
	public function __construct()
	{
		parent::__construct("localhost", "root", "", "cryptocurrency" );
		if($this->connect_error){
			echo"Fail to connect to Database: ".$this->connect_error;
		}
	}
	public function import($file)
	{

		$file = fopen($file, 'r');
		while($row = fgetcsv($file)){
			
			$value = "'" . implode("','", $row) . "'";
			$q = "INSERT INTO BITCOIN(date,open,high,low,close,volume,marketcap) VALUES(". $value .")";

		
			if ($this->query($q)){
				$this->state_csv = true;
			}else{
				$this->state_csv = false;
				echo $this->error;
			}
			
			
		}
	}
	
	
}
?>
