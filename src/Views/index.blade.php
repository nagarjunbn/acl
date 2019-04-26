@extends('ACL::layout')
@section('content')
<form action="{{ url('/acl/permissionList') }}" method="post">
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
            <td>{{$route['path']}} - {{$route['method']}}</td>
            @foreach($roles as $role)
            @php($checked = '')
            @foreach($permissions as $permission)
            @if($permission->role_id == $role->id && $permission->action == $route['path'] && $permission->method == $route['method'])
            @php($checked = 'checked')
            @break
            @endif
            @endforeach
            <td>
                <input type="checkbox" name="permission[{{$role->id}}][{{$route['path']}}][{{$route['method']}}]" value="{{ $route['method'] }}" {{$checked}}/>
            </td>
            @endforeach
        </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-info">Submit</button>
</form>
@endsection