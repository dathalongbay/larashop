<div class="coupons">
    <div class="container">
        <div class="coupons-grids text-center">
            <div class="col-md-3 coupons-gd">
                <h3>{{ $setting['process_title'] }}</h3>
            </div>
            <div class="col-md-3 coupons-gd">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <h4>{{ $setting['process_step_1'] }}</h4>
                <p>{!! $setting['process_step_1_desc'] !!}  }}</p>
            </div>
            <div class="col-md-3 coupons-gd">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <h4>{{ $setting['process_step_2'] }}</h4>
                <p>{!! $setting['process_step_2_desc'] !!} </p>
            </div>
            <div class="col-md-3 coupons-gd">
                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                <h4>{{ $setting['process_step_3'] }}</h4>
                <p>{!! $setting['process_step_3_desc'] !!}</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="col-md-3 footer-left">
            <h2><a href="index.html"><img src="<?php echo url($setting['logo']) ?>" alt=" " /></a></h2>
            <p>{!! $setting['footer_desc'] !!}</p>
        </div>
        <div class="col-md-9 footer-right">
            <div class="col-sm-6 newsleft">
                <h3>SIGN UP FOR NEWSLETTER !</h3>
            </div>
            <div class="col-sm-6 newsright">

                <form name="newsletter_form" action="{{ route('site.newsletter') }}" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="sign-grds">
                <div class="col-md-4 sign-gd">
                    <h4>Information</h4>
                    {{ FrontMenuHelper::show_footer_menu() }}
                </div>

                <div class="col-md-4 sign-gd-two">
                    <h4>Store Information</h4>
                    <ul>
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>{!! $setting['contact_address'] !!}</li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>{!! $setting['contact_mail'] !!} </li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>{!! $setting['contact_phone'] !!} </li>
                    </ul>
                </div>
                <div class="col-md-4 sign-gd flickr-post">
                    <h4>Flickr Posts</h4>
                    <ul>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b15.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b16.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b17.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b18.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b15.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b16.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b17.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b18.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                        <li><a href="single.html"><img src="<?php echo url('theme/smart_shop/web/images/b15.jpg') ?>" alt=" " class="img-responsive" /></a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        {!! $setting['copyright'] !!}
    </div>
</div>
<!-- //footer -->