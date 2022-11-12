<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bidding System <sup>bs</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
@if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
    <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Main
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#MyContributions"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-coins"></i>
                <span>Contributions</span>
            </a>
            <div id="MyContributions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Action</h6>
                    <a class="collapse-item" href="{{ route('admin.contributions') }}">View All</a>
                    <a class="collapse-item" href="{{ route('admin.contributions.pending') }}">Pending</a>
                    <a class="collapse-item" href="{{ route('admin.contributions.approved') }}">Approved</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Members"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>Members</span>
            </a>
            <div id="Members" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Action</h6>
                    <a class="collapse-item" href="{{ route('admin.members') }}">View All</a>
                    <a class="collapse-item" href="{{ route('admin.members.pending') }}">Pending</a>
                    <a class="collapse-item" href="{{ route('admin.members.approved') }}">Approved</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('notifications') }}" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2"
                 src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->profile_url }}"
                 alt="...">
            <p class="text-center mb-2"><strong>Stawika Investment</strong> is packed with premium features, components, and more!</p>
            <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">
                {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->username}}
            </a>
        </div>

@else

        <!-- Nav Item - Member Side Bar -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('buyer.portal') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-city"></i>
                    <span>Auction Center</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#MyContributions"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-coins"></i>
                    <span>My Bids</span>
                </a>
                <div id="MyContributions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Action</h6>
{{--                        <a class="collapse-item" href="{{ route('buyer.contribution.add') }}">Active</a>--}}
{{--                        <a class="collapse-item" href="{{ route('contributions.approved') }}">Approved</a>--}}
{{--                        <a class="collapse-item" href="{{ route('buyer.contribution.mine') }}">View All</a>--}}
                    </div>
                </div>
            </li>


{{--            <li class="nav-item">--}}
{{--                <a class="nav-link collapsed" href="{{ route('notifications') }}" aria-expanded="true" aria-controls="collapseUtilities">--}}
{{--                    <i class="fas fa-fw fa-bell"></i>--}}
{{--                    <span>Notifications</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2"
                     src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->profile_url }}"
                     alt="...">
                <p class="text-center mb-2"><strong>Bidding System</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">
                    {{\Illuminate\Support\Facades\Auth::user()->username}}
                </a>
            </div>
@endif

<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
