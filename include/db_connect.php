<? 
	error_reporting(E_ALL ^ E_WARNING);				// suppress warning
	
	DEFINE('DB_USER',       "b14_32202691");
	DEFINE('DB_PASSWORD',   "m102m102!!");
	DEFINE('DB_HOST',       "sql311.byethost24.com");
	DEFINE('DB_NAME',       "b14_32202691_chris");
 
	// Connect to MySQL
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_set_charset($con,"utf8");	

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else {
		// echo "Connection OK for : " . DB_NAME;			
	}
?> 
   
   





