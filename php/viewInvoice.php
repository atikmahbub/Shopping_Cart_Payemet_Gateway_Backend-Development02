<?php 
session_start();
$id=$_GET['transactionID'];
include"db.php";
if(empty($_SESSION['username'])){
	echo "<script type='text/javascript'>
	window.location='../index.php';
	alert('You Need To Log In First');
	</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/invoice.css?v=<?php echo time(); ?>">
</head>
<body>
	<div class="container">
		<a href="logout.php">
			<button type="button" name="out" class="btn btn-danger float-right" >SIGN OUT
			</button>
		</a>
		<div class="center"><h2>Full Invoice</h2></div>
		<div class="upper">
			<div class="upperLeft">
				<div>Name : 
					<?php
					$sql = "SELECT DISTINCT customerName FROM cart WHERE uniqueID='$id'";
					$result = $conn->query($sql);

					while($row = $result->fetch_assoc()) {
						global $variable;
						$variable = $row["customerName"];
						echo $row["customerName"];
					}
					?>
				</div>
				<div>Email :
					<?php

					$sql2 = "SELECT * FROM customer WHERE name = '$variable' ";
					$result2 = $conn->query($sql2);

					while($row = $result2->fetch_assoc()) {
						echo $row["email"];
					}
					?>

				</div>
			</div>
			<div class="upperRight">
				<div>Date :
					<?php
					$sql = "SELECT DISTINCT date FROM cart WHERE uniqueID='$id'";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) {
						echo $row["date"];
					}
					?>
				</div>
				<div>Transaction Id : 
					<?php
					$sql = "SELECT DISTINCT uniqueID FROM cart WHERE uniqueID='$id'";
					$result = $conn->query($sql);
					    // output data of each row
					while($row = $result->fetch_assoc()) {
						echo $row["uniqueID"];
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<?php 
		echo "<table class='table table-hover table-striped'>
		<thead class='thead-dark'>
		<tr class='table-inf0'>
		<th>Item Name</th>
		<th>Quantity</th>
		<th>Unit Price</th>
		<th>Discount</th>
		<th>Total</th>
		</tr>
		";
		$sql = "SELECT * from cart where uniqueID='$id' ";
		$result = mysqli_query($conn,$sql);
		$flag = 0;
		while($row = mysqli_fetch_array($result)) {
			global $total;
			global $disc;
			$flag+=1;
			echo "<tr>";
			echo "<td>" . $row['itemName'] ."</td>";
			echo "<td>" . $row['quantity'] ."</td>";
			echo "<td>" . $row['unitPrice']  ."</td>";
			echo "<td>" . $row['discount'] ."%"."</td>";
			echo "<td>" . $row['price'] ."</td>";
			$total = $total + $row['price'];
			$disc = $disc + $row['discount'];
			echo "</tr>";
		}
		echo "</thread>";
		echo "</table>";
		?>
	</div>
	<div class="container "> 
		<div class="ammount">Total Ammount :
			<?php
			echo "$total"."$";
			?>
		</div>
	</div>
	<?php
	include"db.php";
	$test = $_SESSION['username'] ;
	$paypal_url='https://www.paypal.com/cgi-bin/webscr';
	$sql1 = "SELECT * from signup WHERE  userName = '$test' "  ;
	$result1 = $conn->query($sql1);
	while($row = $result1->fetch_assoc()) {
		$paypal_id =   $row["email"];
	}
	?>

	<div class="container paypal_button">
		<form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
			<input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="item_number" value="1">
			<input type="hidden" name="credits" value="300">
			<input type="hidden" name="userid" value="1">
			<input type="hidden" name="amount" value="<?php echo$total  ?>">
			<input type="hidden" name="no_shipping" value="<?php echo$flag ?>">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="handling" value="0">
			<input type="hidden" name="cancel_return" value="cancel.php">
			<input type="hidden" name="return" value="success.php?price= <?php echo$total ?> &name = <?php echo$variable ?> &total=<?php echo$total ?>">
			<button type="submit" class="btn btn-danger float-right"  name="submit" value="Pay Now"> Pay Now </button>
		</form>
	</div>
</body>
</html>