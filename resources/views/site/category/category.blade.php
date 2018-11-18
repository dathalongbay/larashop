@extends('site.layouts.site')

@section('content')

    <script type="text/javascript">
        $(document).ready(function () {


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

<div class="page-head">
    <div class="container">
        <h3>Men's Wear</h3>
    </div>
</div>
<!-- //banner -->
<!-- mens -->
<div class="men-wear">
    <div class="container">
        <div class="col-md-4 products-left">
            <div class="css-treeview">
                <h4>Categories</h4>
                <ul class="tree-list-pad">
                    @foreach($cat_list as $cat)
                        <li><a href="{{ url('/category/'.$cat->id) }}">{{ str_repeat('-', $cat->level) }} {{ $cat->title }}</a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-8 products-right">

            <div class="men-wear-top">
                <script src="{{ asset('site/js/responsiveslides.min.js') }}"></script>
                <script>
                    // You can also use "$(window).load(function() {"
                    $(function () {
                        // Slideshow 4
                        $("#slider3").responsiveSlides({
                            auto: true,
                            pager: true,
                            nav: false,
                            speed: 500,
                            namespace: "callbacks",
                            before: function () {
                                $('.events').append("<li>before event fired.</li>");
                            },
                            after: function () {
                                $('.events').append("<li>after event fired.</li>");
                            }
                        });
                    });
                </script>
                <div  id="top" class="callbacks_container">
                    <ul class="rslides" id="slider3">
                        <li>
                            <img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/men1.jpg') ?>" alt=" "/>
                        </li>
                        <li>
                            <img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/men2.jpg') ?>" alt=" "/>
                        </li>
                        <li>
                            <img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/men1.jpg') ?>" alt=" "/>
                        </li>
                        <li>
                            <img class="img-responsive" src="<?php echo url('theme/smart_shop/web/images/men2.jpg') ?>" alt=" "/>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="men-wear-bottom">
                <div class="col-sm-4 men-wear-left">
                    <?php if ($category->image) : ?>
                        <img class="img-responsive" src="<?php echo url($category->image) ?>" alt=" " />
                    <?php endif; ?>
                </div>
                <div class="col-sm-8 men-wear-right">
                    <h4>{{ $category->title }}</h4>
                    <p>{!! $category->desc !!} </p>
                </div>
                <div class="clearfix"></div>
            </div>


            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="single-pro">

            <?php $i = 0; ?>

            @foreach($products as $product)

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

            @endforeach

            <div class="clearfix"></div>
        </div>
        <div class="pagination-grid text-right">

            {{ $products->links() }}

        </div>
    </div>
</div>
<!-- //mens -->
<!-- //product-nav -->

@endsection