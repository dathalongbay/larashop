@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class='col-lg-10'>

        <h1><i class='fa fa-user-plus'></i> Add Menu Items</h1>
        <hr>

        {{-- @include ('errors.list') --}}

        {{ Form::open(array('url' => 'administrator/menu-items')) }}

        <input type="hidden" name="menu" value="{{ $menu  }}">

        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', '', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('parent_id', 'Parent') }}
        </div>

        <div class="form-group">
            {{ Form::select('parent_id', $option_parent, '0') }}
        </div>

        <div class="form-group">
            {{ Form::label('type', 'Type') }}
        </div>

        <div class="form-group">
            {{ Form::select('type', $option_type, 'category') }}
        </div>

        <div class="form-group">
            {{ Form::label('cat_id', 'Select category') }}
        </div>

        <div class="form-group">
            {{ Form::select('cat_id', $option_cat, '') }}
        </div>

        <div class="form-group">
            {{ Form::label('product_id', 'Select product') }}
        </div>

        <div class="form-group">
            {{ Form::select('product_id', $option_product, '') }}
        </div>

        <div class="form-group">
            {{ Form::label('page_id', 'Select page') }}
        </div>

        <div class="form-group">
            {{ Form::select('page_id', $option_page, '') }}
        </div>

        <div class="form-group">
            {{ Form::label('custom_url', 'Custom URL') }}
            {{ Form::text('custom_url', '', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('desc', 'Description') }}
            {{ Form::textarea('desc', '', array('class' => 'form-control lara-mce')) }}<br>
        </div>

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection