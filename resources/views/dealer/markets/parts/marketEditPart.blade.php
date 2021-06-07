<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>
  {{ __('Market') }}
  <small> {{ __('Edit') }}</small>
</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="#">{{ __('Market') }}</a></li>
  <li class="breadcrumb-item active">{{ __('Edit') }}</li>
</ol>
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content"> 




<!-- Info cardes -->
<div class="row">
<div class="col-md-12">

@include('alerts.alerts')

<div class="card card-widget">
<div class="card-header with-border">
  <h3 class="card-title"><i class="fa fa-th"></i> Edit {{ __('Market') }}</h3>


</div>

<form  class="" method="post" action="{{ route('dealer.marketEditPost',['dealer'=>$dealer, 'market'=>$market]) }}">
{{csrf_field()}}
  <div class="card-body">




<div class="form-group has-feedback{{ $errors->has('name ') ? ' has-error' : '' }}">
<label for="name">{{ __('Market') }} Name:</label>

<input type="text" name="name" value="{{ old('name') ?: $market->name }}" class="form-control" placeholder="{{  __('Market')  }} Name">

@if( $errors->has('name') )
<span class="help-block">{{ $errors->first('name') }}</span>
@endif

</div>

<div class="form-group has-feedback{{ $errors->has('name_bn ') ? ' has-error' : '' }}">
<label for="name_bn">{{ __('Market') }} Bangla Name:</label>

<input type="text" name="name_bn" value="{{ old('name_bn') ?: $market->translate('name','bn') }}" class="form-control" placeholder="{{  __('Market')  }} Name Bangla">

@if( $errors->has('name_bn') )
<span class="help-block">{{ $errors->first('name_bn') }}</span>
@endif

</div>


<div class=" form-group has-feedback {{ $errors->has('agent') ? ' w3-text-red' : '' }}">
<label for="agent">Agent:</label>

<select style="width:100%;" class="form-control select2" name="agent" id="agent">
<option value="{{ $market->agent_id }}">{{ $market->agent->name }}
@if($market->agent->user) 
  ({{ $market->agent->user->name }}) ({{ $market->agent->user->mobileOrEmail() }}) 
@endif
</option>
@foreach($agents as $agent)
<option value="{{ $agent->id }}">{{ $agent->name }} 
@if($agent->user)
  ({{ $agent->user->name }}) ({{ $agent->user->mobileOrEmail() }})  
@endif
</option>
@endforeach
</select>
@if( $errors->has('agent') )
<span class="help-block">{{ $errors->first('agent') }}</span>
@endif
</div>



<div class="form-group  ">
<div class="form-check">
<input class="form-check-input" type="checkbox" name="active" id="active"  {{ $agent->active ? 'checked' : '' }} >

<label class="form-check-label" for="active">
  {{ __('Active') }}
</label>
</div>
</div>

<button class="btn btn-sm btn-primary">Update  {{ __('Market') }}</button>


  </div>
  <!-- /.card-body -->
   
</form>

<div class="card-footer text-center">
	 
</div>
</div>

</div>        
</div>
<!-- /.row -->

</section>
