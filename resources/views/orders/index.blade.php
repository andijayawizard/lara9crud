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
                        <a href="{{ route('orders.create') }}" class="btn btn-md btn-success mb-3">Add new Item</a>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total Value</th>
                                    <th scope="col">Taxes</th>
                                    <th scope="col">Shipping Charges</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->status }}</td>
                                        <td>{!! $order->total_value !!}</td>
                                        <td>{!! $order->taxes !!}</td>
                                        <td>{!! $order->shipping_charges !!}</td>
                                        <td>{{ $order->user }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-xs"
                                                href="{{ route('orders.show', $order->id) }}">Show</a>
                                            <a href="{{ route('orders.edit', $order->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                            <form
                                                onsubmit="return confirm('Apakah Anda Yakin akan menghapus data {{ $order->name }}?');"
                                                action="{{ route('items.destroy', $order->id) }}" method="POST">
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
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
