<a class="toggle-btn-for-lead-info-add btn btn-link" href=""> <i class="fa fa-edit"></i>   {{__('Update lead information')}}</a>  

@if($lead->name and $lead->price)
	({{ __('Updated') }})
@endif

     <div class="add-new-lead-info float-left w-100" style="display: none;">

      <br>
 
    <form method="POST" class="lead-info-update-form" action="{{ route('agent.leadInfoUpdate',['agent'=>$agent,'lead'=>$lead]) }}">

    @csrf

    <div class="form-group mb-1 row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Lead Name') }}*</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control input-for-new-user form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?: $lead->name }}" placeholder="{{ __('Lead Name with size') }}" required autocomplete="name" autofocus >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="product_condition" class="col-md-4 col-form-label text-md-right">{{ __('Lead Condition') }}*</label>

        <div class="col-md-6">

          <select name="product_condition" class="form-control form-control-sm" id="product_condition" required>
          	@if($lead->product_condition)
          	<option value="{{ $lead->product_condition }}">{{ $lead->product_condition }}</option>
          	@endif
            @foreach(config('parameter.product_conditions') as $condition)
            @if($lead->product_condition != $condition)
            <option value="{{ $condition }}">{{ $condition }}</option>
            @endif
            @endforeach
          </select>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="mobile_optional" class="col-md-4 col-form-label text-md-right">{{ __('Mobile (Optional)') }}</label>

        <div class="col-md-6">
            <input id="mobile_optional" type="text" class="form-control input-for-new-user form-control-sm @error('mobile_optional') is-invalid @enderror" name="mobile_optional" value="{{ old('mobile_optional') ?: $lead->mobile_optional }}" placeholder="{{ __('Mobile Optional') }}"  autocomplete="mobile_optional" >
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="general_category" class="col-md-4 col-form-label text-md-right">{{ __('Lead Category') }}*</label>

        <div class="col-md-6">

          <select name="general_category" class="form-control form-control-sm" id="general_category" required>
          	@if($lead->general_cat_id)
          	<option value="{{ $lead->general_cat_id }}">{{ $lead->generalCat->name }}</option>
          	@else
            <option value="">{{ __('Select Category') }}</option>
          	@endif
            @foreach($generalCats as $cat)

            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div style="display: none;" class="general-subcats-all" data-value="{{ $generalSubcats }}"> </div>

    <div class="form-group mb-1 row">
        <label for="general_subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Lead Subcategory') }}*</label>

        <div class="col-md-6">

          <select name="general_subcategory" class="form-control form-control-sm" id="general_subcategory" required>

          	@if($lead->general_subcat_id)
          	<option value="{{ $lead->general_subcat_id }}">{{ $lead->generalSubcat->name }}</option>
          	@else
            <option value="">{{ __('Lead Subcategory') }}</option>
          	@endif
             
            
            
          </select>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="mfg_date" class="col-md-4 col-form-label text-md-right">{{ __('Manufacture Date') }}</label>
        <div class="col-md-6">
          <input type="date" name="mfg_date" value="{{ $lead->mfg_date }}" class="form-control form-control-sm">
        </div>
    </div> 

    <div class="form-group mb-1 row">
        <label for="exp_date" class="col-md-4 col-form-label text-md-right">{{ __('Expired Date') }}</label>
        <div class="col-md-6">
          <input type="date" value="{{ $lead->exp_date }}" name="exp_date"  class="form-control form-control-sm" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Unit Price (BDT)') }}*</label>
        <div class="col-md-6">
          <input type="number" name="price" min="1" step="1" placeholder="{{ __('Price in BDT') }}"  value="{{ $lead->price }}" class="form-control form-control-sm" required>
        </div>
    </div>

     

    <div class="form-group mb-1 row">
        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
        <div class="col-md-6">
          <input type="number" name="quantity" min="1" step="1" placeholder="{{ __('Quantity') }}" value="{{ $lead->quantity }}" class="form-control form-control-sm" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="min_order_quantity" class="col-md-4 col-form-label text-md-right">{{ __('MOQ') }}*</label>
        <div class="col-md-6">
          <input type="number" name="min_order_quantity" min="1" step="1" placeholder="{{ __('Minimum Order Quantity') }}" value="{{ $lead->min_order_quantity }}" class="form-control form-control-sm" required >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="max_order_quantity" class="col-md-4 col-form-label text-md-right">{{ __('Max Order Qty') }}</label>
        <div class="col-md-6">
          <input type="number" name="max_order_quantity" min="1" step="1" placeholder="{{ __('Maximum Order Quantity') }}" value="{{ $lead->max_order_quantity }}"  class="form-control form-control-sm"  >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="unit_weight" class="col-md-4 col-form-label text-md-right">{{ __('Unit Weight') }}*</label>
        <div class="col-md-6 d-flex">
          <input type="number" name="unit_weight" min="0" step="any" placeholder="{{ __('Weight per unit') }}"  class="form-control form-control-sm w-50" value="{{ $lead->unit_weight }}" required >

          <select name="unit" id="unit" class="form-control form-control-sm w-50">
          @foreach(config('parameter.unit') as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
          @endforeach            
          </select>

        </div>
    </div>  

    <div class="form-group mb-1 row mb-1">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update Information') }}
            </button>
        </div>
    </div>
</form>


</div>


<br>
<br>

 <a class="toggle-btn-for-lead-description-add btn btn-link" href=""> <i class="fa fa-edit"></i>   {{__('Update lead description')}}</a>

 @if ($lead->description)
 	({{ ('Updated') }})
 @endif



     <div class="add-new-lead-description float-left w-100" style="display: none;">

  <br>

      <form method="post" class="lead-info-update-form" action="{{ route('agent.leadDescriptionUpdate',['agent'=>$agent,'lead'=>$lead]) }}">
      	@csrf
      	
    <div class="form-group">
      <label for="description">{{ __('Description') }}:</label>
      <textarea class="form-control summernote" rows="10" id="description" name="description">{!! $lead->description !!}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">{{ __('Update Description') }}</button>
  </form>


     </div>