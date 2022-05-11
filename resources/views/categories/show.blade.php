@extends('layouts.app')

@section('content')
    <div class="container pt-2">
        <div class="card border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Category Detail</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('brands.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nama:</strong>
                            {{ $category->nama }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ringkasan:</strong>
                            {{ $category->rgks }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Keterangan:</strong>
                            {!! $category->ktrg !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
