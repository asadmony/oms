@if (isset($users) && $users->count() > 0)
@foreach ($users as $user)
<tr class="nowrap">
    <td>{{ $user->id }}</td>
    <td>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.ecommerce.user.edit', $user) }}"><i class="fa fa-edit"></i></a>

        {{-- <a class="btn btn-danger btn-sm" href="" onclick="event.preventDefault(); if(confirm('are you sure to delete?')){$('#sales_list_delete_{{ $user->id }}').submit()}" >delete</a>
        <form action="{{ route('admin.ecommerce.salesList.destroy', [$user]) }}" id="sales_list_delete_{{ $user->id }}" method="post">
            @csrf
            @method('delete')
        </form> --}}
    </td>
    {{-- <td><img style="max-width: 100%; max-height: 80px;" src="{{ $user->img_name }}" alt=""></td> --}}
    <td>{{ $user->name }}</td>
    {{-- <td>{{ $user->email }}</td> --}}
    <td>{{ $user->mobile }}</td>
    <td>{{ $user->nid }}</td>
    <td> {{ $user->agents->count() }}</td>
    <td> {{ $user->dealers->count() }}</td>
    <td> {{ $user->distributors->count() }}</td>
    <td> {{ $user->depos->count() }}</td>
    <td>{{ $user->dob ? now()->parse($user->dob)->format('d-M-Y') : '' }}</td>
    <td>{{ $user->password_temp }}</td>
    <td>{{ $user->user_status ? 'Active' : 'Inactive' }}</td>
    {{-- <td>{{ $user->addedby ? $user->addedby->user->name.' ('.$user->addedby->user->mobile.')' : '' }}</td> --}}
    
</tr>
@endforeach
@else
    <tr>
        <td colspan="15">No result found.</td>
    </tr>
@endif