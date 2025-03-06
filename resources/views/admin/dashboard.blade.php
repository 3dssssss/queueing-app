@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-white-800">Dashboard</h1>
    <a href="#" id="queueToggleBtn" class="d-none d-sm-inline-block btn btn-sm shadow-sm" 
    style="background-color: #ff3385;" onclick="toggleAllQueues(event)">
    <span class="text-white" id="queueToggleText">Pause All Queues</span>
</a>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Total Active Tickets Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Active Tickets</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeTickets }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Completed Tickets Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Completed Tickets</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedTickets }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-check-circle fa-2x text-gray-300 ml-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expired Tickets Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Expired Tickets</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $expiredTickets }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-exclamation-circle fa-2x text-gray-300 ml-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Tickets Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pending Tickets</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTickets }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clock fa-2x text-gray-300 ml-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function toggleAllQueues(event) {
        event.preventDefault();

        let button = document.getElementById('queueToggleBtn');
        let text = document.getElementById('queueToggleText');

        fetch("{{ route('admin.queue.toggleAll') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "paused") {
                text.innerText = "Resume All Queues";
                button.style.backgroundColor = "#4CAF50";
            } else {
                text.innerText = "Pause All Queues";
                button.style.backgroundColor = "#ff3385";
            }
        })
        .catch(error => console.error("Error:", error));
    }
</script>
@endsection