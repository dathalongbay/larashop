@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class='col-lg-10'>

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <h1>Edit Banner</h1>
        <hr>
        @include ('admin.errors.list')

            {{ Form::model($banner, array('route' => array('banner.update', $banner->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}


            <div class="form-group">

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('except', 'Except') }}
                {{ Form::textarea('except', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('location', 'Location') }}
            </div>

            <div class="form-group">
                {{ Form::select('location', $option_location, $banner->location) }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'Body') }}
                {{ Form::textarea('body', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group row">
                @if ($banner->images)
                    @foreach ($banner->images as $photo)
                        <div style="margin-bottom: 10px" class="col-md-6 col-sm-6 col-xs-12">
                            <img src="<?php echo url($photo->url); ?>" style="width: 200px; height: auto">
                            <div style="margin: 5px">
                                <input name="photo_id[]" type="checkbox" value="<?php echo $photo->id; ?>">
                                Delete
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <input type="file" name="photos[]" multiple />
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

        </div>
    </div>
@endsection