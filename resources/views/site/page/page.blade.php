@extends('site.layouts.site')

@section('content')

<div class="page-head">
    <div class="container">
        <h3>{{ $page->title }}</h3>
    </div>
</div>

<!-- single -->
<div class="single">
    <div class="container">

        {!! $page->desc !!}

        <div id="map" style="width:1000px;height:400px; margin: 30px auto">

    </div>
</div>
<!-- //single -->
<!-- //product-nav -->

    <script type="text/javascript">

        function myMap() {
            var mapOptions = {
                center: new google.maps.LatLng(51.5, -0.12),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.HYBRID
            }
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        }


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

    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
@endsection