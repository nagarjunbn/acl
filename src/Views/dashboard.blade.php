@extends('ACL::layout')
@section('content')
@if (session('status'))
<div class="alert alert-{{ session('alert') }}" role="alert">
    {{ session('status') }}
</div>
@endif
<div>
    <a href="{{url('/acl/roleList')}}">Roles list</a> <br>
    <a href="{{url('/acl/permissionList')}}">Permission list</a> <br>
    <a href="{{url('/acl/excludeRouteList')}}">Exclude Route list</a> <br>
</div>
@endsection