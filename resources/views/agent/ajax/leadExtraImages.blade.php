@if($lead->imageFirst())
<div class="card card-widget">
	<div class="card-body">
		<div class="d-flex p-1  justify-content-center">
		  @foreach($lead->images() as $img)
			<div class="p1 text-center">
				<img width="60" height="60" class="m-1 img-rounded" src="{{ asset($img->img()) }}" alt="Image"> <br>
				<a class="lead-extra-img-delete" href="{{ route('agent.leadExtraImageDelete',['agent'=>$agent, 'media'=>$img]) }}"><i class="fa fa-trash"></i></a>
			</div>
		  @endforeach
		</div>
	</div>
</div>
@endif