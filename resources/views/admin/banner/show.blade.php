@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <h1><i class="fa fa-users"></i> Banner manager</h1>

        {{ Form::open(array('url' => 'administrator/banner')) }}
            <input type="text" placeholder="Search..." required="">

            {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Except</th>
                    <th>Date/Time Added</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($banners as $banner)
                    <tr>

                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->except }}</td>
                        <td>{{ $banner->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-info pull-left" style="color: #FFF;;margin-right: 3px;"><i class="fa fa-edit" style="color: #FFF"></i> </a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['banner.destroy', $banner->id] ]) !!}
                            {!! Form::submit('X', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $banners->links() }}
        </div>

        <div style="margin-top: 50px">
            <a href="{{ route('banner.create') }}" class="btn btn-success">Add Banner</a>
        </div>

    </div>



@endsection