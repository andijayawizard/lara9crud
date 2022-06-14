@extends('layouts.app')
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
                        <a href="{{ route('items.create') }}" class="btn btn-md btn-success mb-3">Add new Item</a>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Sub Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ Storage::url('public/items/') . $item->acak }}"
                                                class="rounded" style="width: 100px">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{!! $item->category !!}</td>
                                        <td>{!! $item->subcat !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-xs"
                                                href="{{ route('items.show', $item->id) }}">Show</a>
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                            <form
                                                onsubmit="return confirm('Apakah Anda Yakin akan menghapus data {{ $item->name }}?');"
                                                action="{{ route('items.destroy', $item->id) }}" method="POST">
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
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
