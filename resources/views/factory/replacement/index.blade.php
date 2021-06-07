@extends('factory.layouts.factoryMaster')

@section('title')
Replacement List
@endsection

@push('css')
@endpush

@section('content')
  <section class="content p-2">
    <div class="card">
        <div class="card-header w3-green w3-large">
            Replacement List
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table bordered table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Action</th>
                            <th>Ordered at</th>
                            <th>Items</th>
                            {{-- <th>Price</th> --}}
                            <th>Status</th>
                            <th>Order For</th>
                            <th>Order By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($replacements as $replacement)
                            <tr>
                                <td class="text-center">{{ $replacement->id }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('factory.replacement.process', [$replacement->id]) }}"><i class="fas fa-box-open"></i> Process</a>
                                </td>
                                <td>{{ now()->parse($replacement->return_at)->format('d-M-Y h:m A') }}</td>
                                <td class="text-center">{{ $replacement->items()->count() }}</td>
                                {{-- <td>
                                    &#2547; {{ $replacement->total_price }}
                                </td> --}}
                                <td class="text-center">{{ Str::ucfirst($replacement->order_status) }}</td>
                                <td>
                                    {{ $replacement->mobile }}
                                </td>
                                <td>
                                    @if ($replacement->agent_id)
                                        {{ $replacement->agent->name }}
                                    @else
                                        Self
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="responsive">
                {{ $replacements->links() }}
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

