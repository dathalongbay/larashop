@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Menus manager</h1>

        {{ Form::open(array('url' => 'administrator/menus')) }}
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
                    <th>Description</th>
                    <th>Date/Time Added</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($menus as $menu)
                    <tr>

                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->title }}</td>
                        <td> <a href="{{ url('/administrator/menu-items', $menu->id) }}">View menu items</a> </td>
                        <td>{{ $menu->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['menus.destroy', $menu->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $menus->links() }}
        </div>

        <div style="margin-top: 50px">
            <a href="{{ route('menus.create') }}" class="btn btn-success">Add Menu</a>
        </div>

    </div>

@endsection