<?php
include"db.php";	
	$price  = $_POST['price'];
	$quantity  = $_POST['quantity'];
	$item = $_POST['item'];
	$discount  = $_POST['discount'];
	$name  = $_POST['name'];
	$date  = $_POST['date'];
	$unit  = $_POST['unit'];
	$flag = uniqid();

	for ($i=0; $i < count($price) ; $i++) { 
		json_decode($price[$i]);
		json_decode($quantity[$i]);
		json_decode($discount[$i]);
		json_decode($flag);
		json_decode($unit[$i]);

		 $sql = "INSERT INTO cart ( itemName,quantity,discount,price,customerName,date,uniqueID,unitPrice) VALUES ('$item[$i]','$quantity[$i]','$discount[$i]','$price[$i]','$name','$date','$flag','$unit[$i]')";

		 $conn->query($sql);
	}
?>