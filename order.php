<?php 
	include "include/db_connect.php";
	include "include/includeHeading.php";


	
	// Set up a SQL enquiry statement
	$strSQL  = " SELECT * FROM product " ;
	
	// Execute the SQL statement
	$result = mysqli_query($con, $strSQL);	
	
	// Check whether the SQL is properly executed.  Immediate stop if error
	if (! $result) {    
		die( "Database access failed: " . mysqli_error() ); 
	}
	
	// Find any record is obtained
	$recCount = mysqli_num_rows($result);

	if ($recCount == 0) {
		echo "No product Record";
	}
	else {
		for ($i=0; $i<$recCount; $i++) {			
			$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		
			$productID[] 	= $row['productID'];
			$description[]= $row['description'];
			$price[] 	= $row['price'];			

		}
	}	
?>




<?php


	
	// Generate Dynamic Page
echo <<< tableHead
	<div>
	<form action="orderCollect.php" method='POST'>
	<table class='table table-striped'>
		<thead class='thead-light'>
		<tr>
			<th scope='col'>Product ID</th>
			<th scope='col'>Description</th>			
			<th scope='col'>Price</th>
			<th scope='col'>Quantity</th>
			<th scope='col'>Amount</th>				 
		</tr>
		</thead>
		<tbody>
tableHead;

	for ($i=0; $i<$recCount; $i++) {
echo <<< tableDetail
		<tr>
			<td><input type = "text" class = "center" 
			value = $productID[$i] id = 'productID[[$i]' name = 'productID[$i]' readonly/>

			<td><input type = "text" class = "center" 
					value = $description[$i] id = 'description[$i]' name = 'description[$i]'readonly/>

			<td><input type = "text" class = "center" 
					value = $price[$i] id = 'price[$i]' name = 'price[$i]'readonly/>

			<td><input type = "number" min = 0 max = 9999 class='center enterField' 
					value = 0 id = 'quantity[$i]' name='quantity[$i]'/>

			<td><input type="text" class='center' 
			 value = 0 id = 'amount[$i]'name='amount[$i] readonly'/>
		</tr>		
tableDetail;
	}




echo <<< tableFoot
 		<tr><td colspan='4' class='right'>Sub-Total</td>
 			<td><input type='text' class='center' 
					id ='orderAmount'
 					name='orderAmount' 
 					value='' readonly />
 		</tr>
		 <tr><td colspan='4' class='right'>Discount</td>
		 <td><input type='text' class='center' 
				 name='discount' id='discount' 
				 value='10%' readonly />
	 	</tr>
		 <tr><td colspan='4' class='right'>Delivery Charges</td>
		 <td><input type='text' class='center' id = "deliveryCharge"
				 name='deliveryCharge'
				 value='' readonly />
	 	</tr>
		 <tr><td colspan='4' class='right'>Grand Total</td>
		 <td><input type='text' class='center' id = 'netOrderAmount'
				 name='netOrderAmount'
				 value='' readonly />
	 	</tr>

 		<tr><td colspan='5' class='right'>
 				<button type='submit' id='submitBtn' class='btn btn-primary btn-md'>
 					Submit 
 					<span class='fa fa-cloud-upload'></span>
 				</button>
 			</td>
		</tr>
	</tbody>
	</table>
	</form>
	</div>
tableFoot;



include "include/includeFooting.php"; 
?>
	
<script>
	// functions
	$(".enterField").focus ( function( event ) {
		event.preventDefault();
		console.log("on blur " + event.type);	

		// set background color 	
		$(this).css( { 'background-color' : 'yellow' } );		

	});
	
	$(".enterField").blur( function(event) {
		event.preventDefault();			
		console.log("on blur " + event.target);

		// restore background color 		
		$(this).css( { 'background-color' : 'white' } );	

		// to identify which field is outline
		var nameObj = $(event.target);
		var itemID = nameObj.attr('id');
		var index1 = itemID.indexOf('[');
		var index2 = itemID.indexOf(']');
		
		var item=itemID.substring(index1+1, index2);
		console.log('leaving index : ' + item);

	
		calculateAmount(item);
		calculateSubtotal();
		deliveryCharge();

		oa = parseFloat(document.getElementById('orderAmount').value);
		dc = parseFloat(document.getElementById('deliveryCharge').value);
		gt = dc + oa * 0.9; //assume 10% off 
		document.getElementById('netOrderAmount').value = gt.toFixed(1) ;


	});
		
	$('#submitBtn').click( function(event) {
		// event.preventDefault();		
		console.log("on submit");	
		
	});
	
	function calculateAmount(item) {
		
		field1 = "price[" + item + "]";
		field2 = "quantity[" + item + "]";
		field3 = "amount[" + item + "]";
		console.log(field1)
			
		price = document.getElementById(field1).value;
		console.log(document.getElementById(field1).value)
		quantity = document.getElementById(field2).value;
		amount = price * quantity;
			
		document.getElementById(field3).value = amount;		
	
	}
	
	function calculateSubtotal() {
		var total = 0;
		
		for (var i=0; i< <?php echo $recCount; ?>; i++) {
			field      = "amount[" + i + "]";
			fieldValue = document.getElementById(field).value.trim();
			console.log('fieldValue : ' , fieldValue);
			
			if ( fieldValue == '' || isNaN(fieldValue) ){
				continue;
			}
			else {
				amount = parseFloat(fieldValue);
				total += amount;
			}
		}
		
		document.getElementById('orderAmount').value = total;
	}

	function deliveryCharge() {
		var chargeRate = 0.05; // assume delivery charge = 5% of sub-total
		var total = 0;

		orderAmount = document.getElementById('orderAmount').value;

		total = orderAmount * chargeRate;

		document.getElementById('deliveryCharge').value= total.toFixed(1);
	}


</script>


</html>