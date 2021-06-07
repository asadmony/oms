@if($lead->user)
<img width="30" src="{{ asset($lead->user->pp()) }}" alt="User ">
&nbsp; {{ $lead->user->mobileOrEmail() }} ({{ $lead->user->name }})

@if($lead->source)
<br>
{{ $lead->source->name }} ({{ $lead->source->type }}) ({{ $lead->source->market->name }})
@endif
@else
<a class="user-create-modal-lg" href="{{ route('agent.leadOwnerModalOpen',['agent'=>$agent,'lead'=>$lead]) }}">
  <img width="30" src="{{ asset('img/ppm.jpg') }}" alt="User ">

  {{ __('Set Lead Owner') }}
      
    </a>
@endif