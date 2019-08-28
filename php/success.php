<?php
include"db.php";
$itemTransaction   = $_REQUEST['tx']; // Paypal transaction ID
$itemPrice         = $_REQUEST['amt']; // Paypal received amount
$itemCurrency      = $_REQUEST['cc']; 
$price=$_GET['price'];
$name -$_GET['name'];
$total -$_GET['total'];
$currency='USD';
$sql = "SELECT email from customer WHERE name ='$name'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$userEmail =  $row["email"];
}
if($itemPrice==$price && $itemCurrency==$currency)
{
	$to = $userEmail;
	$subject = "payment Successful";
	$txt = "Payment Successful , Total Ammount : " . $total . "Thank You.";
	$headers = "From: Paypal.com";
	mail($to,$subject,$txt,$headers);
}
else
{
	echo "Payment Failed";
}

?>