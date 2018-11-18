@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class='col-lg-10'>

        <h1>Edit Menu Items</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($menu, array('route' => array('menu-items.updatedata', $menu->id), 'method' => 'PUT')) }}
        <div class="form-group">

            <input type="hidden" name="menu" value="{{ $menu->menu  }}">

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent') }}
            </div>

            <div class="form-group">
                {{ Form::select('parent_id', $option_parent, $menu->parent_id) }}
            </div>

            <div class="form-group">
                {{ Form::label('type', 'Type') }}
            </div>

            <div class="form-group">
                {{ Form::select('type', $option_type, $menu->type ) }}
            </div>

            <div class="form-group">
                {{ Form::label('cat_id', 'Select category') }}
            </div>

            <div class="form-group">
                {{ Form::select('cat_id', $option_cat, $params->cat_id) }}
            </div>

            <div class="form-group">
                {{ Form::label('product_id', 'Select product') }}
            </div>

            <div class="form-group">
                {{ Form::select('product_id', $option_product, $params->product_id) }}
            </div>

            <div class="form-group">
                {{ Form::label('page_id', 'Select page') }}
            </div>

            <div class="form-group">
                {{ Form::select('page_id', $option_page, $params->page_id) }}
            </div>

            <div class="form-group">
                {{ Form::label('custom_url', 'Custom URL') }}
                {{ Form::text('custom_url', $params->custom_url, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('desc', 'Description') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
@endsection