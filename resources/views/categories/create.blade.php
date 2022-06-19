@extends('adminlte::page')
@section('title', 'Create Category')
@section('content_header')
    <h1>Create Category</h1>
@stop
@section('content')
    <div class="container- mt-0 mb-0 pt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        Add New Category
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control @error('acak') is-invalid @enderror"
                                    name="acak">

                                <!-- error message untuk title -->
                                @error('acak')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Category</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" placeholder="Nama Category">

                                <!-- error message untuk title -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Ringkasan</label>
                                <input type="text" class="form-control @error('rgks') is-invalid @enderror"
                                    name="rgks" value="{{ old('rgks') }}" placeholder="Ringkasan">

                                <!-- error message untuk title -->
                                @error('rgks')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <textarea class="form-control @error('ktrg') is-invalid @enderror" name="ktrg" rows="4"
                                    placeholder="Keterangan">{{ old('ktrg') }}</textarea>

                                <!-- error message untuk content -->
                                @error('ktrg')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ktrg');
    </script>
@endsection
