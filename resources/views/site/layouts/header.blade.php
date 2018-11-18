<!-- header -->
<div class="header">
    <div class="container">
        <ul>
            <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>{{ $setting['header_msg_1'] }}</li>
            <li><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>{{ $setting['header_msg_2'] }}</li>
            <li>
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                @if(Auth::check())
                <span class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </span>
                @else
                    Hi Guest
                @endif
        </ul>
    </div>
</div>
<!-- //header -->

<!-- header-bot -->
<div class="header-bot">
    <div class="container">
        <div class="col-md-3 header-left">
            <h1><a href="{{ url('/') }}"><img src="<?php echo url($setting['logo']) ?>"></a></h1>
        </div>
        <div class="col-md-6 header-middle" style="height: 52px">
            <form name="search_form" action="{{ route('site.search') }}" method="post" style="height: 50px">
                {{ csrf_field() }}
                <div class="search">
                    @if (isset($keyword))
                        <input type="search" name="search_value" value="{{$keyword}}" placeholder="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
                    @else
                        <input type="search" name="search_value" value="" placeholder="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
                    @endif

                </div>
                <div class="sear-sub">
                    <input name="search_submit" id="search-submit" type="submit" value="">
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="col-md-3 header-right footer-bottom">


            <ul>
                <li><a href="#" class="use1" data-toggle="modal" data-target="#myModal4"><span>Login</span></a>

                </li>
                <li><a class="fb" href="#"></a></li>
                <li><a class="twi" href="#"></a></li>
                <li><a class="insta" href="#"></a></li>
                <li><a class="you" href="#"></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //header-bot -->
<!-- banner -->

<!-- login -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body modal-spa">
                <div class="login-grids">
                    <div class="login">
                        <div class="login-bottom">
                            <h3>Sign up for free</h3>

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="sign-up form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <h4>Name :</h4>

                                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="sign-up form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <h4>E-Mail Address :</h4>

                                    <input id="email" type="text" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="sign-up form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <h4>Password :</h4>

                                        <input id="password" type="password" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                </div>

                                <div class="sign-up form-group">
                                    <h4>Re-type Password :</h4>

                                        <input id="password-confirm" type="password" name="password_confirmation" required>
                                </div>

                                <div class="sign-up">
                                    <input type="submit" value="REGISTER NOW" />
                                </div>
                            </form>
                        </div>
                        <div class="login-right">
                            <h3>Sign in with your account</h3>

                            <form class="form-horizontal1" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class=" sign-in form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <h4>Email :</h4>

                                        <input id="email" type="text" class="form-control1" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                </div>

                                <div class="sign-in form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <h4>Password :</h4>

                                        <input id="password" type="password" class="form-control1" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                </div>

                                <div class="sign-in form-group">
                                    <div class="single-bottom">
                                        <input type="checkbox" id="brand" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                        <label for="brand"><span></span>Remember Me.</label>
                                    </div>
                                </div>

                                <div class="sign-in form-group">
                                    <input type="submit" value="SIGNIN" >

                                    <a href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </form>



                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p>Please register and login to checkout</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //login -->