<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              {{ __('Markets') }}
              <small>{{ __('All') }}</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('Markets') }}</a></li>
              <li class="breadcrumb-item active">{{ __('All') }}</li>
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
              <h3 class="card-title"><i class="fa fa-th"></i> All {{ __('Markets') }}</h3>

              <div class="float-right">
                 
                <a class="btn btn-primary bg-indigo" href="#" data-toggle="modal" data-target="#myModal"> {{ __('Add New Market') }}</a>
 

              </div>
            </div>

            <div class="card-body ">
              <div class="table-responsive">
                
            	<table class="table table-sm table-bordered text-center">
			    <thead>
			      <tr>

              <th>Division</th>
              <th>District</th>
			        <th>Upazila</th>
              <th>Agent</th>

              <th>Market Name</th>
              <th>Market Name Bangla</th>

              <th>Active</th>

			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>

			    @foreach($markets as $market)
			      <tr>
              
			        <td>{{$market->division->name}}</td>
              <td>{{$market->district->name}}</td>
			        <td>{{$market->upazila->name}}</td>
              <td>
                @if($market->agent)
                {{ $market->agent->name }} 
                @if($market->agent->user)
                ({{ $market->agent->user->mobileOrEmail() }})
                @endif
                @endif
              </td>
              <td>{{$market->name}}</td>
              <td>{{$market->name_bn}}</td>

              <td>
                 @if($market->active)
                 <span class="badge badge-success">Yes</span>
                 @else
                 <span class="badge badge-danger">No</span>
                 @endif
              </td>
 
			        <td>
                <a href="{{ route('dealer.marketEdit', ['dealer'=>$dealer, 'market'=>$market]) }}"><i class="fa fa-edit"></i></a>
              </td>

			      </tr>
			    @endforeach
			    </tbody>
			  </table>
              </div>
            </div>

            <div class="card-footer text-center">
            	{{$markets->render()}}
            </div>
        </div>
      	
      </div>        
      </div>
      <!-- /.row -->




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">{{ __('Add New') }} {{ __('Market') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

         
      </div>
      <div class="modal-body">
        <div class="card card-widget">
             
            <!-- /.card-header -->
            <!-- form start -->
            <form  class="" method="post" action="{{ route('dealer.addNewMarketPost',$dealer) }}">
            {{csrf_field()}}
              <div class="card-body">
   
 


<div class="form-group has-feedback{{ $errors->has('name ') ? ' has-error' : '' }}">
    <label for="name">{{ __('Market') }} Name:</label>
     
      <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{  __('Market')  }} Name">

      @if( $errors->has('name') )
        <span class="help-block">{{ $errors->first('name') }}</span>
      @endif

  </div>

  <div class="form-group has-feedback{{ $errors->has('name_bn ') ? ' has-error' : '' }}">
    <label for="name_bn">{{ __('Market') }} Bangla Name:</label>
     
      <input type="text" name="name_bn" value="{{ old('name_bn') }}" class="form-control" placeholder="{{  __('Market')  }} Name Bangla">

      @if( $errors->has('name_bn') )
        <span class="help-block">{{ $errors->first('name_bn') }}</span>
      @endif

  </div>


  <div class=" form-group has-feedback {{ $errors->has('agent') ? ' w3-text-red' : '' }}">
    <label for="agent">Agent:</label>
     
     <select style="width:100%;" class="form-control select2" name="agent" id="agent">
      <option value="">Select Agent</option>
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
          <input class="form-check-input" type="checkbox" name="active" id="active"  checked >

          <label class="form-check-label" for="active">
              {{ __('Active') }}
          </label>
      </div>
  </div>

  <button class="btn btn-sm btn-primary bg-indigo">Create  {{ __('Market') }}</button>
 







                 
 
           
 


              </div>
              <!-- /.card-body -->
               
            </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
      

      

    </section>
