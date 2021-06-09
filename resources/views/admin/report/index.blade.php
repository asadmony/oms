@extends('admin.layouts.adminMaster')

@section('title')
{{ Str::ucfirst($type) }} Report
@endsection

@push('css')
<style>
tr.nowrap td{
    white-space: nowrap;
}
</style>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        {{ Str::ucfirst($type) }} Report
    </div>
    <div class="card-body">
        <form class="" action="" method="get">
            <div class="row text-center">
                <div class="col-md-3">
                    <select class="form-control m-2" name="time" id="">
                        <option value="">Select Time</option>
                        <option value="today" @if( isset($input['time']) && $input['time'] == 'today') selected @endif>Today</option>
                        <option value="yesterday" @if( isset($input['time']) && $input['time'] == 'yesterday') selected @endif>Yesterday</option>
                        <option value="last_7_days" @if( isset($input['time']) && $input['time'] == 'last_7_days') selected @endif>Last 7 Days</option>
                        <option value="last_month" @if( isset($input['time']) && $input['time'] == 'last_month') selected @endif>Last Month</option>
                        {{-- <option value="last_year" @if( isset($input['time']) && $input['time'] == 'last_year') selected @endif>Last Year</option> --}}
                    </select>
                    @if ($type == 'order')
                    <select class="form-control m-2" name="status" id="">
                        <option value="" selected disabled>Order Status</option>
                        <option value="">All</option>
                        <option value="pending" @if( isset($input['status']) && $input['status'] == 'pending') selected @endif>Pending</option>
                        <option value="confirmed" @if( isset($input['status']) && $input['status'] == 'confirmed') selected @endif>Confirmed</option>
                        <option value="processing" @if( isset($input['status']) && $input['status'] == 'processing') selected @endif>Processing</option>
                        <option value="ready_to_ship" @if( isset($input['status']) && $input['status'] == 'ready_to_ship') selected @endif>Ready to ship</option>
                        <option value="shipped" @if( isset($input['status']) && $input['status'] == 'shipped') selected @endif>Shipped</option>
                        <option value="collected" @if( isset($input['status']) && $input['status'] == 'collected') selected @endif>Collected</option>
                        <option value="delivered" @if( isset($input['status']) && $input['status'] == 'delivered') selected @endif>Delivered</option>
                        <option value="canceled" @if( isset($input['status']) && $input['status'] == 'canceled') selected @endif>Canceled</option>
                    </select>
                    @endif

                    @if ($type == 'product')
                    <div class="ml-2">
                        <select class="form-control select2" name="products[]" id="" multiple="multiple" >
                            @foreach ($allProducts as $prod)
                            <option value="{{ $prod->id }}" @if(isset($input['products']) && in_array($prod->id, $input['products'])) selected @endif>{{ $prod->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">From: </label>
                        <input class="form-control col-sm-9" type="date" name="from" id="" value="{{ $input ? $input['from'] : '' }}">
                    </div>
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">To: </label>
                        <input class="form-control col-sm-9" type="date" name="to" id="" value="{{ $input ? $input['to'] : '' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">SR: </label>
                        <select class="form-control col-sm-9 select2" name="sr[]" id=""  multiple="multiple">
                            <option value="">Select SR</option>
                            @foreach ($srs as $sr)
                            <option value="{{ $sr->id }}" @if( isset($input['sr']) &&  in_array($sr->id, $input['sr'])) selected @endif >{{ $sr->name }} ({{ $sr->user->mobile }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">Shop: </label>
                        <select class="form-control col-sm-9 select2" name="shop[]" id=""  multiple="multiple">
                            <option value="">Select Shop</option>
                            @foreach ($shops as $shop)
                            <option value="{{ $shop->id }}"  @if( isset($input['shop']) && in_array($shop->id, $input['shop'])) selected @endif>{{ $shop->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary m-2" type="submit"><i class="fa fa-search"></i> Search</button>
                    <button class="btn btn-primary m-2" type="submit" onclick="event.preventDefault()"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            
            <div>
                
            </div>
            
            {{-- <input class="form-control mx-2" type="text" name="query" id="" placeholder="search"> --}}
            
        </form>
        
        <div class="container">
            @if (!isset($input['time']) && !isset($input['status']) && !isset($input['sr']) && ! isset($input['shop']) && !isset($input['from']) && !isset($input['to']) && !isset($input['products']))
                **Please select some parameter then search for report.
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="h4 card-header">
        {{ Str::ucfirst($type) }} Report
    </div>
    <div class="card-header">
        @if ($type == 'order')
            @if(isset($input['time']) || isset($input['status']) || isset($input['sr']) || isset($input['shop']) || isset($input['from']) || isset($input['to']) || isset($input['products']))
                @include('admin.report.orderReport')
            @endif
        @elseif($type == 'collection')
            @if (isset($input['time']) || isset($input['status']) || isset($input['sr']) || isset($input['shop']) || isset($input['from']) || isset($input['to']) || isset($input['products']))
            @include('admin.report.collectionReport')
                
            @endif
        @elseif($type == 'return')
            @if (isset($input['time']) || isset($input['status']) || isset($input['sr']) || isset($input['shop']) || isset($input['from']) || isset($input['to']) || isset($input['products']))
            @include('admin.report.returnReport')
                
            @endif
        @elseif($type == 'product')
            @if (isset($input['time']) || isset($input['status']) || isset($input['sr']) || isset($input['shop']) || isset($input['from']) || isset($input['to']) || isset($input['products']))
            @include('admin.report.productSalesReport')
                
            @endif
        @elseif($type == 'sr')
            @if (isset($input['sr']))
                @include('admin.report.srReport')
            @endif
        @elseif($type == 'shop')
            @if (isset($input['shop']))
                @include('admin.report.shopReport')
            @endif
        @endif
    </div>
</div>


@endsection


@push('js')
<script>
    $(document).ready(function () {
        $('.select2').select2({theme: 'bootstrap4'});
    });
</script>

 <!-- Select2 -->
 <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
@endpush
