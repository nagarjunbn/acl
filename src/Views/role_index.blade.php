@extends('layouts.app')
@section('content')
<form action="{{ url('/acl/roleList') }}" method="post">
    {{csrf_field()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
        <tr>
            <td><input name="name" class="form-control" required=""/></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-info">Submit</button>
</form>
@endsection