@if (isset($orders) && $orders->count() > 0)
@foreach ($orders as $order)
<tr>
    <td class="text-center">{{ $order->id }}</td>
    <td>
        <a class="btn btn-primary btn-sm " href="{{ route('admin.ecommerce.order', [$order->id]) }}">manage</a>
    </td>
    <td>{{ now()->parse($order->pending_at)->format('d-M-Y h:m A') }}</td>
    <td class="text-center">{{ $order->items->count() }}</td>
    <td>
        &#2547; {{ $order->total_price }}  
    </td>
    <td class="text-center @if($order->order_status == 'pending') w3-blue @elseif($order->order_status == 'canceled') w3-red @else w3-green @endif">{{ Str::ucfirst($order->order_status) }}</td>
    <td>
        {{ $order->orderForSource->name }}
    </td>
    <td>
        @if ($order->agent_id)
            {{ $order->orderByAgent->name }}
        @else
            Self
        @endif
    </td>
</tr>
@endforeach
@else
    <tr>
        <td colspan="15">No result found.</td>
    </tr>
@endif