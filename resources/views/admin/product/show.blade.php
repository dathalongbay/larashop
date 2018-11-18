@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')

    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
            </div>
        </div>
    @endif

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Product manager</h1>

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
                    <th>Except</th>
                    <th>Date/Time Added</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($products as $product)
                    <tr>

                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->except }}</td>
                        <td>{{ $product->created_at->format('F d, Y h:ia') }}</td>

                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>



            </table>
        </div>

        <div>
            {{ $products->links() }}
        </div>

        <div style="margin-top: 50px">
            <a href="{{ route('product.create') }}" class="btn btn-success">Add Product</a>
        </div>

    </div>

@endsection