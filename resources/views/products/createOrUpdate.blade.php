@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <div class="pull-left">
                        <h2>{{ $text }} Product</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-xs" href="{{ route('products.index') }}"> Back</a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($product->id))
                        <form action="{{ route('products.update', $product->id) }}" method="POST">
                            @method('PUT')
                        @else
                            <form action="{{ route('products.store') }}" method="POST">
                    @endif

                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" value="{{ isset($product->name) ? $product->name : '' }}"
                                    class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Category:</strong>
                                <select name="category_id" id="category_id" class="form-control select2bs4" required>
                                    <option>-- select category --</option>
                                    @foreach ($categories as $category)
                                        @if (isset($product->category_id))
                                            <option @if ($product->category_id == $category->id) {{ 'selected' }} @endif
                                                value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Brand:</strong>
                                <select name="brand_id" id="brand_id" class="form-control select2bs4" required>
                                    <option>-- select brand --</option>
                                    @foreach ($brands as $brand)
                                        @if (isset($product->brand_id))
                                            <option @if ($product->brand_id == $brand->id) {{ 'selected' }} @endif
                                                value="{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </option>
                                        @else
                                            <option value="{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Detail:</strong>
                                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ isset($product->detail) ? $product->detail : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('detail');
    </script>
@endsection
