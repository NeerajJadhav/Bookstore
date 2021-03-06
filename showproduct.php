<?php require_once 'core/init.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Texas State Bookstore | Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="applijegleryion/x-javascript">
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- start menu -->
    <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="js/megamenu.js"></script>
    <script>$(document).ready(function () {
            $(".megamenu").megamenu();
        });</script>
    <script src="js/menu_jquery.js"></script>
    <script src="js/simpleCart.min.js"></script>
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
    <!--//web-fonts-->
    <script src="js/scripts.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!--/script-->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 900);
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
            <div class="clearfix"></div>
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
                                <span class="simpleCart_total"></span> (<span id="simpleCart_quantity"
                                                                              class="simpleCart_quantity"></span> items)
                            </div>
                            <i class="glyphicon glyphicon-shopping-cart"></i></a>
                        <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--start-header-menu-->
            <ul class="megamenu skyblue">
                <li class="grid"><a class="color1" href="index.html">Home</a></li>
                <li class="grid"><a class="color2" href="register.php">Register</a></li>
                <li class="active grid"><a class="color4" href="showproduct.php">Search</a></li>
                <li><a class="color5" href="update.php">Update Information</a></li>
                <li><a class="color7" href="contact.html">Suggestions</a></li>
                <li><a class="color8" href="contact.html">Contact Us</a></li>
                <li><a class="color9" href="contact.html">Help</a></li>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php require 'search.html'?>
<div class="products">
    <div class="container">
        <div class="products-grids">
            <div class="col-md-8 products-grid-left">
<?php

$oBook = new Book();
$allBooks = $oBook->getAllBooks();
$total= count($allBooks);
for($i=0;$i<15;$i++){
    $threeBooks = $oBook->formatResult(array_splice($allBooks,$i,3));
    $i+=3;
    $html  = '<div class="products-grid-lft">';
    foreach($threeBooks as $eachBook){
        $html .= '<div class="products-grd"><div class="p-one simpleCart_shelfItem prd">
								<a href="single.html">
								<img src="'.$eachBook['ImageURL'].'" alt="" class="img-responsive" />
								</a>
								<h4>'.$eachBook['Title'].'</h4>
								<p><a class="item_add" href="#"><i class="glyphicon glyphicon-shopping-cart"></i> <span class=" item_price valsa"> $'.$eachBook['Price'].'</span></a></p>
							</div></div>';
    }
    $html.='</div>';
    echo $html;
}

?>
            </div>
        </div>
    </div>
</div>