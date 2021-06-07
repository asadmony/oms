@extends('dealer.layouts.dealerMaster')

@push('css')
<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
@endpush

@section('content')
  <section class="content">
  	@include('dealer.markets.parts.marketEditPart')
  </section>
@endsection


@push('js')

 <!-- Select2 -->
<script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function () {

  $('.select2').select2({theme: 'bootstrap4'});

   
});
</script>

@endpush

