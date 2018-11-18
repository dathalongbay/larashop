@extends('admin.layouts.admin')

@section('title', 'Comment')

@section('content')
    <div class='col-lg-10'>

        <h1>Edit Banner</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($comment, array('route' => array('comment.update', $comment->id), 'method' => 'PUT')) }}
        <div class="form-group">

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('desc', 'Except') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

        </div>
    </div>
@endsection