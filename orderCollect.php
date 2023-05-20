<?php

	// Array to return for the invoking program
	$errors 	= array(); 				// To store errors
    $form_data 	= array(); 				// Pass back the data to the calling program 


	include "include/db_connect.php";
	$tranStatus = "success";
	

	/*
	foreach ($_POST as $key => $value) {
		echo "{$key} => {$value} ";
	}
	*/
	


	$orderAmount = $_POST['orderAmount'];
	$discount = $_POST['discount'];
	$deliveryCharge = $_POST['deliveryCharge'];
	$netOrderAmount = $_POST['netOrderAmount'];





	for ($i=0; $i<count($_POST['productID']); $i++)  {

	
		$productID[] 		= ($_POST['productID'][$i]);
		$quantity[]			= $_POST['quantity'][$i];		
		$amount[]		= $_POST['amount'][$i];	
	}


	$strSQL = " INSERT INTO orders (" .
		      " orderAmount, discount, deliveryCharge, netOrderAmount) " .
			  " VALUES ('$orderAmount', '$discount', '$deliveryCharge', '$netOrderAmount') ";
 
	//execute SQL statement 
	$result = mysqli_query($con, $strSQL);
 
		
	if (! $result) { 
		$tranStatus = "fail";
		$errors['master'] = "Insert Master Fail!";
		// die( "Database access failed: " . $strSQL .  mysqli_error() ); 
	} else {    
		$last_id = mysqli_insert_id($con);
	}			


	if ($tranStatus == "success") {
		
		for ($i=0; $i<count($_POST['productID']); $i++) {

			if ( $quantity[$i] > 1) {


				$strSQL1 ="INSERT INTO `orderdetails`(`orderID`, `productID`, `quantity`, `amount`) VALUES ($last_id,'$productID[$i]',$quantity[$i],$amount[$i])";

			
				$result1 = mysqli_query($con, $strSQL1);
		
				if (! $result1) { 

					$tranStatus = "fail";
					$errors['detail'] = "Insert Detail Fail!";
					die( "Database access failed: " . $strSQL1. mysqli_error() );
					
				}
			}
		}
	} 
	
	// Result
	if ($tranStatus == "success") {
		$form_data['success'] = "Record Added with ID : " . $last_id ;
		echo('Redirecting to order details page in 5 seconds....');

		header("Refresh:5; url=orderList.php");

		// echo "Record Added with ID : " . $last_id;


	}
	
	echo json_encode($form_data);

?>