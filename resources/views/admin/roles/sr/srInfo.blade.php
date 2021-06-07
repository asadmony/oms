@if (isset($agent))
<div class="card">
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">SR : {{ $agent->name }} </li>
            <li class="list-group-item">SR Name: {{ $agent->user->name }} </li>
            <li class="list-group-item">Mobile: {{ $agent->mobile ?? $agent->user->mobile }} </li>
            <li class="list-group-item">SMO: {{ $agent->dealer->name }} ({{ $agent->upazila->name }}) </li>
            <li class="list-group-item">Distributor: {{ $agent->distributor->name }} ({{ $agent->district->name }}) </li>
            <li class="list-group-item">GM: {{ $agent->depo->name }} ({{ $agent->division->name }}) </li>
        </ul>
    </div>
</div>
@endif