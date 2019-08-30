<?php

include 'includes/db.php';

//getting the customer id 
	// $c = $_SESSION['customer_email'];
    $get_c = "SELECT * FROM customers";
    $run_c = mysqli_query($con, $get_c);

    $row_c=mysqli_fetch_array($run_c);

    $customer_id = $row_c['customer_id'];
	

?>
	<h3 align="center">All Order Details:</h3>
<table width="800" align="center" bgcolor="#fff">
	<tr style="background-color: #9999FF;">
	  <th>Order No</th>	
	  <th>Due Amount</th>	
	  <th>Invoice No</th>		
	  <th>Total Products</th>	
	  <th>Order Date</th>	
	  <th>Paid/Unpaid</th>
	  <th>Status</th>		
	</tr>

	<?php 

		$get_orders = "SELECT * FROM customers_orders";
		$run_orders = mysqli_query($con, $get_orders);

		$i=0;
		
		while ($row_orders=mysqli_fetch_array($run_orders)) {
			$order_id = $row_orders['order_id'];
			$due_amount = $row_orders['due_amount'];
			$invoice_no = $row_orders['invoice_no'];
			$products = $row_orders['total_products'];
			$date = $row_orders['order_date'];
			$status = $row_orders['order_status'];

			$i++;

			if ($status=='Pending') {
				$status='Unpaid';
			}else{
				$status='Paid';
			}

			echo "
			 <tr align='center'>
				 <td>$i</td>
				 <td>$due_amount</td>
				 <td>$invoice_no</td>
				 <td>$products</td>
				 <td>$date</td>
				 <td>$status</td>
				 <td><a href='confirm.php?order_id=$order_id' target='_blank'>Confirm if Paid</a></td>
			 </tr>
			";
		}

	 ?>
</table>