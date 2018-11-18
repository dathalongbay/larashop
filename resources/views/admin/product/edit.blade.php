@extends('admin.layouts.admin')

@section('title', 'Product')

@section('content')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.save-btn').on('click', function(e){
                e.preventDefault();
                $('.in-close').val(0);
                $(this).closest("form").submit();
            });

            $('.save-and-close-btn').on('click', function(e){
                e.preventDefault();
                $('.in-close').val(1);
                $(this).closest("form").submit();
            });
        });
    </script>


    <div class='col-lg-10'>

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <h1>Edit Product</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($product, array('route' => array('product.update', $product->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

            {{ csrf_field() }}

        <div class="form-group">

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent') }}
            </div>

            <div class="form-group">
                {{ Form::select('parent_id', $option_parent, $product->cat_id) }}
            </div>

            <div class="form-group">
                {{ Form::label('desc', 'Desc') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('price', 'Price') }}
                {{ Form::text('price', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('quality', 'Quality') }}
                {{ Form::text('quality', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('image', 'Image') }}
            </div>

            <div class="form-group">
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm1" data-input="thumbnail" data-preview="holder" class="lfm btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                    <?php if ($product->image) { ?>
                    <input id="thumbnail" name="image" class="form-control" type="text" name="filepath" value="{{ $product->image }}">
                    <?php } else { ?>
                    <input id="thumbnail" name="image" class="form-control" type="text" name="filepath" value="">
                    <?php } ?>
                </div>
                <?php if ($product->image) { ?>
                <img id="holder" src="<?php echo url($product->image); ?>" style="margin-top:15px;max-height:100px;">
                <?php } else { ?>
                <img id="holder"  style="margin-top:15px;max-height:100px;">
                <?php } ?>
            </div>

            
            <div class="form-group">
                {{ Form::label('photo', 'Photo') }}
            </div>

            <div class="form-group row">
                <?php
                foreach ($product->photos as $photo) { ?>
                <div style="margin-bottom: 10px" class="col-md-6 col-sm-6 col-xs-12">
                    <img src="<?php echo url($photo->url); ?>" style="width: 200px; height: auto">
                    <div style="margin: 5px">
                        <input name="photo_id[]" type="checkbox" value="<?php echo $photo->id; ?>">
                        Delete
                    </div>
                </div>
                <?php }
                ?>
            </div>

            <div class="form-group">
                <input type="file" name="photos[]" multiple />
            </div>

            <input type="hidden" name="close" class="in-close" value="0">

            <a href="#" class="btn btn-primary save-btn">Save</a>
            <a href="#" class="btn btn-primary save-and-close-btn">Save and close</a>

            {{ Form::close() }}

        </div>
    </div>
@endsection