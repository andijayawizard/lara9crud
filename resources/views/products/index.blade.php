{{-- @extends('products.layout') --}}
@extends('adminlte::page')

@section('content')
    <div class="card border-0 mt-0">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="pull-left">
                        <h2>Products</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                    </div>
                </div>
            </div>


            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{!! $product->detail !!}</td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">

                                <a class="btn btn-info btn-xs" href="{{ route('products.show', $product->id) }}">Show</a>

                                <a class="btn btn-primary btn-xs"
                                    href="{{ route('products.edit', $product->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {{-- {!! $products->appends(['sort'=>'votes'])->links() !!} --}}
            {!! $products->appends(Request::all())->links() !!}
        </div>

    </div>
@endsection
