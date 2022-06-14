@extends('layouts.app')

@section('content')
    <div class="container pt-2">
        <div class="card border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Order Detail</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $order->status }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Total Value:</strong>
                            {{ $order->total_value }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Taxes:</strong>
                            {!! $order->taxes !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Shipping Charges:</strong>
                            {!! $order->shipping_charges !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User ID:</strong>
                            {!! $order->user !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
