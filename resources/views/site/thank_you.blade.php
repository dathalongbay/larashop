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

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <strong>Success!</strong> Thank you for subcriber
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- //product-nav -->
@endsection
