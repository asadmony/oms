@if ($lead->name and $lead->price and $lead->description)
 	

<i class="fa fa-th"></i> {{ __('Lead information and description updated') }}


<br> <br> 

<a class="btn btn-primary btn-xs" href="{{ route('agent.leadFinalSubmit', ['agent'=>$agent, 'lead'=> $lead]) }}">{{ __('Submit the lead for review') }}</a>

@elseif($lead->name and $lead->price)
<i class="fa fa-th"></i> {{ __('Lead information updated') }}
@else
<a class="lead-info-modal-lg" href="{{ route('agent.leadInfoModalOpen',['agent'=>$agent,'lead'=>$lead]) }}">

  <i class="fa fa-th"></i> {{ __('Set lead information') }}
      
    </a>

 @endif 
