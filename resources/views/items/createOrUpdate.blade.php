@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <div class="pull-left">
                        <h2>{{ $text }} Item</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-xs" href="{{ route('items.index') }}"> Back</a>
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

                    @if (isset($item->id))
                        <form action="{{ route('items.update', $item->id) }}" method="POST">
                            @method('PUT')
                        @else
                            <form action="{{ route('items.store') }}" method="POST">
                    @endif

                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" value="{{ isset($item->name) ? $item->name : '' }}"
                                    class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Type:</strong>
                                <input type="text" name="type" value="{{ isset($item->type) ? $item->type : '' }}"
                                    class="form-control" placeholder="Type">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Price:</strong>
                                <input type="text" name="price" value="{{ isset($item->price) ? $item->price : '' }}"
                                    class="form-control" placeholder="Price">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Quantity in stock:</strong>
                                <input type="text" name="quantity_in_stock"
                                    value="{{ isset($item->quantity_in_stock) ? $item->quantity_in_stock : '' }}"
                                    class="form-control" placeholder="Quantity in stock">
                            </div>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Category:</strong>
                                <select name="category_id" id="category_id" class="form-control select2bs4" required>
                                    <option>-- select category --</option>
                                    @foreach ($categories as $category)
                                        @if (isset($item->category_id))
                                            <option @if ($item->category_id == $category->id) {{ 'selected' }} @endif
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
                        </div> --}}
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Sub Category:</strong>
                                @error('sub_category_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <select name="sub_category_id" id="sub_category_id"
                                    class="form-control select2bs4 @error('sub_category_id') is-invalid @enderror" required>
                                    <option value="">-- select sub category --</option>
                                    @foreach ($subcategories as $sub_category)
                                        @if (isset($item->sub_category_id))
                                            <option @if ($item->sub_category_id == $sub_category->id) {{ 'selected' }} @endif
                                                value="{{ $sub_category->id }}">
                                                {{ $sub_category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $sub_category->id }}">
                                                {{ $sub_category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Detail:</strong>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{{ isset($item->description) ? $item->description : '' }}</textarea>
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
        CKEDITOR.replace('description');
    </script>
@endsection
