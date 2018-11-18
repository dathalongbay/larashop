<style type="text/css">
    ul.sub-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    width: 250px;
            z-index: 1000;
            background: #FFF;
            list-style: none;
        }
ul.sub-menu li{
    padding: 10px;
            background: #000;
            border-bottom: 1px dashed #FDA30E;
        }

ul.sub-menu li:last-child {
    border-bottom: none;
        }

ul.sub-menu li a {
    color: #FFF;
}
li.top-menu {
    position: relative;
}

ul.sub-menu li {
    position: relative;
}

li.top-menu:hover > ul.sub-menu{
    display: block;
}

ul.sub-menu li:hover > ul.sub-menu {
    display: block;
    top: 0;
    left: 250px;
        }
</style>
<div class="ban-top">
<div class="container">
<div class="top_nav_left">
<nav class="navbar navbar-default">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
{{ FrontMenuHelper::show_top_menu() }}
</div>
</div>
</nav>
</div>
<div class="top_nav_right">
    <div class="cart box_1">
        <a href="<?php echo url('/cart') ?>">
            <h3> <div class="total">
                    <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
                    <span id="simpleCart_total" class="simpleCart_total">{{$total}} $</span> (<span id="simpleCart_quantity" class="simpleCart_quantity">{{$total_quantity}}</span> items)</div>

            </h3>
        </a>
        <p><a href="{{ url('/cart-clear') }}" class="simpleCart_empty">Empty Cart</a></p>

    </div>
</div>
<div class="clearfix"></div>
</div>
</div>
<!-- //banner-top -->