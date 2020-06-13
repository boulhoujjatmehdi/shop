
<?php 
use Illuminate\Support\Facades\Cookie;

?>

@if (Auth::user())
	<?php $authconnect=Auth::user()->id ?>
@else
	<?php $authconnect= 0 ?>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{url('/')}}/images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition" onload="filterFunc()">

	<!-- Header -->
	<header class="header1" onload="valueInc()">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				
					
					@if (session()->has('status'))
					
						<span class="topbar-child1" style="color:{{session()->get('scolor')}};">{{session()->get('status')}}</span>

					@else
						<span class="topbar-child1">Free shipping for standard order over $100</span>
					@endif
					
				

					<div class="topbar-child2">
						<span class="topbar-email">
							@if (Auth::user())
								{{Auth::user()->email}}
							@endif
						</span>
					</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="<?php echo url('/'); ?>" class="logo">
					<img src="{{url('/')}}/images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">

							<li>
								<a href="<?php echo url('/'); ?>">Home</a>
							</li>							
							
							<li class="sale-noti" >
								<a href="{{route('product.index')}}">Shop</a>
							</li>

							<li>
								<a href="<?php echo url('/features'); ?>">Features</a>
							</li>

							<li>
								<a href="{{route('blog.index')}}">Blog</a>
							</li>

							<li>
								<a href="<?php echo url('/about'); ?>">About</a>
							</li>

							<li>
								<a href="<?php echo url('/contact'); ?>">Contact</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<div href="#" class="header-wrapicon1 dis-block">
					<a href="{{route('login')}}">
						<img src="{{url('/')}}/images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
					</a>
						

						<div href="{{route('login')}}" class="header-cart " style="width:200px;">

						</div>	

					</div>
					

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
					<a href="{{route('cart.index')}}">
						<img src="{{url('/')}}/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
					</a>
					<span class="header-icons-noti">{{$totalCart ?? ''}}</span>


						
					</div> 
				
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="<?php echo url('/'); ?>" class="logo-mobile">
				<img src="images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="{{route('login')}}" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2" >
						<a href="{{route('cart.index')}}">
							<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						   	<span class="header-icons-noti">{{$totalCart ?? '0'}}</span>
						</a>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								@if (Auth::user())
									{{Auth::user()->email}}
								@endif
							</span>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="{{route('fash')}}">Home</a>

						
					</li>

					<li class="item-menu-mobile">
						<a href="{{route('product.index')}}">Shop</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{route('product.index')}}">Features</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{route('blog.index')}}">Blog</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{route('about')}}">About</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{route('contact')}}">Contact</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url({{url('/')}}/images/heading-pages-02.jpg);">
		<h2 class="l-text2 t-center">
			Women
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
							<a href="{{route('product.index')}}" class="s-text13 active1">
									All
								</a>
							</li>

							<li class="p-t-4">
								<a href="{{url('product/short/women')}}" class="s-text13">
									Women
								</a>
							</li>

							<li class="p-t-4">
								<a href="{{url('product/short/Men')}}" class="s-text13">
									Men
								</a>
							</li>

							<li class="p-t-4">
								<a href="{{url('product/short/kids')}}" class="s-text13">
									Kids
								</a>
							</li>

							<li class="p-t-4">
								<a href="{{url('product/short/accesories')}}" class="s-text13">
									Accesories
								</a>
							</li>
						</ul>

						<!--  -->
						<h4 class="m-text14 p-b-32">
							Filters
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Price
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4" onclick="priceRange()">
										Filter
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
								</div>
							</div>
						</div>

						{{-- <div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Color
							</div>

							<ul class="flex-w">
								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
									<label class="color-filter color-filter2" for="color-filter2"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
									<label class="color-filter color-filter4" for="color-filter4"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
									<label class="color-filter color-filter6" for="color-filter6"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li>
							</ul>
						</div> --}}

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" id="SearchProduct" type="text" name="search-product" onkeyup="filterFunc()" placeholder="Search Products...">
							

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					{{-- <div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option>
								</select>
							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Price</option>
									<option>$0.00 - $50.00</option>
									<option>$50.00 - $100.00</option>
									<option>$100.00 - $150.00</option>
									<option>$150.00 - $200.00</option>
									<option>$200.00+</option>

								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
					</div> --}}

					<!-- Product -->
					<div id="ProductTable" class="row">
							{{-- products loop --}}
								@foreach ($allProducts as $product)
							<div  class="col-sm-12 col-md-6 col-lg-4 p-b-50 ProductCase ">

									<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative  @if($diff = $product->updated_at->diff(new \DateTime())->format('%d')<4)block2-labelnew @endif">
										<img src="{{url('/')}}/images/item-02.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->


												<form action="{{route('cart.store')}}" method="post">
													@csrf
													<input type="text" name="user_id"  value="{{$authconnect}}" style="display: none ">
													<input type="text" name="product_id"  value="{{$product->id }}" style="display: none">
												<input type="text" name="from"  value="products" style="display: none">
													
													<button type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" >
													Add to Cart

													</button>
												</form>

											</div>
										</div>
									</div>
									
									<div class="block2-txt p-t-20" id="ddiv">
										<a href="{{url("/product/". $product->id )}}"  class="block2-name dis-block s-text3 p-b-5 ProductTitle" >
											{{$product->title }}
										</a>
										 					 
										<span class="block2-price m-text6 p-r-5 " value="{{$product->price}}">
											<span class="ProductPrice">{{$product->price}}</span>
											 DH											
										</span>
									</div>
								</div>
								
							</div>
							@endforeach					
					</div>

					

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div>
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Categories
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Men
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Women
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Dresses
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Sunglasses
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Links
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Search
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							About Us
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Contact Us
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Returns
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Help
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Track Order
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Returns
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Shipping
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							FAQs
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form action="{{route('subscribe')}}" >
			
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="email" name="email" placeholder="Enter your email here">	
						<span class="effect1-line"></span>
						
					</div>
					@if(session()->has('sub'))
						{{session()->get('sub')}}

					@endif
					<div class="w-size2 p-t-20">
						<!-- Button -->
						<button type="submit" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
					</div>
				</form>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<a href="#">
				<img class="h-size2" src="{{url('/')}}/images/icons/paypal.png" alt="IMG-PAYPAL">
			</a>

			<a href="#">
				<img class="h-size2" src="{{url('/')}}/images/icons/visa.png" alt="IMG-VISA">
			</a>

			<a href="#">
				<img class="h-size2" src="{{url('/')}}/images/icons/mastercard.png" alt="IMG-MASTERCARD">
			</a>

			<a href="#">
				<img class="h-size2" src="{{url('/')}}/images/icons/express.png" alt="IMG-EXPRESS">
			</a>

			<a href="#">
				<img class="h-size2" src="{{url('/')}}/images/icons/discover.png" alt="IMG-DISCOVER">
			</a>

			<div class="t-center s-text8 p-t-20">
				Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
		</div>
	</footer>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



<!--===============================================================================================-->
<script type="text/javascript" src="{{url('/')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="{{url('/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		// $('.block2-btn-addcart').each(function(){
		// 	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		// 	$(this).on('click', function(){
		// 		swal(nameProduct, "is added to cart !", "success");
		// 	});
		// });

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script type="text/javascript" src="{{url('/')}}/vendor/noui/nouislider.min.js"></script>
	<script type="text/javascript">

		function filbar(maxi , mini){
				
	    var filterBar = document.getElementById('filter-bar');
		
		if(filterBar.noUiSlider){
			filterBar.noUiSlider.updateOptions({
	        start: [ mini , maxi ],
	        connect: true,
	        range: {
	            'min': mini ,
	            'max': maxi
	        }
	    });

		}else{
			noUiSlider.create(filterBar, {
	        start: [ mini , maxi ],
	        connect: true,
	        range: {
	            'min': mini ,
	            'max': maxi
	        }
	    });
		}
		
	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];
		
	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
		
		}


	</script>
<!--===============================================================================================-->
<script>

	var vari , firstTime ;
	function filterFunc() {
	maxx =[] 
	var input, filter, table, tr, td, i, txtValue ;								  
	input = document.getElementById("SearchProduct");
	filter = input.value.toUpperCase();
	table = document.getElementById("ProductTable");
	tr = table.getElementsByClassName("ProductCase");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByClassName("ProductTitle")[0];
		price = tr[i].getElementsByClassName("ProductPrice")[0].textContent;
		if(td){
			txtValue = td.textContent ;
			
			if (txtValue.toUpperCase().indexOf(filter) > -1 ) {
				

				
			tr[i].style.display = "";
			tr[i].className += "displayed";
				maxx.push(parseInt(price));
				  } else {
					tr[i].className =tr[i].className.replace( /(?:^|\s)displayed(?!\S)/g , '' )
			tr[i].style.display = "none";
		  }
		}vari = maxx;
		}
	var maxi = Math.max(...vari)+1;
	var mini = Math.min(...vari);
	filbar(maxi , mini );
	vari=[];


//-----------------------------------------






	
	}
	</script>
<!--===============================================================================================-->
<script>

	function priceRange(){
	var maxprice , minprice ;
	maxprice = parseInt(document.getElementById("value-upper").innerHTML);
	minprice = parseInt(document.getElementById("value-lower").innerHTML);














	table = document.getElementById("ProductTable");
	tr = table.getElementsByClassName("displayed");
	for (i = 0; i < tr.length; i++) {
		td = parseInt(tr[i].getElementsByClassName("ProductPrice")[0].textContent);
	console.log(maxprice + minprice);
	console.log("klajlfkt");


		
		if( maxprice >= td && minprice <=td ){
			tr[i].style.display = "";
			
				  } else {
							
			tr[i].style.display = "none";
		  }
		}
	}
	


</script>
<!--===============================================================================================-->
	<script src="{{url('/')}}/js/main.js"></script>
<!--===============================================================================================-->

</body>
</html>
