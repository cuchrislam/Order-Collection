<?php
	// Include Files
	include_once ('include/db_connect.php');
	include_once ('include/includeHeading.php');
	
	// Set up a SQL enquiry statement
	$strSQL  = " SELECT * FROM orderdetails " ;
	
	// Execute the SQL statement
	$result =  mysqli_query ($con, $strSQL);	
	
	// Check whether the SQL is properly executed.  Immediate stop if error
	if (! $result) {    
		die( "Database access failed: " . mysqli_error() ); 
	}
	
	echo "<h1>Order List</h1>";
	
	// Find any record is obtained
	$recCount = mysqli_num_rows($result); 

	if ($recCount == 0) 
	{
		echo "No orders in the table!";
	}
	else 
	{
		echo "<table class='table table-striped'>";
		echo "<tr>";
		echo "   <th>OrderID</th>";
		echo "   <th>ProductID</th>";
		echo "   <th>quantity</th>";
		echo "   <th>amount</th>";
		echo "</tr>";
		
		for ($i=0; $i<$recCount; $i++) {			
			$row = mysqli_fetch_array($result,  MYSQLI_ASSOC);
			echo "<tr>";
			echo "<td>" . $row['orderID'] . "</td>";
			echo "<td>" . $row['productID'] . "</td>";
			echo "<td>" . $row['quantity'] . "</td>";
			echo "<td>" . $row['amount'] . "</td>";
			echo "</tr>";			
		}
		
		echo "</table>";
		
	}			

	include_once ('include/includeFooting.php');
?>