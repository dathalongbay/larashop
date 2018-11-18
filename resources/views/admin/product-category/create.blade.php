@extends('admin.layouts.admin')

@section('title', 'Product')

@section('content')

    <div class='col-lg-10'>

        <h1><i class='fa fa-user-plus'></i> Add Category</h1>
        <hr>

        {{-- @include ('errors.list') --}}

        {{ Form::open(array('url' => 'administrator/product-category', 'method' => 'post', 'enctype' => 'multipart/form-data')) }}

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
            {{ Form::label('image', 'Image') }}
            <div class="input-group">
           <span class="input-group-btn">
             <a id="lfm1" data-input="thumbnail" data-preview="holder" class="lfm btn btn-primary">
               <i class="fa fa-picture-o"></i> Choose
             </a>
           </span>
                <input id="thumbnail" name="image" class="form-control" type="text" name="filepath" value="">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </div>

        <div class="form-group">
            {{ Form::label('desc', 'Desc') }}
            {{ Form::textarea('desc', '', array('class' => 'form-control lara-mce')) }}<br>
        </div>

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}


        {{ Form::close() }}

    </div>
@endsection