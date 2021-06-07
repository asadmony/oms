@extends('admin.layouts.adminMaster')

@section('title')
    Users List
@endsection

@push('css')
<style>
tr.nowrap td {
    white-space: nowrap;
}
</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Users
    </div>
    <div class="card-body w3-grey">
            @include('alerts.alerts')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-widget-">
                    <div class="card-header w3-medium w3-purple">
                        User Info
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ecommerce.user.update', $user) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input class="form-control" type="text" name="mobile" value="{{ $user->mobile }}">
                            </div>
                            <div class="form-group">
                                <label for="nid">National ID no.</label>
                                <input class="form-control" type="text" name="nid" value="{{ $user->nid }}">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input class="form-control" type="date" name="dob" value="{{ $user->dob }}">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success"> <i class="fa fa-save"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-widget-">
                    <div class="card-header w3-medium w3-deep-orange">
                        Update Password
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ecommerce.user.password', $user) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Password</label>
                                <input class="form-control" type="text" name="password">
                            </div>
                            @if ($user->password_temp)
                                <div class="pb-3">
                                    Previous Temp. Password : {{ $user->password_temp }}
                                </div>
                            @endif
                            <div class="text-center">
                                <button class="btn btn-success"> <i class="fa fa-save"></i> Set & Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@push('js')
<script>

</script>
@endpush
