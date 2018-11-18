@extends('admin.layouts.admin')

@section('title', 'Order')

@section('content')
    <div class='col-lg-10'>

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <h1>Edit Order</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($order, array('route' => array('order.update', $order->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}


        <div class="form-group">

            <div class="form-group">
                {{ Form::label('User', 'User') }}
                <a href="{{ route('users.edit', $order->user_id) }}">{{ App\User::find($order->user_id)->name }}</a>

            </div>

            <div class="form-group">
                {{ Form::label('status', 'status') }}
                {{ Form::text('status', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('phone', 'phone') }}
                {{ Form::text('phone', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('price', 'phone') }}
                {{ Form::text('price', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('address', 'address') }}
                {{ Form::textarea('address', null, array('class' => 'form-control')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('description', 'description') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}<br>
            </div>

            <h2>Order Detail</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Product_id</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product_order)
                <tr>
                    <td>{{ $product_order->product_id }}</td>
                    <td>{{ $product_order->description }}</td>
                    <td>$ {{ $product_order->price }}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td>Total price : </td>
                    <td>$ {{ $order->price }}</td>
                </tr>

                </tbody>
            </table>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}


            {{ Form::close() }}

        </div>
    </div>
@endsection