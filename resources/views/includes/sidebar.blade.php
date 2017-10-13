<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('bower_components/admin-lte/dist/img/avatar5.png') }}" class="img-circle"
                     alt="{{ Auth::user()->name }}">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Shortcuts</li>
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            {{-- Show this element for admin only --}}
            @if(Auth::user()->id === 1)
                <li class="{{ Request::is('admin/moderator') ? 'active' : '' }}">
                    <a href="{{ route('moderator.index') }}">
                        <i class="fa fa-user"></i> <span>Moderators</span>
                    </a>
                </li>
            @endif
            <li class="{{ Request::is('admin/team') ? 'active' : '' }}">
                <a href="{{ route('team.index') }}">
                    <i class="fa fa-signing"></i> <span>Teams</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/match') ? 'active' : '' }}">
                <a href="{{ route('match.index') }}">
                    <i class="fa fa-soccer-ball-o"></i> <span>Matches</span>
                </a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>