@extends('site.layouts.site')

@section('content')

<div class="page-head">
    <div class="container">
        <h3>{{ $product->title }}</h3>
    </div>
</div>

<!-- single -->
<div class="single">
    <div class="container">
        <div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
            <div class="grid images_3_of_2">
                <div class="flexslider">
                    <!-- FlexSlider -->
                    <script>
                        // Can also be used with $(document).ready()
                        $(window).load(function() {
                            $('.flexslider').flexslider({
                                animation: "slide",
                                controlNav: "thumbnails"
                            });
                        });
                    </script>
                    <!-- //FlexSlider-->
                    <ul class="slides">

                        @foreach ($product->photos as $photo)

                        <li data-thumb="<?php echo url($photo->url) ?>">
                            <div class="thumb-image"> <img src="<?php echo url($photo->url) ?>" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
            <h3>{{ $product->title }}</h3>
            <p><span class="item_price">$ {{ $product->price }}</span></p>

            <div class="color-quality">
                <div class="color-quality-right">
                    <h5>Quality :</h5>
                    <input type="text" name="quality" id="quality" value="1" style="width: 50px"/>
                </div>
            </div>

            <div class="occasion-cart" style="margin-top: 15px">
                <a href="#" data-id="<?php echo $product->id; ?>" class="item_add_cart item_add hvr-outline-out button2">Add to cart</a>
            </div>

        </div>
        <div class="clearfix"> </div>

        <div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                        <h5>Product Brief Description</h5>
                        {!! html_entity_decode($product->desc) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- //single -->
<!-- //product-nav -->
    <script type="text/javascript">
        $(document).ready(function () {


            $('.item_add_cart').on('click', function(e){
                e.preventDefault();

                var dataPost = {};
                var id = $(this).data('id');
                dataPost.id = id;
                var _token = '<?php echo csrf_token() ?>';

                if ( $('#quality').length ) {
                    dataPost.quality = $('#quality').val();
                } else {
                    dataPost.quality = 1;
                }

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
@endsection