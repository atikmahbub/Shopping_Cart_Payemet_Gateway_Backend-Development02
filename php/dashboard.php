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
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/dash.css?v=<?php echo time(); ?>">
</head>
<body>

	<div class="container">
		<a href="logout.php">
			<button type="button" name="out" class="btn btn-danger float-right" >SIGN OUT
			</button>
		</a>


		<h2>Dashboard</h2>
		<p><strong>Click</strong> each item to create list</p>
		<div id="accordion">
			<div class="card">
				<div class="card-header">
					<a class="card-link" data-toggle="collapse" href="#collapseOne">
						Create Customer
					</a>
				</div>
				<div id="collapseOne" class="collapse show" data-parent="#accordion">
					<div class="card-body">
						<form method="post" >
							<input type="text" class="input101" name="customer"  placeholder="Customer Name" required >
							<input type="text" class="input101" name="cAddress" placeholder="Address" required>
							<input type="email" class="input101" name="cEmail" placeholder="Email" required>
							<button type="submit"  name="customerButton" class="btn btn-primary login-101">Create</button>
						</form>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
						Create Product
					</a>
				</div>
				<div id="collapseTwo" class="collapse" data-parent="#accordion">
					<div class="card-body">
						<form method="post">
							<input type="text" class="input101" name="product" placeholder="Product Name" required>
							<input type="text" class="input101" name="category" placeholder="Category" required>
							<input type="text" class="input101" name="description" placeholder="Discription" required>
							<button type="submit"  name="productButton" class="btn btn-primary login-101">Create</button>
						</form>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
						Create Invoice
					</a>
				</div>
				<form id="add_name" name="add_name" autocomplete="off" >
					<div id="collapseThree" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<div class="form-group">
								<label for="exampleSelect1">Customer Name</label>
								<select class="form-control" id="exampleSelect1" style="width: 50%">
									<?php
									include"db.php";
									$result = $conn->query("select name from customer order by id DESC");
									while ($row = $result->fetch_assoc()) {
										$username = $row['name'];
										echo '<option value=" '.$username.'"  >'.$username.'</option>';
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label for="exampleSelect2">Currency</label>
								<select class="form-control" id="exampleSelect2" style="width: 50%">
									<option value="$">Dollar</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleSelect3">Date</label><br>
								<input type="date" class="saleInput" id="exampleSelect3"  data-date-format="DD MMMM YYYY" style="width: 50%">
							</div>
							<div>
								<table class="table table-hover" style="margin-top: 10%;" id="dynamic_field">
									<thead>
										<tr class="table-info">
											<th >Item Code</th>
											<th  class="w-25">Item Name</th>
											<th>Quantity</th>
											<th>Unit Price</th>
											<th>Discount</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="search" name="search" class="saleInput" placeholder="search"></td>
											<td >
												<select id="item_selection" class="saleInput" style="width: 100%">
													<?php
													include"db.php";
													$result = $conn->query("select description from producttable order by id DESC");
													while ($row = $result->fetch_assoc()) {
														$username = $row['description'];
														echo '<option value=" '.$username.'">'.$username.'</option>';
													}
													?>

												</select>
											</td>
											<td><input type="number" name="quantity[]" id="quantity" onchange="handleChange()" class="saleInput" value="1" required></td>
											<td><input type="tele" name="price"  id="price" onchange="handleChange()" class="saleInput" placeholder="0.00" ></td>
											<td><input type="tele" id="discount" name="discount[]" class="saleInput" placeholder="0%" ></td>
											<td><input id="total" type="tele" name="ammount[]" placeholder="0.00" disabled></td>
											<td><button type="button" name="selection" id="add" onclick="handleChange()" class="tick">&#10004;</button></td>

										</tr>
										<script type="text/javascript">
											function handleChange(){
												const x = document.getElementById('price').value;
												const y = document.getElementById('quantity').value;
												const z = document.getElementById('discount').value;
												if(isNaN(x) || isNaN(y) ){
													alert('Invalid Input');
												}
												else if(parseInt(z) > 0){
													const disc = (x*y*z)/100;
													total =  (x*y) - disc;
												}
												else{
													total = (x * y);
												}
												document.getElementById("total").value= total;
											}

										</script>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
								<div class="form-group row">
									<label for="totalAmmount" class="col-sm-2 col-form-label level">Total Ammount</label>
									<div class="col-sm-10">
										<input type="tele" class="form-control" id="showAmmount" value="" placeholder="0.00" disabled>
									</div>
								</div>
								<button type="submit" name="list" id="submit" class="btn btn-danger float-right" >Confirm Listed items</button>
							</form>
						</div>


					</div>
				</div>


			</div>
			<div class="container ">
			<form method="POST" action="view.php" class="float-right">
				<button type="submit" name="viewInvoice" class="btn btn-success float right">View Invoice</button>
			</form>
			</div>
		</div>


	</div>
	<?php
	include"db.php";

	if(isset($_POST['customerButton'])){
		$cName = $_POST['customer'];
		$cAddress = $_POST['cAddress'];
		$cEmail = $_POST['cEmail'];

		$sql = "INSERT INTO customer (name,address,email) VALUES ('$cName','$cAddress','$cEmail')";

		if ($conn->query($sql) === TRUE) {

			echo "<script type='text/javascript'>
			alert('Saved Successfully(Customer)')
			window.location='dashboard.php';
			</script>";
		}

		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	elseif (isset($_POST['productButton'])) {
		
		$pName = $_POST['product'];
		$category = $_POST['category'];
		$description  = $_POST['description'];

		$sql = "INSERT INTO producttable (product,category,description) VALUES ('$pName','$category','$description')";

		if ($conn->query($sql) === TRUE) {

			echo "<script type='text/javascript'>
			alert('Saved Successfully(Product)')
			window.location='dashboard.php';
			</script>";	
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	?>
</body>
<script type="text/javascript">
	$(document).ready(function(){  
		var i=0;
		var arr_price = [];
		var arr_quantity = [];
		var arr_discount = [];
		var arr_item = [];
		var arr_unit = [];
		var grand = 0;
		$('#add').click(function(){  

			const item = $( "#item_selection" ).val();
			const quantity = $( "#quantity" ).val();
			const price = $( "#price" ).val();
			const discount = $( "#discount" ).val();
			const ammount = $( "#total" ).val();
			arr_price.push(total);
			arr_quantity.push(quantity);
			arr_discount.push(discount);
			arr_item.push(item);
			arr_unit.push(price)
			let grand = arr_price.reduce((a, b) => a + b, 0).toPrecision(8);
			document.getElementById('showAmmount').value = grand + "$";
			i++;  
			$('#dynamic_field').append('<tr id="row'+i+'"><td></td><td> <input type="text" class="menu" value=" '+ item + '" disabled/></td> <td><input type="text" class="menu" value=" '+ quantity + '" disabled/></td> <td> <input type="text" name="price[]" id="item_price" class="menu" value=" '+ price + '" disabled/></td><td><input type="text" class="menu" value=" '+ discount+''+"%" +'" disabled/></td><td><input type="text" class="menu" value=" '+ ammount + '" disabled/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

		});  

		$(document).on('click', '.btn_remove', function(){ 

			var button_id = $(this).attr("id"); 
			i--;
			arr_price.splice(button_id-1,1,0);
			arr_quantity.splice(button_id-1,1,0);
			arr_discount.splice(button_id-1,1,0);
			arr_item.splice(button_id-1,1,0);
			arr_unit.splice(button_id-1,1,0);

			let grand = arr_price.reduce((a, b) => a + b, 0);

			document.getElementById('showAmmount').value = grand + "$";
			if(grand === 0){
				arr_price = arr_quantity = arr_item = arr_discount = arr_unit = [];

			}
			$('#row'+button_id+'').remove(); 
		});

		$('#submit').click(function(){  
			JSON.stringify(arr_price);
			JSON.stringify(arr_item);
			JSON.stringify(arr_discount);
			JSON.stringify(arr_quantity);
			JSON.stringify(arr_unit);
			const customerName = $( "#exampleSelect1" ).val();
			const date = $( "#exampleSelect3" ).val();
			$.ajax({  
				url:"invoice.php",  
				method:"POST",  
				data: {
					'price': arr_price,
					'quantity' : arr_quantity,
					'item' : arr_item,
					'discount' : arr_discount,
					'name' : customerName,
					'date' : date,
					'unit' : arr_unit,

				},  
				success:function(data)  
				{  
					alert(data);
				} ,
				error : function()
				{
					alert('savedError');
				},
			});  
		});  
	});  

</script>
</html>
