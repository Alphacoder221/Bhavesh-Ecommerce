<?php require "config.php" ?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Home @ Clothezz: Find the best deals for clothes in here</title>
		<meta name="keyword" content="Clothes, Clothez, Clothezz, Clothess, Cheapest clothes online, Buy clothes online, Online cloth shop, Best clothes online" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/custom/home.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
        <style>
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 100; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
            }
            
            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 1.5% auto; /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
                border-radius: 2px;
                height: 90%;
                padding-bottom: 30px;
                box-shadow: 0 0 50px 10px rgba(0, 0, 0, 0.8);
            }
            
            /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 20px;
                font-weight: bold;
                position: relative;
                top: -15px;
            }
            
            .close:hover, .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
	</head>
	<body>
		<?php require "header.php" ?>
        
		<div class="container">
			<div class="first-content">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
						<div id="carousel-main" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-main" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-main" data-slide-to="1"></li>
								<li data-target="#carousel-main" data-slide-to="2"></li>
							</ol>

							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<img src="img/index/carousel/01.jpg" alt="...">
									<div class="carousel-caption"></div>
								</div>
								<div class="item">
									<img src="img/index/carousel/02.jpg" alt="...">
									<div class="carousel-caption"></div>
								</div>
								<div class="item">
									<img src="img/index/carousel/03.jpg" alt="...">
									<div class="carousel-caption"></div>
								</div>
							</div>

							<a class="left carousel-control" href="#carousel-main" role="button" data-slide="prev">
								<span aria-hidden="true"><i class="fa fa-arrow-circle-left fa-2x"></i></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel-main" role="button" data-slide="next">
								<span aria-hidden="true"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
						<div class="carousel-right-content">
							<div class="card">
								<div class="info-card">
									<div class="row">
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
											<div class="card-data">
												<h4>Shop More Pay Less</h4>
												<h5>Additional 5% discount on shopping with credit cards</h5>
												<a href="#" class="know-more">Know More</a>
												<a href="#" class="t-and-c">T&C Apply*</a>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<div class="icon">
												<i class="fa fa-shopping-bag fa-2x"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="info-card">
									<div class="row">
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
											<div class="card-data">
												<h4>Shop More Pay Less</h4>
												<h5>Additional 5% discount on shopping with credit cards</h5>
												<a href="#" class="know-more">Know More</a>
												<a href="#" class="t-and-c">T&C Apply*</a>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<div class="icon">
												<i class="fa fa-shopping-bag fa-2x"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="info-card">
									<div class="row">
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
											<div class="card-data">
												<h4>Shop More Pay Less</h4>
												<h5>Additional 5% discount on shopping with credit cards</h5>
												<a href="#" class="know-more">Know More</a>
												<a href="#" class="t-and-c">T&C Apply*</a>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<div class="icon">
												<i class="fa fa-shopping-bag fa-2x"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-title">
					Best Deals<button type="button" class="btn btn-viewmore">View More</button>
				</div>
				<div class="card-body">
					<div class="card-content">
						<ul class="horizontal-scroll-content">
							<?php
								$sql = "SELECT * FROM products ORDER BY product_discount_percent DESC LIMIT 10";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
								if(mysqli_num_rows($result)>0) {
									 while($row = mysqli_fetch_array($result)) {
										 $product_name = $row['product_name'];
										 $product_id = $row['product_id'];
										 $product_iframe_link = "iframeProduct.php?id=".$product_id;
										 $product_link = "product.php?id=".$product_id;
                                         $product_discount_percent = $row['product_discount_percent'];
										 $product_brand = $row['product_brand'];
										 $product_pic_url = $row['product_pic_1_url'];

										 echo "<li>
											<div class='quicklook'>
												<a atr='$product_iframe_link' class='btn'>Quick Look</a>
											</div>
											<div class='item'>
												<div class='item-pic'>
													<img src=". $product_pic_url. " />
												</div>
												<div class='item-info'>
													<div class='add-btn'>
														<div class='add-to-wishlist'>
															<input type='hidden' name='product-id' value=$product_id />
															<i class='fa fa-heart-o fa-lg'></i>
														</div>
														<div class='add-to-cart'>
															<input type='hidden' name='product-id' value=$product_id />
															<i class='fa fa-cart-plus fa-lg'></i>
														</div>
													</div>
													<div class='item-name'><a href=$product_link>$product_name</a></div>
													<div class='item-offer'>FLAT $product_discount_percent% OFF</div>
													<div class='item-spec'>$product_brand</div>
												</div>
											</div>
										</li>";
									 }
								}
							?>
						</ul>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-title">
					New And Upcoming <button type="button" class="btn btn-viewmore">View More</button>
				</div>
				<div class="card-body">
					<div class="card-content">
						<ul class="horizontal-scroll-content">
							<?php
								$sql = "SELECT * FROM products ORDER BY product_timestamp DESC LIMIT 10";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
								if(mysqli_num_rows($result)>0) {
									while($row = mysqli_fetch_array($result)) {
										$product_name = $row['product_name'];
										$product_iframe_link = "iframeProduct.php?id=".$row['product_id'];
										 $product_link = "product.php?id=".$product_id;
										$product_discount_percent = $row['product_discount_percent'];
										$product_brand = $row['product_brand'];
										$product_pic_url = $row['product_pic_1_url'];
										echo "<li>
											<div class='quicklook'>
												<a atr='$product_iframe_link' class='btn'>Quick Look</a>
											</div>
											<div class='item'>
												<div class='item-pic'>
													<img src=". $product_pic_url. " />
												</div>
												<div class='item-info'>
													<div class='add-btn'>
														<a href=><div class='add-to-wishlist'>
															<input type='hidden' name='product-id' value=$product_id />
															<i class='fa fa-heart-o fa-lg'></i>
														</div></a>
														<div class='add-to-cart'>
															<input type='hidden' name='product-id' value=$product_id />
															<i class='fa fa-cart-plus fa-lg'></i>
														</div>
													</div>
													<div class='item-name'><a href=$product_link>$product_name</a></div>
													<div class='item-offer'>FLAT $product_discount_percent% OFF</div>
													<div class='item-spec'>$product_brand</div>
												</div>
											</div>
										</li>";
									}
								}
							?>
						</ul>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-title">
					Popular These Days <button type="button" class="btn btn-viewmore">View More</button>
				</div>
				<div class="card-body">
					<div class="card-content">
						<ul class="horizontal-scroll-content">
							<?php
								$sql = "SELECT * FROM products ORDER BY product_rating, product_timestamp DESC LIMIT 10";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
								if(mysqli_num_rows($result)>0) {
									while($row = mysqli_fetch_array($result)) {
										$product_name = $row['product_name'];
										$product_id = $row['product_id'];
										$product_iframe_link = "iframeProduct.php?id=".$product_id;
										 $product_link = "product.php?id=".$product_id;
										$product_discount_percent = $row['product_discount_percent'];
										$product_brand = $row['product_brand'];
										$product_pic_url = $row['product_pic_1_url'];
										echo "<li>
											<div class='quicklook'>
												<a atr='$product_iframe_link' class='btn'>Quick Look</a>
											</div>
											<div class='item'>
												<div class='item-pic'>
													<img src=". $product_pic_url. " />
												</div>
												<div class='item-info'>
													<div class='add-btn'>
														<div class='add-to-wishlist'>
															<input type='hidden' name='product-id' value=$product_id />
															<i class='fa fa-heart-o fa-lg'></i>
														</div>
														<div class='add-to-cart'>
															<input type='hidden' name='product-id' value=$product_id />
															<i class='fa fa-cart-plus fa-lg'></i>
														</div>
													</div>
													<div class='item-name'><a href=$product_link>$product_name</a></div>
													<div class='item-offer'>FLAT $product_discount_percent% OFF</div>
													<div class='item-spec'>$product_brand</div>
												</div>
											</div>
										</li>";
									}
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
        
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">x</span>
                <iframe src="" id="modalIframe" style="width: 100%; height:  100%;"></iframe>
            </div>
        </div>

		<?php require "footer.php" ?>

		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".add-to-cart:not(.dont-click").click(function(){
					var val = $(this).find('input[type="hidden"]').val();
					$.post("cartEdit.php", {'product_id':val, 'add_remove':"add"}, function (data) {
                        var cart_product_count = parseInt(document.getElementById('cart_item_count').innerText);
                        document.getElementById('cart_item_count').innerText = cart_product_count + 1;
					});
                    $(this).css('cursor','not-allowed');
                    $(this).css('opacity','0.8');
                    $(this).addClass('dont-click');
				});
				$('.add-to-wishlist').click(function(){
					var val = $(this).find('input[type="hidden"]').val();
					$.post("wishlistEdit.php", {'product_id':val, 'add_remove':"add"}, function (data) {});
					$(this).css('cursor','not-allowed').css('opacity','0.8');
				});
			});
		</script>
        <script>
            var modal = document.getElementById('myModal');
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
        <script>
            $('.quicklook').find('a').click(function(){
                var href = $(this).attr('atr');
                document.getElementById('modalIframe').innerHtml = "";
                $('#modalIframe').attr('src', href);
                $('#myModal').css('display', 'block');
            });
        </script>
	</body>
</html>