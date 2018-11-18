@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Page manager</h1>

        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>Date/Time Added</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($pages as $page)
                    <tr>

                        <td>{{ $page->id }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{!! $page->desc !!}</td>
                        <td>{{ $page->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('page.edit', $page->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['page.destroy', $page->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $pages->links() }}
        </div>

        <div style="margin-top: 50px">
            <a href="{{ route('page.create') }}" class="btn btn-success">Add Page</a>
        </div>

    </div>

@endsection