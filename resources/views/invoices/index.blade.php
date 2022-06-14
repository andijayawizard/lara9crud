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
                        <a href="{{ route('invoices.create') }}" class="btn btn-md btn-success mb-3">Add new Item</a>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Raised at</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td class="text-center">
                                            {{ $invoice->id }}
                                        </td>
                                        <td>{{ $invoice->raised_at }}</td>
                                        <td>{!! $invoice->status !!}</td>
                                        <td>{!! $invoice->totalAmount !!}</td>
                                        <td>{!! $invoice->order_id !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-xs"
                                                href="{{ route('invoices.show', $invoice->id) }}">Show</a>
                                            <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                class="btn btn-xs btn-primary">Edit</a>
                                            <form
                                                onsubmit="return confirm('Apakah Anda Yakin akan menghapus data {{ $invoice->name }}?');"
                                                action="{{ route('invoices.destroy', $invoice->id) }}" method="POST">
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
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
