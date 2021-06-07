<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              {{ ucfirst($type) }}
              <small>All</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ ucfirst($type) }}</a></li>
              <li class="breadcrumb-item active">All</li>
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
              <h3 class="card-title"><i class="fa fa-th"></i> All {{ ucfirst($type) }}</h3>

              <div class="float-right">
                
                <a class="btn btn-primary bg-indigo" href="#" data-toggle="modal" data-target="#myModal">Add New {{ ucfirst($type) }}</a>
 

              </div>
            </div>

            <div class="card-body ">
              <div class="table-responsive">
                
              <table class="table table-sm table-bordered text-center">
          <thead>
            <tr>
              <th>Name</th>
              <th>Mobile</th>
              <th>Email</th>

              <th>Title of {{ $type }}</th>
              <th>Bangla Title</th>
 
      
              <th>Division</th>
              <th>District</th>
              <th>Upazila</th>
 
              <th>Address</th>
              <th>Contacts</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          @foreach($rolesAll as $admin)
            <tr>
              
              <td>{{$admin->user ? $admin->user->name : ''}}</td>
              <td>{{$admin->user ? $admin->user->mobile : ''}}</td>
              <td>{{$admin->user ? $admin->user->email : ''}}</td>
              <td>{{$admin->name}}</td>
              <td>{{$admin->translate('name','bn')}}</td>

               
              <td>{{ $admin->division->name }}</td>
              <td>{{ $admin->district->name }}</td>
              <td>{{ $admin->upazila->name }}</td>

      

              <td>
                {{ $admin->address }}
              </td>

              <td>
                {{ $admin->contact_numbers }}
              </td>

              <td>
                 @if($admin->active)
                 <span class="badge badge-success">Yes</span>
                 @else
                 <span class="badge badge-danger">No</span>
                 @endif
              </td>
 
              <td>
                <a href="{{ route('dealer.agentEdit',['dealer'=>$dealer,'agent'=>$admin]) }}"><i class="fa fa-edit"></i></a>
              </td>

            </tr>
          @endforeach
          </tbody>
        </table>
            </div>
              </div>

            <div class="card-footer text-center">
              {{$rolesAll->appends(['type' => $type])->render()}}
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

        <h4 class="modal-title">{{ __('Add New') }} {{ __(ucfirst($type)) }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

         
      </div>
      <div class="modal-body">
        <div class="card card-widget">
             
            <!-- /.card-header -->
            <!-- form start -->
            <form  class="" method="post" action="{{route('dealer.newAgentPost',$dealer)}}">
            {{csrf_field()}}
              <div class="card-body">


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
          <option>{{old('user')}}</option>
        </select>
      @if( $errors->has('user') )
        <span class="help-block">{{ $errors->first('user') }}</span>
      @endif
  </div>
 


<div class="form-group has-feedback{{ $errors->has('title ') ? ' has-error' : '' }}">
    <label for="title">{{ ucfirst($type) }} Name:</label>
     
      <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="{{ ucfirst($type)  }} Name">

      @if( $errors->has('title') )
        <span class="help-block">{{ $errors->first('title') }}</span>
      @endif

  </div>


  <div class="form-group has-feedback{{ $errors->has('title_bn ') ? ' has-error' : '' }}">
    <label for="title_bn">{{ ucfirst($type) }} Name Bangla:</label>
     
      <input type="text" name="title_bn" value="{{ old('title_bn') }}" class="form-control" placeholder="{{ ucfirst($type)  }} Name Bangla" required>

      @if( $errors->has('title_bn') )
        <span class="help-block">{{ $errors->first('title_bn') }}</span>
      @endif

  </div>

  <div class="form-group has-feedback{{ $errors->has('address ') ? ' has-error' : '' }}">
    <label for="address"> {{ __('Address') }}</label>
     
      <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="{{ __('Address') }}">

      @if( $errors->has('address') )
        <span class="help-block">{{ $errors->first('address') }}</span>
      @endif
  </div>


 <div class="form-group has-feedback{{ $errors->has('contact_numbers ') ? ' has-error' : '' }}">
    <label for="contact_numbers"> {{ __('Contact Numbers') }}</label>
     
      <input type="text" name="contact_numbers" value="{{ old('contact_numbers') }}" class="form-control" placeholder="{{ __('Contact Numbers') }}">

      @if( $errors->has('contact_numbers') )
        <span class="help-block">{{ $errors->first('contact_numbers') }}</span>
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

  <button class="btn btn-sm btn-primary  bg-indigo">Create {{ ucfirst($type) }}</button>
 







                 
 
           
 


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
