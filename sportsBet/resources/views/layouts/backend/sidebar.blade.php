<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('matches.index')}}">
                    <i class="fa fa-soccer-ball-o"></i> <span>Matches</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.users')}}">
                    <i class="fa fa-user"></i> <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.countries')}}">
                    <i class="fa fa-flag"></i> <span>Countries</span>
                </a>
            </li>
            <li>
                <a href="{{route('leagues.index')}}">
                    <i class="fa fa-trophy"></i> <span>Leagues</span>
                </a>
            </li>
            <li>
                <a href="{{route('teams.index')}}">
                    <i class="fa fa-users"></i> <span>Teams</span>
                </a>
            </li>
            <li>
                <a href="{{route('odds.index')}}">
                    <i class="fa fa-bar-chart"></i> <span>Odds</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-lock"></i> <span>Roles and Permissions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class=""></i> <span>Permissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class=""></i> <span>Roles</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
