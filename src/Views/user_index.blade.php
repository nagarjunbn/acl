@extends('ACL::layout')
@section('content')
<table class="table table-bordered table-responsive">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td></td>
    </tr>
    @endforeach
</table>
@endsection