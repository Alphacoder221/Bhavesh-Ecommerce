<?php
	require "config.php";

	if(($curr_user_type != 'retailer') || !isset($curr_user_type)) {
		header('Location: index.php');
	}

	$uploadErr = "Sorry, there was an error uploading your file.<br />";

	if(isset($_POST['submit'])) {
		$imageCount = 1;
		$productName = $_POST['productName'];
		$productPrice = $_POST['productPrice'];
		$productDescription = $_POST['productDescription'];
		$productDiscount = $_POST['productDiscount'];
		$productSearchKeywords = $_POST['productSearchKeywords'];
		$productCategory = $_POST['productCategory'];
		$productBrand = $_POST['productBrand'];
		$productWarranty = $_POST['productWarranty'];

		$sql = "INSERT INTO products(product_category_id ,product_name, product_brand, retailer_id, product_price, product_discount_percent, product_description, product_search_keywords, warranty_info) VALUES ('$productCategory','$productName', '$productBrand', '$curr_user_id', '$productPrice', '$productDiscount','$productDescription', '$productSearchKeywords','$productWarranty');";

		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		if(!$result) {
			$uploadErr = "There was an error in upload";
		}

		while($imageCount<=3) {
			$productImage = 'fileToUpload'.$imageCount;
			if($_FILES[$productImage]['name'] != "") {
				$target_dir = "img/items/";
				$_FILES[$productImage]["name"] = strtotime("now").$_FILES[$productImage]['name'];
				$target_file = $target_dir . basename($_FILES[$productImage]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES[$productImage]["tmp_name"]);
					if($check !== false) {
						$uploadOk = 1;
					} else {
						$uploadOk = 0;
					}
				}
				if (file_exists($target_file)) {
					$uploadOk = 0;
				}
				if ($_FILES[$productImage]["size"] > 500000) {
					$uploadOk = 0;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					$uploadOk = 0;
				}
				if ($uploadOk == 0) {
				}
				else {
					if (move_uploaded_file($_FILES[$productImage]["tmp_name"], $target_file)) {
						$sql = "UPDATE `products` SET product_pic_". $imageCount. "_url = '$target_file' WHERE product_name = '$productName';";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						$uploadErr = "";
					}
				}
			}
			$imageCount = $imageCount+1;
		}
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
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.min.css" />
		<style type="text/css">
			.main-form {
				margin-top: 150px;
			}
			.form input {
				margin-bottom: 15px;
			}
		</style>
		<link rel="stylesheet" href="css/custom/retailerpage.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<link href='https://fonts.googleaxpis.com/css?family=Signika' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Biryani|Secular+One' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<?php require "header.php"; ?>

		<div class="container">
			<div class="main-content">
				<?php
					$sql = "SELECT * FROM products WHERE retailer_id = $curr_user_id";
					$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					if(mysqli_num_rows($result) > 0) {
						echo "<table class='table-bordered'><tr><th>Item</th><th>Product Brand</th><th>Prices</th></tr>";
						while($row = mysqli_fetch_array($result)) {
							$product_name = $row['product_name'];
							$product_id = $row['product_id'];
							$product_description = $row['product_description'];
							$product_price = $row['product_price'];
							$product_warranty_info = $row['warranty_info'];
							$product_pic_url = $row['product_pic_1_url'];
							$product_brand = $row['product_brand'];
							$product_discount_percent = $row['product_discount_percent'];
							$product_new_price = $product_price - $product_price*$product_discount_percent/100;
							echo "<tr>
							<td>
								<div class='row'>
									<div class='col-lg-3 col-md-3 col-sm-3 col-xs-4'>
										<div class='item-img'>
											<img src=$product_pic_url class='img-responsive' />
										</div>
									</div>
									<div class='col-lg-9 col-md-9 col-sm-9 col-xs-8'>
										<div class='item-title'>$product_name</div>
										<div class='item-basic-info'>$product_description</div>
										<div class='item-warranty-info'>$product_warranty_info</div>
									</div>
								</div>
							</td>
							<td>
								$product_brand
							</td>
							<td>
								<div class='price-category'>
									Old Price: <span class='old-price'>$product_price</span> Rs
								</div>
								<div class='price-category'>
									New Price: <span class='new-price'>$product_new_price</span> Rs
								</div>
							</td>
						</tr>";
						}
						echo "</table>";
					}
					else {
						echo "<h3>No porduct uploaded yet</h3></h3><br />";
					}
 				?>
				<h5><a href="retailerupload.php">Upload A Product</a></h5>
			</div>
		</div>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	</body>
</html>
