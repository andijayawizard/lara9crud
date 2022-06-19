@extends('adminlte::page')
@section('content')
    <div class="container- mt-0 pt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('brands.create') }}" class="btn btn-md btn-success mb-3">Add new Brand</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Nama Brand</th>
                                    <th scope="col">Ringkasan</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ Storage::url('public/brands/') . $item->acak }}" class="rounded"
                                                style="width: 100px">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{!! $item->rgks !!}</td>
                                        <td>{!! $item->ktrg !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-xs"
                                                href="{{ route('brands.show', $item->id) }}">Show</a>
                                            <a href="{{ route('brands.edit', $item->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('brands.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Brand belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
