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

        <h1>Edit Category</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($cat, array('route' => array('product-category.update', $cat->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

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
                {{ Form::select('parent_id', $option_parent, $cat->parent_id) }}
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
                    <?php if ($cat->image) { ?>
                    <input id="thumbnail" name="image" class="form-control" type="text" name="filepath" value="{{ $cat->image }}">
                    <?php } else { ?>
                    <input id="thumbnail" name="image" class="form-control" type="text" name="filepath" value="">
                    <?php } ?>
                </div>
                <?php if ($cat->image) { ?>
                <img id="holder" src="<?php echo url($cat->image); ?>" style="margin-top:15px;max-height:100px;">
                <?php } else { ?>
                <img id="holder"  style="margin-top:15px;max-height:100px;">
                <?php } ?>
            </div>

            <div class="form-group">
                {{ Form::label('desc', 'Desc') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <input type="hidden" name="close" class="in-close" value="0">

            <a href="#" class="btn btn-primary save-btn">Save</a>
            <a href="#" class="btn btn-primary save-and-close-btn">Save and close</a>

            {{ Form::close() }}

        </div>
    </div>
@endsection