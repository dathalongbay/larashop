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

        <h1><i class="fa fa-users"></i> Order manager</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Date/Time Added</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($orders as $order)
                    <tr>

                        <td>{{ $order->id }}</td>
                        <td><a href="{{ route('users.edit', $order->user_id) }}">{{ App\User::find($order->user_id)->name }}</a></td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $orders->links() }}
        </div>

    </div>



@endsection