@extends('admin.layouts.admin')

@section('title', 'Laravel dashboard')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        @if(Session::has('flash_message'))
            <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
            </div>
        @endif

        <h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>
        <hr>
         @include ('admin.errors.list')

        {{ Form::model($user, array('route' => array('profile.update', $user->id), 'method' => 'PUT')) }} {{-- Form model binding to automatically populate our fields with user data --}}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('avatar', 'Avatar') }}
        </div>

        <div class="form-group">
            <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm1" data-input="thumbnail" data-preview="holder" class="lfm btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                <?php if ($user->avatar) { ?>
                <input id="thumbnail" name="avatar" class="form-control" type="text" name="filepath" value="{{ $user->avatar }}">
                <?php } else { ?>
                <input id="thumbnail" name="avatar" class="form-control" type="text" name="filepath" value="">
                <?php } ?>
            </div>
            <?php if ($user->avatar) { ?>
            <img id="holder" src="<?php echo url($user->avatar); ?>" style="margin-top:15px;max-height:100px;">
            <?php } else { ?>
            <img id="holder"  style="margin-top:15px;max-height:100px;">
            <?php } ?>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Confirm Password') }}<br>
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

        </div>

        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection