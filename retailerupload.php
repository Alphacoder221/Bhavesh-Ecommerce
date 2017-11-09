<?php
	require "config.php";
	require "header.php";
	if(($curr_user_type != "retailer") || !isset($curr_user_type)) {
		header("Location: index.php");
	}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Retailers @FeedAByte | Upload new product</title>
		<meta name="keyword" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
		<style type="text/css">
			.main-form {
				margin-top: 150px;
			}
			.form input {
				margin-bottom: 15px;
			}
		</style>
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<link href='https://fonts.googleaxpis.com/css?family=Signika' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Biryani|Secular+One' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<?php require "header.php" ?>

		<div class="container main-form">
			<h2>Upload A New Product</h2><hr />
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<form class="form" name="productUploadForm" method="POST" action="retailerpage.php" enctype="multipart/form-data">

						<input type="text" class="form-control" name="productName" placeholder="Product Name" required />

						<input type="text" class="form-control" name="productBrand" placeholder="Brand" required />

						<input type="text" class="form-control" name="productDescription" placeholder="Description" required />

						<input type="number" class="form-control" name="productPrice" placeholder="Price" required />

						<input type="text" class="form-control" name="productDiscount" placeholder="Discount" required/>

						<input type="text" class="form-control" name="productSearchKeywords" placeholder="Search Keywords"  required/>
						<select name="productCategory" class="form-control" required>
							<option value="" selected disabled hidden>Select a product category</option>
							<?php
								$sql = "SELECT product_category_id, product_category_name FROM product_category;";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
								if($result) {
									if(mysqli_num_rows($result) > 0) {
										while($row = mysqli_fetch_assoc($result)){
											echo "<option value=".$row['product_category_id'].">".$row['product_category_name']."</option>";
										}
									}
								}
							?>
						</select><br />

						<input type="text" class="form-control" name="productWarranty" placeholder="Enter the warranty description of the product" />

						<input type="file" class="form-control" name="fileToUpload1" accept="image/*" placeholder="Product Image" required />
						<input type="file" class="form-control" name="fileToUpload2" accept="image/*" placeholder="Product 2nd Image(optional)" />
						<input type="file" class="form-control" name="fileToUpload3" accept="image/*" placeholder="Product 3rd Image(optional)" />

						<button type="submit" name="submit" class="btn btn-info" style="width: 120px;">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<?php include "footer.php"; ?>
	</body>
</html>