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

        <h1><i class="fa fa-users"></i> Newsletter manager</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($newsletters as $newsletter)
                    <tr>

                        <td>{{ $newsletter->id }}</td>
                        <td>{{ $newsletter->email }}</td>
                        <td>{{ $newsletter->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('newsletter.edit', $newsletter->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['newsletter.destroy', $newsletter->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $newsletters->links() }}
        </div>

    </div>



@endsection