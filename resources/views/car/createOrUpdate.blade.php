@extends('adminlte::page')
@section('title', $text . ' Categories')
{{-- @section('content_header')
    <h1>Categories</h1>
@stop --}}

@section('content')
    <h1 class="mt-4">Mobil</h1>
    <ol class="mb-4 breadcrumb">
        <li class="breadcrumb-item active">Tambah Mobil</li>
    </ol>
    @if (isset($car->id))
        <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
        @else
            <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf()
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ isset($car->name) ? old('name', $car->name) : old('name') }}">
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="plat" class="form-label">Plat</label>
        <input type="text" class="form-control @error('plat') is-invalid @enderror" name="plat" id="plat"
            value="{{ isset($car->plat) ? old('plat', $car->plat) : old('plat') }}">
        @error('plat')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar Post</label>
        <img src="" class="mb-3 img-preview img-fluid col-sm-5" alt="">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
            onchange="previewImage()">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price"
            value="{{ isset($car->price) ? old('price', $car->price) : old('price') }}">
        @error('price')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control @error('description')  @enderror">{{ isset($car->description) ? old('description', $car->description) : old('description') }}</textarea>
        @error('description')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            <option selected value="1">Available</option>
            <option value="0">Not Available</option>
        </select>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
