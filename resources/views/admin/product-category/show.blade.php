@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Category product manager</h1>

        {{ Form::open(array('url' => 'administrator/product')) }}
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
                    <th>Level</th>
                    <th>Date/Time Added</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($cats as $cat)
                    <tr>

                        <td>{{ $cat->id }}</td>
                        <td>{{ str_repeat('-', $cat->level) . ' ' .$cat->title }}</td>
                        <td>{{ $cat->level }}</td>
                        <td></td>

                        <td>
                            <a href="{{ route('product-category.edit', $cat->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['product-category.destroy', $cat->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>



        <div style="margin-top: 50px">
            <a href="{{ route('product-category.create') }}" class="btn btn-success">Add Category</a>
        </div>

    </div>

@endsection