@extends('adminlte::page')
@section('title', 'Cars')

@section('content')
    <h1 class="mt-4">
        Dashboard</h1>
    <ol class="mb-4 breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="d-flex">
        <a href="{{ route('car.create') }}" class="btn btn-primary">Tambah Mobil</a>
    </div>
    <div class="mt-3 justify-content-center">
        <form action="{{ route('car.index') }}" method="GET">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" value="{{ Request::input('search') }}" class="form-control"
                            placeholder="search . . ." name="search">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    <form class="form-inline" method="GET">
        <div class="form-group mb-2">
            <label for="filter" class="col-sm-2 col-form-label">Filter</label>
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Product name..."
                value="{{ $filter }}">
        </div>
        <button type="submit" class="btn btn-default mb-2">Filter</button>
    </form>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">@sortablelink('no')</th>
                <th scope="col">@sortablelink('nama')</th>
                <th scope="col">Image</th>
                <th scope="col">@sortablelink('plat')</th>
                <th scope="col">@sortablelink('status')</th>
                <th scope="col">@sortablelink('harga')</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($cars as $car)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $car->name }}</td>
                    <td><img src="{{ asset('storage' . $car->image) }}" alt=""></td>
                    <td>{{ $car->plat }}</td>
                    <td>{{ $car->status }}</td>
                    <td>{{ $car->price }}</td>
                    <td>
                        <form class="d-inline" action="{{ route('car.destroy', $car->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"
                                onclick="return confirm('Hapus data mobil {{ $car->name }}?')">Hapus</button>
                        </form>
                        <a href="{{ route('car.edit', $car->id) }}" class="btn btn-success">Edit</a>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#detail{{ $car->id }}">Detail</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Belum ada data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {!! $cars->appends(Request::except('page'))->render() !!}
    {{-- {{ $cars->links() }} --}}
    <p>
        Displaying {{ $cars->count() }} of {{ $cars->total() }} car(s).
    </p>
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail{{ $car->id }}"
        tabindex="-1" aria-labelledby="detail{{ $car->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Nama : {{ $car->name }}</p>
                    <p>Plat : {{ $car->plat }}</p>
                    <p>Deskripsi : {{ $car->description }}</p>
                    <p>Harga : {{ number_format($car->price, 2) }}</p>
                    <p>Status : @if ($car->status == 1)
                            <span class="badge bg-success">Available</span>
                        @else
                            <span class="badge bg-danger">Not Available</span>
                        @endif
                    </p>
                    <p>
                        <img src="{{ asset('storage/' . $car->image) }}" width="400" alt="">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
