@extends('factory.layouts.factoryMaster')

@section('title')
    Product List
@endsection

@push('css')
<style>
    td{
        white-space: nowrap;
    }
    th{
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
  <section class="content p-2">
    <div class="card">
        <div class="card-header w3-green w3-large">
            Products
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm text-center">
                    <thead>
                        <tr >
                            <th>Id</th>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm my-1" href="{{ route('factory.product.view', $product) }}">view</a>
                            </td>
                            <td class="text-center"><img style="max-width: 100%; max-height: 40px;" src="{{ $product->feature_img }}" alt=""></td>
                            <td>{{ $product->name ?? '' }}</td>
                            <td>
                                &#2547; {{ $product->purchase_price }} 
                            </td>
                            <td>{{ $product->category->name ?? '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="responsive">
                {{ $products->links() }}
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

