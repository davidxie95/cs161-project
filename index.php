<?php

$db = mysqli_connect("localhost", "root", "", "cryptocurrency") or die(msql_error());
$createBitcoinTable = "CREATE TABLE IF NOT EXISTS BITCOIN(ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
DATE VARCHAR(64), OPEN DOUBLE,
HIGH DOUBLE,LOW DOUBLE,CLOSE DOUBLE,
VOLUME VARCHAR(64), MARKETCAP VARCHAR(64)
)";
$createLitecoinTable = "CREATE TABLE IF NOT EXISTS LITECOIN(ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
DATE VARCHAR(64), OPEN DOUBLE,
HIGH DOUBLE,LOW DOUBLE,CLOSE DOUBLE,
VOLUME VARCHAR(64), MARKETCAP VARCHAR(64)
)";
$createEthereumTable = "CREATE TABLE IF NOT EXISTS ETHEREUM(ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
DATE VARCHAR(64), OPEN DOUBLE,
HIGH DOUBLE,LOW DOUBLE,CLOSE DOUBLE,
VOLUME VARCHAR(64), MARKETCAP VARCHAR(64)
)";
mysqli_query($db, $createBitcoinTable);
mysqli_query($db, $createLitecoinTable);
mysqli_query($db, $createEthereumTable);
$csv = new csv();
if (isset($_POST['sub'])) {
    $name = basename($_FILES['file']['name']);
    $csv->import($_FILES['file']['tmp_name'], $name);
}

class csv extends mysqli {

    private $state_csv = false;

    public function __construct() {
        parent::__construct("localhost", "root", "", "cryptocurrency");
        if ($this->connect_error) {
            echo"Fail to connect to Database: " . $this->connect_error;
        }
    }

    public function import($file, $filename) {
        $file = fopen($file, 'r');
        if ($filename == "bitcoin.csv") {
            while ($row = fgetcsv($file)) {
                $value = "'" . implode("','", $row) . "'";
                $q = "INSERT INTO BITCOIN(date,open,high,low,close,volume,marketcap) VALUES(" . $value . ")";

                if ($this->query($q)) {
                    $this->state_csv = true;
                } else {
                    $this->state_csv = false;
                    echo $this->error;
                }
            }
		$db = mysqli_connect("localhost", "root", "", "cryptocurrency") or die(msql_error());
		$q2 = "UPDATE BITCOIN SET date = STR_TO_DATE(date, '%d-%b-%y')";
		mysqli_query($db, $q2);				
        }
        else if ($filename == "litecoin.csv"){
                while ($row = fgetcsv($file)) {
                $value = "'" . implode("','", $row) . "'";
                $q = "INSERT INTO LITECOIN(date,open,high,low,close,volume,marketcap) VALUES(" . $value . ")";

                if ($this->query($q)) {
                    $this->state_csv = true;
                } else {
                    $this->state_csv = false;
                    echo $this->error;
                }
            }
		$db = mysqli_connect("localhost", "root", "", "cryptocurrency") or die(msql_error());
		$q2 = "UPDATE LITECOIN SET date = STR_TO_DATE(date, '%d-%b-%y')";
		mysqli_query($db, $q2);			
        }
        else if ($filename == "ethereum.csv"){
                while ($row = fgetcsv($file)) {
                $value = "'" . implode("','", $row) . "'";
                $q = "INSERT INTO ETHEREUM(date,open,high,low,close,volume,marketcap) VALUES(" . $value . ")";				
                if ($this->query($q)) {
					
                    $this->state_csv = true;
                } else {
                    $this->state_csv = false;
                    echo $this->error;
                }
            }
		$db = mysqli_connect("localhost", "root", "", "cryptocurrency") or die(msql_error());
		$q2 = "UPDATE ETHEREUM SET date = STR_TO_DATE(date, '%d-%b-%y')";
		mysqli_query($db, $q2);
        }
    }

}

include 'index.html';
?>