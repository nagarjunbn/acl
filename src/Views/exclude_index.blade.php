@extends('ACL::layout')
@section('content')
<form action="{{ url('/acl/excludeRouteList') }}" method="post">
    {{csrf_field()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Action Name</th>
            <th>Status</th>
        </tr>
        @foreach($routes as $route)
            @php($class = '')
            @php($checked = '')
            @if(in_array($route['path'],$packageRoutes))
                @php($checked = 'checked')
                @php($class = 'hidden')
            @endif
            <tr class="{{$class}}">
                <td>{{$route['path']}} - {{$route['method']}}</td>
                @foreach($excludedRoutes as $excludedRoute)
                    @if($excludedRoute->action == $route['path'] && $excludedRoute->method == $route['method'])
                        @php($checked = 'checked')
                        @break
                    @endif
                @endforeach
                <td>
                    <input type="checkbox" name="routes[{{ $route['path'] }}][{{ $route['method'] }}]" value="{{ $route['method'] }}" {{$checked}}/>
                </td>
            </tr>
        @endforeach
    </table>
    <button type="submit" class="btn btn-info">Submit</button>
</form>
@endsection