@extends('layouts.app')
@section('content')
<form action="{{ url('/acl/excludeRouteList') }}" method="post">
    {{csrf_field()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Action Name</th>
            <th>Status</th>
        </tr>
        @foreach($routes as $route)
        <tr>
            <td>{{$route['path']}}</td>
            @php($checked = '')
            @foreach($excludedRoutes as $excludedRoute)
                @if($excludedRoute->action == $route['path'])
                    @php($checked = 'checked')
                    @break
                @endif
            @endforeach
            <td>
                <input type="checkbox" name="routes[]" value="{{ $route['path'] }}" {{$checked}}/>
            </td>
        </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-info">Submit</button>
</form>
@endsection