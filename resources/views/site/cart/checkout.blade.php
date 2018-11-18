@extends('site.layouts.site')

@section('content')

<!-- banner -->
<div class="page-head">
    <div class="container">
        <h3>Cart</h3>
    </div>
</div>
<!-- //banner -->
<!-- check out -->
<div class="checkout">
    <div class="container">
        <h3>My Shopping Bag</h3>
        <div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
            <table class="timetable_sub">
                <thead>
                <tr>
                    <th>Remove</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
                </thead>
                <script>$(document).ready(function(c) {
                        $('.close1').on('click', function(c){

                            var dataPost = {};
                            var id = $(this).closest('tr.rem1').data('id');
                            dataPost.id = id;
                            var _token = '<?php echo csrf_token() ?>';

                            dataPost._token = _token;

                            $.ajax({
                                url: "/cart-delete",
                                data: dataPost,
                                type: 'POST',
                                success: function(result){
                                    console.log(result);

                                    $('#simpleCart_quantity').html(result.total_quantity);
                                    $('#simpleCart_total').html(result.total);
                                    $('#total-2').html(result.total);


                                }});

                            $(this).closest('tr.rem1').remove();
                            $('#basket-'+id).remove();
                        });
                    });
                </script>
                @foreach($items as $item)
                <tr class="rem1" data-id="{{ $item->id }}">
                    <td class="invert-closeb">
                        <div class="rem">
                            <div class="close1"></div>
                        </div>

                    </td>
                    <td class="invert-image"><a href="single.html"><img src="<?php echo url($item->image) ?>" alt=" " class="img-responsive" /></a></td>
                    <td class="invert">
                        <div class="quantity">
                            <div class="quantity-select">
                                <div class="entry value-minus">&nbsp;</div>
                                <div class="entry value"><span>{{ $item->quantity }}</span></div>
                                <div class="entry value-plus active">&nbsp;</div>
                            </div>
                        </div>
                    </td>
                    <td class="invert">{{ $item->name }}</td>
                    <td class="invert">${{ $item->price * $item->quantity }}</td>
                </tr>
                @endforeach

                <!--quantity-->
                <script>
                    $('.value-plus').on('click', function(){
                        var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
                        divUpd.text(newVal);

                        var dataPost = {};
                        var id = $(this).closest('tr.rem1').data('id');
                        dataPost.id = id;
                        dataPost.quantity = 1;
                        var _token = '<?php echo csrf_token() ?>';

                        dataPost._token = _token;

                        $.ajax({
                            url: "/cart-update",
                            data: dataPost,
                            type: 'POST',
                            success: function(result){
                                console.log(result);

                                $('#simpleCart_quantity').html(result.total_quantity);
                                $('#simpleCart_total').html(result.total);
                                $('#total-2').html(result.total);


                            }});

                    });

                    $('.value-minus').on('click', function(){
                        var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
                        if(newVal>=1) divUpd.text(newVal);

                        var dataPost = {};
                        var id = $(this).closest('tr.rem1').data('id');
                        dataPost.id = id;
                        dataPost.quantity = -1;
                        var _token = '<?php echo csrf_token() ?>';

                        dataPost._token = _token;

                        $.ajax({
                            url: "/cart-update",
                            data: dataPost,
                            type: 'POST',
                            success: function(result){
                                console.log(result);

                                $('#simpleCart_quantity').html(result.total_quantity);
                                $('#simpleCart_total').html(result.total);
                                $('#total-2').html(result.total);


                            }});
                    });
                </script>
                <!--quantity-->
            </table>
        </div>
        <div class="checkout-left">

            <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                <a href="{{ url('/') }}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
                @if(Auth::check())
                    <a href="{{ url('/checkout') }}"><span>Check out</span></a>
                @else
                    <a href="#" data-toggle="modal" data-target="#myModal4"><span>Check out</span></a>
                @endif
            </div>
            <div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
                <h4>Shopping basket</h4>
                <ul>
                    @foreach($items as $item)
                    <li id="basket-{{ $item->id }}">{{ $item->name }} <i>-</i> <span>${{ $item->price * $item->quantity }}</span></li>
                    @endforeach
                    <li>Total <i>-</i> <span id="total-2">$ {{ $total }}</span></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //check out -->
<!-- //product-nav -->

@endsection