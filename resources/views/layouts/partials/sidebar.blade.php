<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion sticky top-0 h-screen" id="accordionSidebar" style="background: linear-gradient(to bottom, #ff63a0, #ff3385);">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
    <div class="flex flex-col">
    <div class="sidebar-brand-text mx-3 text-lg font-bold">Queueing</div>
    <div class="sidebar-brand-text mx-3 text-xs font-normal mt-1">CITY TREASURER'S OFFICE</div>
</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ url('admin/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Queue Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQueue"
        aria-expanded="true" aria-controls="collapseQueue">
        <i class="fas fa-walking"></i>
        <span>Manage Queues</span>
    </a>
    <div id="collapseQueue" class="collapse" aria-labelledby="headingQueue" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Queue Management:</h6>
            <a class="collapse-item" href="{{ url('admin/queue/create') }}">Create New Queue</a>
            <a class="collapse-item" href="{{ url('admin/queue/view') }}">View Existing Queues</a>
        </div>
    </div>
</li>

<!-- Nav Item - User Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
        aria-expanded="true" aria-controls="collapseUser">
        <i class="fas fa-users"></i>
        <span>Manage Users</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingUser"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User Management:</h6>
            <a class="collapse-item" href="{{ url('admin/user/view-user') }}">Users</a>
            <a class="collapse-item" href="{{ url('admin/user/counter') }}">Counters</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>
<!-- End of Sidebar -->

    