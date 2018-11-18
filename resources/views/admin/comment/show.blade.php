@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Comment manager
            </h1>
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
                @foreach ($comments as $comment)
                    <tr>

                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->title }}</td>
                        <td>{{ $comment->except }}</td>
                        <td>{{ $comment->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['comment.destroy', $comment->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $comments->links() }}
        </div>

        <div style="margin-top: 50px">
            <a href="{{ route('comment.create') }}" class="btn btn-success">Add Comment</a>
        </div>

    </div>

@endsection