<?php
	require "config.php";
	if(!isset($_GET['searchText'])) {
		header('Location: index.php');
	}
	$searchText = $_GET['searchText'];
	$output = "";
	$order_by = "";
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>You searched for : <?php echo $searchText; ?></title>
		<meta name="keyword" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/custom/search-results.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<link href='https://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<?php require "header.php" ?>

		<div class="container main-content">
			<div class="page-title">
				Search Results for "<?php echo $searchText; ?>"
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
					<div class="padded-content">
						<div class="filter">
							<?php
								$sql = "SELECT DISTINCT product_category_id AS `product_category_id` FROM products WHERE (product_name LIKE '%$searchText%') OR (product_search_keywords LIKE '%$searchText%');";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

								if(mysqli_num_rows($result) > 0) {
									echo "<div class=\"filter-title\">Type</div><hr/>";
									echo "<ul class='filter-group'>";

									while($row_id = mysqli_fetch_array($result)) {
										$productCategoryId = $row_id['product_category_id'];

										$sql = "SELECT product_category_name FROM product_category WHERE product_category_id = '$productCategoryId';";
										$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
										$row_name = mysqli_fetch_assoc($res);
										$productCategoryName = $row_name['product_category_name'];

										echo "<li><input type='checkbox' name='filter-info' value=\"product_category_id = '$productCategoryId'\"/>". $productCategoryName. "</li>";
									}
									echo "</ul>";
								}
							?>
						</div>
						<div class="filter">
							<?php
								$sql = "SELECT DISTINCT product_brand FROM products WHERE (product_name LIKE '%$searchText%') OR (product_search_keywords LIKE '%$searchText%') OR (product_brand LIKE '%$searchText%') ORDER BY product_rating DESC;";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

								if(mysqli_num_rows($result) > 0) {
									echo "<div class=\"filter-title\">Brands</div><hr/>";
									echo "<ul class='filter-group'>";

									while($row_id = mysqli_fetch_array($result)) {
										$productBrand = $row_id['product_brand'];

										echo "<li><input type='checkbox' name='filter-info' value=\"product_brand LIKE '%$productBrand%'\">". $productBrand. "</li>";
									}
									echo "</ul>";
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-sm-12">
					<div class="sort-by">
						<select name="sort-by" class="form-control" id="sort-by">
							<option value=" ORDER BY product_rating DESC" selected>Popularity</option>
							<optgroup label="Price">
								<option value=" ORDER BY product_price DESC">High to Low</option>
								<option value=" ORDER BY product_price">Low to High</option>
							</optgroup>
							<option value=" ORDER BY product_id DESC">New</option>
						</select>
					</div>
					<div class="row" id="search-results">
					</div>
				</div>
			</div>
		</div>

		<?php require "footer.php" ?>

		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>

		<script type="text/javascript">
			function GetURLParameter(sParam) {
				var sPageURL = window.location.search.substring(1);
				var sURLVariables = sPageURL.split('&');
				for (var i = 0; i < sURLVariables.length; i++) {
					var sParameterName = sURLVariables[i].split('=');
					if (sParameterName[0] == sParam) {
						return decodeURIComponent(sParameterName[1]);
					}
				}
			}
		</script>

		<script type="text/javascript">
			var searchKey = GetURLParameter('searchText');
			var xyz = " ORDER BY product_rating";
			var choices = "";

			function myChoices() {
				var choiceArray = document.getElementsByName('filter-info');
				var choices = "";
				for (i = 0; i < choiceArray.length; i++) {
					if (choiceArray[i].checked) {
						if(choices == "") {
							choices += "AND (" + choiceArray[i].value + ")";
						}
						else {
							choices += "OR (" + choiceArray[i].value + ")";
						}
					}
				}
				$.post("resultsfromhere.php", {'sortBy':xyz, 'searchText':searchKey, 'choiceTicks':choices}, function(data){
					$('#search-results').html(data);
				});
			}

			$(document).ready(function() {
				$.post("resultsfromhere.php", {'sortBy':xyz, 'searchText':searchKey, 'choiceTicks':choices}, function(data){
					$('#search-results').html(data);
					$('.add-to-cart').click(function(){
						var val = $(this).find('input[type="hidden"]').val();
						$.post("CartEdit.php", {'product_id':val, 'add_remove':"add"}, function (data) {});
						$(this).addClass('alerady-selected');
					});

					$('.add-to-wishlist').click(function(){
						var val = $(this).find('input[type="hidden"]').val();
						$.post("wishlistEdit.php", {'product_id':val, add_remove:"add"}, function (data) {});
						$(this).addClass('already-selected');
					});
				});

				$("#sort-by").change(function() {
					xyz = $('#sort-by').val();
					$.post("resultsfromhere.php", {'sortBy':xyz, 'searchText':searchKey, 'choiceTicks':choices}, function(data){
						$('#search-results').html(data);
					});
				});

				$('input[type="checkbox"]').click(function() {
					myChoices();
				});
			});
		</script>

	</body>
</html>
