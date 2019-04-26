@extends('ACL::layout')
@section('content')
<table class="table table-bordered table-responsive">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{isset($user->Role->name) ? $user->Role->name : ''}}</td>
        <td>
            <a href="{{url('/acl/userPermissionList/'.$user->id)}}">Manage Permission</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection