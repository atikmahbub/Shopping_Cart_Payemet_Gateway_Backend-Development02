<?php

session_start();
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
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/view.css?v=<?php echo time(); ?>">
</head>
<body>

	<div class="container">
		<a href="logout.php">
			<button type="button" name="out" class="btn btn-danger float-right" >SIGN OUT
			</button>
		</a>
		<div class="center"> <h2>Invoice List</h2> </div>
		<?php

		include 'db.php';
		if(isset($_POST['viewInvoice'])){

			echo "<table class='table table-hover table-dark table-striped'>
			<tr class='table-inf0'>
			<th>Transaction Number</th>
			<th>Name</th>
			<th>Date</th>
			<th>View invoice</th>
			</tr>
			";
			$sql = "SELECT * from cart group by uniqueID DESC";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row['uniqueID'] ."</td>";
				echo "<td>" . $row['customerName'] ."</td>";
				echo "<td>" . $row['date'] ."</td>";
				echo '<td><a href="viewInvoice.php?transactionID=' . $row['uniqueID'] . '">View</a></td>';
				echo "</tr>";
			}
			echo "</table>";
		}
		?>
	</div>
</body>
</html>