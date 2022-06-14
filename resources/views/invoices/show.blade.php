@extends('layouts.app')

@section('content')
    <div class="container pt-2">
        <div class="card border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Invoice Detail</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Id:</strong>
                            {{ $invoice->id }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Raised at:</strong>
                            {{ $invoice->raised_at }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {!! $invoice->status !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Total Amount:</strong>
                            {!! $invoice->totalAmount !!}
                        </div>
                    </div>
                    Order Id {{ $invoice->order_id }}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {!! $invoice->orders_status !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Total Value:</strong>
                            {!! $invoice->orders_total_value !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Taxes:</strong>
                            {!! $invoice->orders_taxes !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Shipping Charges:</strong>
                            {!! $invoice->orders_shipping_charges !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User:</strong>
                            {!! $invoice->users_name !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
