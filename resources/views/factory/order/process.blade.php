@extends('factory.layouts.factoryMaster')

@section('title')
Process Order # {{ $order->id }}
@endsection

@push('css')
@endpush

@section('content')
  <section class="content p-2">
    <div class="card">
        <div class="card-header w3-blue w3-large">
            Process Order # {{ $order->id }}
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div>
                        Ordered at: {{ $order->pending_at ? now()->parse($order->pending_at)->format('d M Y') : '' }}
                    </div>
                    <div>
                        Address: <address>
                            {{ $order->address }}
                        </address>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header h6">
                    Order items
                </div>
                <div class="card-body">
                    <form action="{{ route('factory.order.process.save',[$order]) }}" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Ordered Qty</th>
                                        <th>Shipped Qty</th>
                                        <th>Process Qty.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product_id }}</td>
                                            <td>
                                                <img  style="max-width: 200px;max-height: 100px;" src="{{ $item->product->feature_img }}" alt="">
                                            </td>
                                            <td> {{ $item->product->name }}</td>
                                            <td>{{ $item->total_quantity }}</td>
                                            <td>{{ $item->total_shipped_quantity }}</td>
                                            <td>
                                                <input type="number" class="form-control" name="process_qty_{{ $item->id }}" value="{{ ($item->total_quantity-$item->total_shipped_quantity) }}" required>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success"> <i class="fa fa-check-square"></i> Put on Process</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection


@push('js')

@auth

@else

 @endauth

@endpush
