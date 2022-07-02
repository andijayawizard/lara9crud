@extends('adminlte::page')
@section('title', 'Categories')
@section('content_header')
    <h1>Categories</h1>
@stop
@section('content')
    <div class="container- mt-0 pt-2">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3">Add new Category</a>
                        <table id='categories-table' class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Ringkasan</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ Storage::url('public/categories/') . $item->acak }}"
                                                class="rounded" style="width: 100px">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{!! $item->rgks !!}</td>
                                        <td>{!! $item->ktrg !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-xs"
                                                href="{{ route('categories.show', $item->id) }}">Show</a>
                                            <a href="{{ route('categories.edit', $item->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                            <form
                                                onsubmit="return confirm('Apakah Anda Yakin akan menghapus data {{ $item->name }}?');"
                                                action="{{ route('categories.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Category belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- <script>
                            $(document).ready(function() {
                                $('#categories-table').DataTable({
                                    "serverSide": true,
                                    "ajax": {
                                        // url: {{ action('CategoriesController@index') }}
                                        // url: "{{ action('ProductsController@productsDataSource') }}",
                                        method: "get"
                                    },
                                    "columnDefs": [{
                                        'targets': [4],
                                        'orderable': false
                                    }],
                                });
                            });
                        </script> --}}
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
