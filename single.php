<?php require 'core/init.php';?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Texas State Bookstore | Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="applijegleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- start menu -->
    <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="js/menu_jquery.js"></script>
    <script src="js/simpleCart.min.js"> </script>
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
    <!--//web-fonts-->
    <script src="js/scripts.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!--/script-->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
            });
        });
    </script>
</head>
<body>
<!--start-home-->
<div class="top_bg" id="home">
    <div class="container">
        <div class="header_top">
            <div class="top_right">
                <ul>
                    <li><a href="#">help</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
            <div class="top_left">
                <h6><span></span>Texas State University, San Marcos</h6>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--header-->
<div class="header_bg">
    <div class="container">
        <div class="header">
            <div class="head-t">
                <div class="logo">
                    <a href="index.html"><img src="images/txstate.jpg" width="25%" height="10%"></a>
                </div>
                <div class="header_right">
                    <div class="cart box_1">
                        <a href="checkout.html">
                            <div class="total">
                                <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                            <i class="glyphicon glyphicon-shopping-cart"></i></a>
                        <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--start-header-menu-->
            <ul class="megamenu skyblue">
                <li class="active grid"><a class="color1" href="index.html">Home</a></li>
                <li class="grid"><a class="color2" href="#">Register</a>
                <li><a class="color4" href="showproduct.php">Search</a>
                <li><a class="color5" href="#">Update Information</a>
                <li><a class="color6" href="#">Books Genre</a>
                <li><a class="color7" href="#">Suggestions</a>
                <li><a class="color8" href="contact.html">Contact Us</a>
                <li><a class="color9" href="#">Help</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
$bookid = isset($_GET['BookID']) ? (int)$_GET['BookID'] : 0;
$oBook = new Book();
$bookData = $oBook->getBook($bookid);
$bookStock = new Stock();
$stock = $bookStock->getStock($bookid);
$discount = $bookStock->getBookDiscount($bookid);
$stockAvail = '';
$options = '';
if($stock>0){
    for($i=1;$i<=$stock;$i++) {
        $options .= '<option>'.$i.'</option>';
    }
}else{
    $options =  '<option>0</option>';
}
$stock>0?$stockAvail = 'In Stock' : 'Out of Stock';
$image = '<img src='.$oBook->getBookCoverImageURL($bookData->ISBN).'>';
$price = $bookData->Cost - ($bookData->Cost * ($discount/100));

echo '	<div class="col-md-8 products-single">
				<div class="col-md-5 grid-single">
				'.$image.'</div>
				<div class="col-md-7 single-text">
					<div class="details-left-info simpleCart_shelfItem">
						<h3>'.$bookData->Title.' by '.$bookData->Authors.'</h3>
						<p class="availability">Availability: <span class="color">'.$stockAvail.'</span></p>
						<div class="price_single">
							<span class="reducedfrom">$'.$bookData->Cost.'</span>
							<span class="actual item_price">$'.$price.'
						</div>
						<h2 class="quick">Quick Overview</h2>
						<p class="quick_desc">'.$bookData->Description.'</p>
					    <h3>Publisher: '.$bookData->Publisher.'</h3>
						<h3>ISBN: '.$bookData->ISBN.'</h3>
						<div class="quantity_box">
						    <span>Quantity:</span>
							<div class="product-qty">
								<select>
								'.$options.'
								</select>
							</div>
						</div>
					<div class="clearfix"> </div>
				<div class="single-but item_add">
					<input type="submit" value="add to cart" />
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>';

