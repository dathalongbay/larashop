@extends('site.layouts.site')

@section('content')

    <!-- banner -->
    <div class="banner-grid">
        <div id="visual">
            <div class="slide-visual">
                <!-- Slide Image Area (1000 x 424) -->
                <?php if ($banner->images) : ?>

                <ul class="slide-group">
                    <?php foreach($banner->images as $slideshow) : ?>
                        <li><img class="img-responsive" src="<?php echo url($slideshow->url) ?>" /></li>
                    <?php endforeach; ?>
                </ul>

                <?php endif; ?>

                <!-- Slide Description Image Area (316 x 328) -->
                <div class="script-wrap">
                    <ul class="script-group">
                        <li><div class="inner-script"><img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/baa1.jpg') ?>" alt="Dummy Image" /></div></li>
                        <li><div class="inner-script"><img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/baa2.jpg') ?>" alt="Dummy Image" /></div></li>
                        <li><div class="inner-script"><img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/baa3.jpg') ?>" alt="Dummy Image" /></div></li>
                    </ul>
                    <div class="slide-controller">
                        <a href="#" class="btn-prev"><img src="<?php echo url('theme/smart_shop/web/images/btn_prev.png') ?>" alt="Prev Slide" /></a>
                        <a href="#" class="btn-play"><img src="<?php echo url('theme/smart_shop/web/images/btn_play.png') ?>" alt="Start Slide" /></a>
                        <a href="#" class="btn-pause"><img src="<?php echo url('theme/smart_shop/web/images/btn_pause.png') ?>" alt="Pause Slide" /></a>
                        <a href="#" class="btn-next"><img src="<?php echo url('theme/smart_shop/web/images/btn_next.png') ?>" alt="Next Slide" /></a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <script type="text/javascript" src="{{ asset('site/js/pignose.layerslider.js') }}"></script>
        <script type="text/javascript">
            //<![CDATA[
            $(window).load(function() {
                $('#visual').pignoseLayerSlider({
                    play    : '.btn-play',
                    pause   : '.btn-pause',
                    next    : '.btn-next',
                    prev    : '.btn-prev'
                });
            });
            //]]>
        </script>

    </div>
    <!-- //banner -->

    <div class="product-easy">
        <div class="container">

            <script src="{{ asset('site/js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#horizontalTab').easyResponsiveTabs({
                        type: 'default', //Types: default, vertical, accordion
                        width: 'auto', //auto or any width like 600px
                        fit: true   // 100% fit in a container
                    });

                    $('.item_add_cart').on('click', function(e){
                        e.preventDefault();

                        var dataPost = {};
                        var id = $(this).data('id');
                        dataPost.id = id;
                        var _token = '<?php echo csrf_token() ?>';

                        dataPost._token = _token;

                        $.ajax(
                        {
                            url: "/cart",
                            data: dataPost,
                            type: 'POST',
                            success: function(result){
                                console.log(result);

                                $('#simpleCart_quantity').html(result.total_quantity);
                                $('#simpleCart_total').html('$' + result.total);


                                $(window).scrollTop(0);
                        }});
                    });
                });

            </script>

            <div class="sap_tabs" style="margin-top: 50px">
                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                    <ul class="resp-tabs-list">
                        <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Search products</span></li>
                    </ul>
                    <div class="resp-tabs-container">
                        <div class="tab-1 resp-tab-content row" aria-labelledby="tab_item-0">

                            <?php if ($products) :
                            $i = 0;
                            ?>
                            <?php foreach($products as $product) : ?>

                            <?php
                            if (($i % 4) == 0 && ($i > 0)) {
                                $ext_class = 'clr-both';
                            } else {
                                $ext_class = '';
                            }
                            $i++;
                            ?>
                            <div class="col-md-3 product-men yes-marg <?php echo $ext_class; ?>">
                                <div class="men-pro-item simpleCart_shelfItem">
                                    <div class="men-thumb-item">
                                        <?php if ($product->image) : ?>
                                        <img src="<?php echo url($product->image) ?>" alt="" class="pro-image-front">
                                        <img src="<?php echo url($product->image) ?>" alt="" class="pro-image-back">
                                        <?php endif; ?>
                                        <div class="men-cart-pro">
                                            <div class="inner-men-cart-pro">
                                                <a href="<?php echo url('/product/'.$product->id) ?>" class="link-product-add-cart">Quick View</a>
                                            </div>
                                        </div>
                                        <span class="product-new-top">New</span>

                                    </div>
                                    <div class="item-info-product ">
                                        <h4><a href="<?php echo url('/product/'.$product->id) ?>"><?php echo $product->title; ?></a></h4>
                                        <div class="info-product-price">
                                            <span class="item_price">$<?php echo $product->price; ?></span>
                                        </div>
                                        <a href="#" data-id="<?php echo $product->id; ?>" class="item_add_cart single-item hvr-outline-out button2">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //product-nav -->



    <div class="pagination-grid" style="width: 300px; margin: 50px auto;">

        {{ $products->links() }}

    </div>

@endsection
