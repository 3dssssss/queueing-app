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
    <a class="nav-link d-flex align-items-center hover-indicator" href="{{ url('admin/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
        <span class="flex-grow-1">Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Queue Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed d-flex align-items-center hover-indicator" href="#" data-toggle="collapse" data-target="#collapseQueue"
        aria-expanded="true" aria-controls="collapseQueue">
        <i class="fas fa-walking mr-2"></i>
        <span class="flex-grow-1">Manage Queues</span>
    </a>
    <div id="collapseQueue" class="collapse" aria-labelledby="headingQueue" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Queue Management:</h6>
            <a class="collapse-item" href="{{ url('admin/queue/create') }}">Create New Queue</a>
            <a class="collapse-item" href="{{ url('admin/queue/view') }}">View Existing Queues</a>
        </div>
    </div>
</li>

<!-- Nav Item - Counter Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed d-flex align-items-center hover-indicator" href="#" data-toggle="collapse" data-target="#collapseUser"
        aria-expanded="true" aria-controls="collapseUser">
        <img class="w-5 h-5 mr-2" src="{{ asset('images/counter.png') }}" alt="Counter Icon">
        <span class="flex-grow-1">Manage Counter</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingUser"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Counter Management:</h6>
            <a class="collapse-item" href="{{ url('admin/user/counter') }}">View Counters</a>
            <a class="collapse-item" href="{{ url('admin/staff/counter-management') }}">Staff</a>
        </div>
    </div>
</li>

<!-- Nav Item - User -->
<li class="nav-item">
    <a class="nav-link d-flex align-items-center hover-indicator" href="{{ url('admin/user/view-user') }}">
        <i class="fas fa-users mr-2"></i>
        <span class="flex-grow-1">Users</span>
    </a>
</li>

<!-- Styles for hover effects -->
<style>
    /* Hover effect: Pink highlight and left border */
    .hover-indicator:hover {
        background-color: rgba(255, 20, 147, 0.2); /* Light pink */
        border-left: 4px solid white; /* White left border as an indicator */
        transition: background-color 0.2s ease-in-out, border-left 0.2s ease-in-out;
    }

    /* Make the image light (faded) by default */
    .nav-item img {
        opacity: 0.5; /* 50% transparency */
        transition: opacity 0.2s ease-in-out;
    }

    /* When hovered, make the image fully visible */
    .hover-indicator:hover img {
        opacity: 1; /* Fully visible */
    }
</style>



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

    