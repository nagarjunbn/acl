@extends('layouts.app')
@section('content')
<form action="{{ url('/permission/updatePermission') }}" method="post">
    {{csrf_field()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Action Name</th>
            @foreach($roles as $role)
            <th>{{$role->name}}</th>
            @endforeach
        </tr>
        @foreach($routes as $route)
        <tr>
            <td>{{$route['path']}}</td>
            @foreach($roles as $role)
            @php($checked = false)
            @foreach($permissions as $permission)
            @if($permission->role_id == $role->id && $permission->action == $route['path'])
            @php($checked = true)
            @endif
            @endforeach
            @if($checked)
            <td>
                <input type="checkbox" name="permission[{{$role->id}}][{{$route['path']}}]" value="{{ $route['path'] }}" checked=""/>
            </td>
            @else
            <td>
                <input type="checkbox" name="permission[{{$role->id}}][{{$route['path']}}]" value="{{ $route['path'] }}"/>
            </td>
            @endif
            @endforeach
        </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-info">Submit</button>
    <a class="btn btn-default pull-right" href="{{ url('/home') }}">Cancel</a>
</form>
@endsection