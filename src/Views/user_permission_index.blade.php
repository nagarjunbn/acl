@extends('ACL::layout')
@section('content')
<form action="{{ url('/acl/userPermissionList/'.$user->id) }}" method="post">
    {{csrf_field()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Action Name</th>
            <th>{{$role->name}}</th>
            <th>Extra Permission</th>
            <th>Revoke Permission</th>
        </tr>
        @foreach($routes as $route)
        <tr>
            <td>{{$route['path']}} - {{$route['method']}}</td>
            @php($checked = '')
            @foreach($permissions as $permission)
            @if($permission->role_id == $role->id && $permission->action == $route['path'] && $permission->method == $route['method'])
            @php($checked = 'checked')
            @break
            @endif
            @endforeach
            <td>
                <input type="checkbox" readonly="" disabled="" {{$checked}}/>
            </td>
            @if($checked == '')
            <td>
                @php($extraCheck='')
                @foreach($extraPermissions as $extraPermission)
                    @if($extraPermission->action == $route['path'] && $extraPermission->method == $route['method'])
                        @php($extraCheck = 'checked')
                        @break
                    @endif
                @endforeach
                <input type="checkbox" name="extra_permission[{{$route['path']}}][{{$route['method']}}]" value="{{ $route['method'] }}" {{$extraCheck}}/>
            </td>
            <td></td>
            @else
            <td></td>
            <td>
                @php($revokeCheck='')
                @foreach($revokedPermissions as $revokedPermission)
                    @if($revokedPermission->action == $route['path'] && $revokedPermission->method == $route['method'])
                        @php($revokeCheck = 'checked')
                        @break
                    @endif
                @endforeach
                <input type="checkbox" name="revoke_permission[{{$route['path']}}][{{$route['method']}}]" value="{{ $route['method'] }}" {{$revokeCheck}}/>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-info">Submit</button>
</form>
@endsection