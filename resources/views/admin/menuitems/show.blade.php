@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Menu Items manager</h1>

        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Level</th>
                    <th>Description</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($menus as $menu_item)
                    <tr>

                        <td>{{ $menu_item->id }}</td>
                        <td>{{ str_repeat('-', $menu_item->level) . ' ' . $menu_item->title }}</td>
                        <td>{{ $menu_item->level }} </td>
                        <td>{!! $menu_item->desc !!}</td>

                        <td>
                            <a href="{{ url('administrator/menu-items/edit', $menu_item->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['menu-items.destroy', $menu_item->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>


        <div style="margin-top: 50px">
            <a href="{{ route('menu-items.create', $menu_id) }}" class="btn btn-success">Add Menu Item</a>
        </div>

    </div>

@endsection