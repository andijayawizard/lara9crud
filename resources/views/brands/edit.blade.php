@extends('layouts.app')
@section('content')
    <div class="container mt-0 mb-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        Edit Brand
                        <form action="{{ route('brands.update', $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control" name="acak">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Brand</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', $brand->name) }}" placeholder="Masukkan Nama Brand">

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
                                    value="{{ old('rgks', $brand->rgks) }}" placeholder="Ringkasan">

                                <!-- error message untuk title -->
                                @error('rgks')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <textarea class="form-control @error('ktrg') is-invalid @enderror" name="ktrg" rows="4" placeholder="Keterangan">{{ old('ktrg', $brand->ktrg) }}</textarea>

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
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ktrg');
    </script>
@endsection
