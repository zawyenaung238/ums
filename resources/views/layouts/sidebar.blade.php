<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ set_active(['home']) }}"> <a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
                <li class="submenu">
                    @if(auth()->user()->role->hasPermission('read') || auth()->user()->role_id == '1')
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span> Users Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    @endif
                    <ul class="submenu_class" style="display: none;">
                        {{-- <li><a class="{{ set_active(['users/list/page']) }}" href="{{ route('users/list/page') }}">All User</a></li>
                        <li><a class="{{ set_active(['users/add/new']) }}" href="{{ route('users/add/new') }}">Add User</a></li> --}}
                        @if(auth()->user()->role->hasPermission('read') || auth()->user()->role_id == '1')
                        <li><a class="{{ set_active(['user']) }}" href="{{ route('user.index') }}">All User</a></li>
                        @endif
                        @if(auth()->user()->role->hasPermission('create') || auth()->user()->role_id == '1')
                        <li><a class="{{ set_active(['user/create']) }}" href="{{ route('user.create') }}">Add User</a></li>
                        @endif
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span> Roles Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="submenu_class" style="display: none;">
                        @if(auth()->user()->role->permissions()->where('name', 'read')->exists() || auth()->user()->role_id == '1')
                        <li><a class="{{ set_active(['role']) }}" href="{{ route('role.index') }}">Role List</a></li>
                        @endif
                        @if(auth()->user()->role->permissions()->where('name', 'create')->exists() || auth()->user()->role_id == '1')
                        <li><a class="{{ set_active(['role/create']) }}" href="{{ route('role.create') }}">Add Role</a></li>
                        @endif
                    </ul>
                </li>
                <li class="submenu">
                    <a class="btn  btn-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fas fa-lock"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
