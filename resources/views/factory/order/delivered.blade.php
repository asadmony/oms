@extends('factory.layouts.factoryMaster')

@section('title')
Delivered Order List
@endsection

@push('css')
@endpush

@section('content')
  <section class="content p-2">
    <div class="card">
        <div class="card-header w3-green w3-large">
            Delivered Orders
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table bordered table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Ordered at</th>
                            <th>Shipped at</th>
                            <th>Items</th>
                            {{-- <th>Price</th> --}}
                            <th>Status</th>
                            <th>Order For</th>
                            <th>Order By</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td>{{ now()->parse($order->pending_at)->format('d-M-Y h:m A') }}</td>
                                <td>{{ now()->parse($order->shipped_at)->format('d-M-Y h:m A') }}</td>
                                <td class="text-center">{{ $order->items->count() }}</td>
                                {{-- <td>
                                    &#2547; {{ $order->total_price }}
                                </td> --}}
                                <td class="text-center">{{ Str::ucfirst($order->order_status) }}</td>
                                <td>
                                    {{ $order->mobile }}
                                </td>
                                <td>
                                    @if ($order->agent_id)
                                         {{ $order->orderByAgent->name }}
                                    @else
                                        Self
                                    @endif
                                </td>
                                {{-- <td>
                                    <form action="{{ route('factory.order.readyToShip', [$order->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" > <i class="fas fa-shipping-fast"></i> Ship</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="responsive">
                {{ $orders->links() }}
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

