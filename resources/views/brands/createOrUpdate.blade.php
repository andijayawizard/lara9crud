@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <div class="pull-left">
                        <h2>{{ $text }} Brand</h2>
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

                    @if (isset($brand->id))
                        <form action="{{ route('brands.update', $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form action="{{ route('brands.store') }}" method="POST">
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">GAMBAR</label>
                        <input type="file" class="form-control" name="acak">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Nama Brand</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ isset($brand->name) ? old('name', $brand->name) : old('name') }}"
                            placeholder="Masukkan Nama Brand">

                        <!-- error message untuk title -->
                        @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Ringkasan</label>
                        <input type="text" class="form-control @error('rgks') is-invalid @enderror" name="rgks"
                            value="{{ isset($brand->rgks) ? old('rgks', $brand->rgks) : old('rgks') }}"
                            placeholder="Ringkasan">

                        <!-- error message untuk title -->
                        @error('rgks')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Keterangan</label>
                        <textarea class="form-control @error('ktrg') is-invalid @enderror" name="ktrg" rows="4" placeholder="Keterangan">{{ isset($brand->ktrg) ? old('ktrg', $brand->ktrg) : old('ktrg') }}</textarea>

                        <!-- error message untuk content -->
                        @error('ktrg')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>

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
