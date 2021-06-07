 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              Agent
              <small>Edit</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Agent</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
              <h3 class="card-title"><i class="fa fa-edit"></i> Edit Agent</h3>
 
            </div>

            <div class="card-body">

 <form  class="" method="post" action="{{route('dealer.agentEditPost',['dealer'=>$dealer, 'agent'=> $agent])}}">
            {{csrf_field()}}

              <div class="form-group has-feedback{{ $errors->has('user') ? ' has-error' : '' }}">
    <label for="user"> {{ __('User') }}:</label>

    <select id="user"
      name="user"
      class="form-control select2-container step2-select select2"
      data-placeholder="Mobile or Email"
      data-ajax-url="{{route('user.selectUser')}}"
      data-ajax-cache="true"
      data-ajax-dataType="json"
      data-ajax-delay="200"
      style="width: 100%;">


          <option value="{{ $agent->user_id }}">{{$agent->user->mobileOrEmail().' ('.$agent->user->name.')'}}</option>
        </select>
      @if( $errors->has('user') )
        <span class="help-block">{{ $errors->first('user') }}</span>
      @endif
  </div>
 


<div class="form-group has-feedback{{ $errors->has('title ') ? ' has-error' : '' }}">
    <label for="title">Agent Name:</label>
     
      <input type="text" name="title" value="{{ old('title') ?: $agent->translate('name', 'en') }}" class="form-control" placeholder="{{ ucfirst($type)  }} Name">

      @if( $errors->has('title') )
        <span class="help-block">{{ $errors->first('title') }}</span>
      @endif

  </div>

  <div class="form-group has-feedback{{ $errors->has('title_bn ') ? ' has-error' : '' }}">
    <label for="title_bn">Agent Name Bangla:</label>
     
      <input type="text" name="title_bn" value="{{ old('title_bn') ?: $agent->translate('name','bn') }}" class="form-control" placeholder="{{ ucfirst($type)  }} Name Bangla" required>

      @if( $errors->has('title_bn') )
        <span class="help-block">{{ $errors->first('title_bn') }}</span>
      @endif

  </div>

  <div class="form-group has-feedback{{ $errors->has('address ') ? ' has-error' : '' }}">
    <label for="address"> {{ __('Address') }}</label>
     
      <input type="text" name="address" value="{{ old('address')  ?: $agent->address}}" class="form-control" placeholder="{{ __('Address') }}">

      @if( $errors->has('address') )
        <span class="help-block">{{ $errors->first('address') }}</span>
      @endif
  </div>


 <div class="form-group has-feedback{{ $errors->has('contact_numbers ') ? ' has-error' : '' }}">
    <label for="contact_numbers"> {{ __('Contact Numbers') }}</label>
     
      <input type="text" name="contact_numbers" value="{{ old('contact_numbers') ?: $agent->contact_numbers }}" class="form-control" placeholder="{{ __('Contact Numbers') }}">

      @if( $errors->has('contact_numbers') )
        <span class="help-block">{{ $errors->first('contact_numbers') }}</span>
      @endif
  </div>

  <div class="form-group  ">
      <div class="form-check">
          <input class="form-check-input" type="checkbox" name="active" id="active" {{ $agent->active ? 'checked' : '' }}>

          <label class="form-check-label" for="active">
              {{ __('Active') }}
          </label>
      </div>
  </div>

  <button class="btn btn-sm btn-primary">Update Agent</button>
 



 </form>
            </div>
 
        </div>
      	
      </div>        
      </div>
      <!-- /.row -->


 
      

      

    </section>
