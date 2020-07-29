<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$user_data = $conn->prepare("SELECT *, sales.id AS salesid FROM sales LEFT JOIN users ON users.id=sales.user_id WHERE sales.id=:id ");
	  $user_data->execute(['id'=>$id]);
	  foreach ($user_data as  $row) {
	  	 $output['Name']=$row['firstname'].' '.$row['lastname'];
	  	 $output['Address']=$row['address'];
	  	 $output['Phone']=$row['contact_info'];	  		  	
	  }

	$stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id LEFT JOIN sales ON sales.id=details.sales_id WHERE details.sales_id=:id");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
		$output['transaction'] = $row['pay_id'];
		$output['date'] = date('M d, Y', strtotime($row['sales_date']));
		$subtotal = $row['price']*$row['quantity'];
		$total += $subtotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>".number_format($row['price'], 2)." EGP</td>
				<td>".$row['quantity']."</td>
				<td>".number_format($subtotal, 2)." EGP</td>
			</tr>
		";
	}
	
	$output['total'] = '<b>'.number_format($total, 2).' EGP<b>';
	$pdo->close();
	echo json_encode($output);

?>