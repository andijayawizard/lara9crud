@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card border-0 mt-2">
                <div class="card-body">
                    <div class="pull-left">
                        <h2>Brand Detail</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('brands.index') }}"> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nama:</strong>
                                {{ $brand->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Ringkasan:</strong>
                                {{ $brand->rgks }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Keterangan:</strong>
                                {!! $brand->ktrg !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
