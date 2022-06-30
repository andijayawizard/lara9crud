@extends('adminlte::page')
@section('title', $text . ' Transactions')
{{-- @section('content_header')
    <h1>Categories</h1>
@stop --}}

@section('content')
    <h1 class="mt-4">Transaksi</h1>
    <ol class="mb-4 breadcrumb">
        <li class="breadcrumb-item active">{{ $text }} Transaksi</li>
    </ol>
    @if (isset($transaction->id))
        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
        @else
            <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf()
    <div class="mb-3">
        <label for="user_id" class="form-label">Pilih Pelanggan</label>
        <select class="form-select" id="user_id" name="user_id">
            @foreach ($users as $user)
                <option {{ old('user_id', isset($transaction->user_id)) == $user->id ? 'selected' : '' }}
                    value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Pilih Mobil</label>
        <select class="form-select" id="status" name="car_id">
            @foreach ($cars as $car)
                <option {{ old('car_id', isset($transaction->car_id)) == $car->id ? 'selected' : '' }}
                    value="{{ $car->id }}">{{ $car->name }}</option>
            @endforeach
        </select>
        @error('car_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date_end" class="form-label">Tanggal Pinjam</label>
        <input type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_start" id="date_start"
            value="{{ isset($transaction->date_start) ? old('date_start', $transaction->date_start) : old('date_start') }}">
        @error('date_start')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date_end" class="form-label">Tanggal Kembali</label>
        <input type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" id="date_end"
            value="{{ isset($transaction->date_end) ? old('date_end', $transaction->date_end) : old('date_end') }}">
        @error('date_end')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <textarea name="note" id="note" class="form-control @error('note')  @enderror">{{ isset($transaction->note) ? old('note', $transaction->note) : old('note') }}</textarea>
        @error('note')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
@endsection
