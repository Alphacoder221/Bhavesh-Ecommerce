<?php
	require "config.php";
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Index @ Clothezz</title>
		<meta name="keyword" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css">
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/custom/index.css" />
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<?php require "header.php" ?>

		<div class="container" style="margin-top: 135px;">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="card">
						<div class="card-header">
							<h4>Explore By Category</h4><hr /></div>
						<ul class="nav categories">
							<li>
								<a href="search-results.php?search_form=&searchText=formals">
									<img src="img/icons/formals.png" class="" /> &nbsp; Formals</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=party">
									<img src="img/icons/party.png" class=""> &nbsp; Party Wear's</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=sports">
									<img src="img/icons/sports.png" class=""> &nbsp; Sport's Wear</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=TShirt">
									<img src="img/icons/tshirt.png" class="" /> &nbsp; T-Shirts</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=shirt">
									<img src="img/icons/shirt.png" class="" /> &nbsp; Shirts</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=jackets">
									<img src="img/icons/jacket.png" class="" /> &nbsp; Jackets</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=coat">
									<img src="img/icons/coat.png" class="" /> &nbsp; Coat</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=pants">
									<img src="img/icons/pant.png" class="" /> &nbsp; Pants</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=jeans">
									<img src="img/icons/jeans.png" class="" /> &nbsp; Jeans</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=trousers">
									<img src="img/icons/lowers.png" class="" /> &nbsp; Lowers</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=shorts">
									<img src="img/icons/shorts.png" class="" /> &nbsp; Shorts</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=swim">
									<img src="img/icons/swimwear.png" class="" /> &nbsp; Swim Wear's</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=undergarments">
									<img src="img/icons/undergarment.png" class="" /> &nbsp; Undergarments </a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=accessories">
									<img src="img/icons/accessories.png" class=""> &nbsp; Accessories</a></li>
						</ul>
					</div>
					<div class="card">
						<div class="card-header">
							<h4>Explore By Seasons</h4><hr /></div>
						<ul class="nav categories">
							<li>
								<a href="search-results.php?search_form=&searchText=winter">
									<img src="img/icons/winter.png" class="" /> &nbsp; Winter</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=tshirts">
									<img src="img/icons/summer.png" class=""> &nbsp; Summer</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=tshirts">
									<img src="img/icons/monsoon.png" class=""> &nbsp; Monsoon</a></li>
						</ul>
					</div>
					<div class="card">
						<div class="card-header">
							<h4>Explore by Brand</h4><hr /></div>
						<ul class="nav categories">
							<li>
								<a href="search-results.php?search_form=&searchText=lee">
									<img src="img/icons/tshirt.png" class=""> &nbsp; LEE</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=pepe">
									<img src="img/icons/tshirt.png" class=""> &nbsp; Pepe Jeans</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=wrangler">
									<img src="img/icons/tshirt.png" class=""> &nbsp; Wrangler</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=jackandjones">
									<img src="img/icons/tshirt.png" class=""> &nbsp; Jack And Jones</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=killer">
									<img src="img/icons/tshirt.png" class=""> &nbsp; Killer</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=lawman">
									<img src="img/icons/tshirt.png" class=""> &nbsp; Lawman</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=yepme">
									<img src="img/icons/tshirt.png" class=""> &nbsp; YepMe</a></li>
							<li>
								<a href="search-results.php?search_form=&searchText=carlous">
									<img src="img/icons/tshirt.png" class=""> &nbsp; Carlous</a></li>
					</ul>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<div class="carousel slide" id="main_carousel" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								<img src="img/index/carousel/01.jpg" alt="image could not be loaded" />
								<div class="carousel-caption">
								</div>
							</div>
							<div class="item">
								<img src="img/index/carousel/02.jpg" alt="image could not be loaded" />
								<div class="carousel-caption">
								</div>
							</div>
							<div class="item">
								<img src="img/index/carousel/03.jpg" alt="image could not be loaded" />
								<div class="carousel-caption">
								</div>
							</div>
							<div class="item active">
								<img src="img/index/carousel/04.jpg" alt="image could not be loaded" />
								<div class="carousel-caption">
								</div>
							</div>
							<div class="item active">
								<img src="img/index/carousel/05.jpg" alt="image could not be loaded" />
								<div class="carousel-caption">
								</div>
							</div>
						</div>
						<a href="#main_carousel" class="left carousel-control" role="button" data-slide="prev">
							<i class="fa fa-arrow-circle-left fa-2x"></i>
						</a>
						<a href="#main_carousel" class="right carousel-control" role="button" data-slide="next">
							<i class="fa fa-arrow-circle-right fa-2x"></i>
						</a>
					</div>
					<div class="carousel-pointers">
						<ul class="nav">
							<li class="active" data-target="#main_carousel" data-slide-to="0">
								<div class="carousel-heading"></div>
								<div class="carousel-data"></div>
							</li>
							<li class="active" data-target="#main_carousel" data-slide-to="1">
								<div class="carousel-heading"></div>
								<div class="carousel-data"></div>
							</li>
							<li class="active" data-target="#main_carousel" data-slide-to="2">
								<div class="carousel-heading"></div>
								<div class="carousel-data"></div>
							</li>
							<li class="active" data-target="#main_carousel" data-slide-to="3">
								<div class="carousel-heading"></div>
								<div class="carousel-data"></div>
							</li>
							<li class="active" data-target="#main_carousel" data-slide-to="4">
								<div class="carousel-heading"></div>
								<div class="carousel-data"></div>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="card card-md-wide">
										<div class="card-image">
											<img src="img/index/pics/05.jpg" class="img-responsive" />
										</div>
										<div class="card-info">
											<div class="card-title">
											</div>
											<div class="card-data">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="card card-md-wide">
										<div class="card-image">
											<img src="img/index/pics/04.jpg" class="img-responsive" />
										</div>
										<div class="card-info">
											<div class="card-title">
											</div>
											<div class="card-data">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="card card-lg-long">
								<div class="card-inline-image card-image-left card-image">
									<img src="img/index/pics/02.jpg" class="img-responsive" />
								</div>
								<div class="card-info">
									<div class="card-title">
									</div>
									<div class="card-data">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
							<div class="card card-sm-long">
								<div class="card card-wide">
									<div class="card-inline-image card-image-left card-image">
										<img src="img/index/pics/06.jpg" class="img-responsive" />
									</div>
									<div class="card-info">
										<div class="card-title">
										</div>
										<div class="card-data">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
							<div class="card card-md-wide">
								<div class="card-image">
									<img src="img/index/pics/01.jpg" class="img-responsive" />
								</div>
								<div class="card-info">
									<div class="card-title">
									</div>
									<div class="card-data">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="card card-sm-wide">
										<div class="card-image">
											<img src="img/index/pics/03.jpg" class="img-responsive" />
										</div>
										<div class="card-info">
											<div class="card-title">
											</div>
											<div class="card-data">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="card card-sm-wide">
										<div class="card-image">
											<img src="img/index/pics/04.jpg" class="img-responsive" />
										</div>
										<div class="card-info">
											<div class="card-title">
											</div>
											<div class="card-data">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br />
					<img src="img/index/pics/07.jpg" class="img-responsive" />
				</div>
			</div>
		</div><br />

		<?php include "footer.php"; ?>
		
		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('.dropdown-submenu a.dropdown-toggler').click(function(e){
					$(this).next('ul').toggle();
					e.stopPropagation();
					e.preventDefault();
				});
			});
		</script>
	</body>
</html>