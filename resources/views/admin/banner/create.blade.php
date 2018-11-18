@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class='col-lg-10'>

        <h1><i class='fa fa-user-plus'></i> Add Banner</h1>
        <hr>

        {{-- @include ('errors.list') --}}

        {{ Form::open(array('url' => 'administrator/banner', 'method' => 'post', 'enctype' => 'multipart/form-data')) }}


        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', '', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('except', 'Except') }}
            {{ Form::textarea('except', '', array('class' => 'form-control lara-mce')) }}<br>
        </div>

        <div class="form-group">
            {{ Form::label('location', 'Location') }}
        </div>

        <div class="form-group">
            {{ Form::select('location', $option_location, 0) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', '', array('class' => 'form-control lara-mce')) }}<br>
        </div>

        <div class="form-group">
            <input type="file" name="photos[]" multiple />
        </div>

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection