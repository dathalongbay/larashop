@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class='col-lg-10'>

        <h1>Edit Menus</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($menu, array('route' => array('menus.update', $menu->id), 'method' => 'PUT')) }}
        <div class="form-group">

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('desc', 'Description') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('location', 'Location') }}
            </div>

            <div class="form-group">
                {{ Form::select('location', $option_location, $menu->location) }}
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
@endsection