@section('sidebar')
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Article<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/admin/articles') }}">View</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/articles/create') }}">Add New</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-tags fa-fw"></i> Tags<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/admin/tags') }}">View</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/tags/create') }}">Add New</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/tags/trash') }}">Trash</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-check-square-o fa-fw"></i> Subject<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('/admin/subjects') }}">View</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/subjects/create') }}">Add New</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            @if (Auth::user()->user_type_id === 1)
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/admin/users') }}">View</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/users/create') }}">Create</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @endif
            <li>
                <a href="{{ url('/admin/register') }}"><i class="fa fa-dashboard fa-fw"></i> Register</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
@show