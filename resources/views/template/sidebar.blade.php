<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
    {{-- <ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar"> --}}

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fire"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard-active')">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if (Auth()->user()->role->access_transaction)
        <li class="nav-item @yield('transaction-active')">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTransaction" aria-expanded="true" aria-controls="collapseTransaction">
                <i class="fas fa-fw fa-database"></i>
                <span>Transaction</span>
            </a>
            <div id="collapseTransaction" class="collapse @yield('transaction-show')" aria-labelledby="headingTransaction" data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">

                    @if (Auth()->user()->role->access_project)
                        <a class="collapse-item @yield('projects-active')" href="{{ route('projects.index') }}">
                            {{ ucwords(str_replace('_', ' ', 'project')) }}
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif

    @if (Auth()->user()->role->access_master)
        <li class="nav-item @yield('master-active')">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
                <i class="fas fa-fw fa-database"></i>
                <span>Master</span>
            </a>
            <div id="collapseMaster" class="collapse @yield('master-show')" aria-labelledby="headingMaster" data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">

                    @if (Auth()->user()->role->access_user)
                        <a class="collapse-item @yield('users-active')" href="{{ route('users.index') }}">
                            {{ ucwords(str_replace('_', ' ', 'user')) }}
                        </a>
                    @endif

                    @if (Auth()->user()->role->access_client)
                        <a class="collapse-item @yield('clients-active')" href="{{ route('clients.index') }}">
                            {{ ucwords(str_replace('_', ' ', 'client')) }}
                        </a>
                    @endif

                    @if (Auth()->user()->role->access_complexity)
                        <a class="collapse-item @yield('complexities-active')" href="{{ route('complexities.index') }}">
                            {{ ucwords(str_replace('_', ' ', 'complexity')) }}
                        </a>
                    @endif

                    @if (Auth()->user()->role->access_gateway)
                        <a class="collapse-item @yield('gateways-active')" href="{{ route('gateways.index') }}">
                            {{ ucwords(str_replace('_', ' ', 'gateway')) }}
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
