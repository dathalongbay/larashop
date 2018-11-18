@extends('admin.layouts.admin')

@section('title', 'Newsletter')

@section('content')
    <div class='col-lg-10'>

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <h1>Edit Newsletter</h1>
        <hr>
        @include ('admin.errors.list')

            {{ Form::model($newsletter, array('route' => array('newsletter.update', $newsletter->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}


            <div class="form-group">

            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', null, array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

        </div>
    </div>
@endsection