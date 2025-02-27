@extends('layouts.admin')

@section('title', 'View All Users')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<!-- Title -->
<div class="flex items-center mt-12 lg:mt-0">
    <h1 class="flex items-center font-sans font-bold break-normal text-black px-2 text-xl md:text-4xl">
        Users
    </h1>
    <a href="{{ url('admin/user/counter')}}" style="text-decoration: none; background-color: #ff3385;" class="ml-4 text-white p-2 rounded hover:bg-pink-600 flex items-center transition duration-300 ease-in-out">
    <img class="w-5 h-5 mr-2" src="{{ asset('images/counter.png') }}" alt="Assessment Icon">
    <span class="hidden md:inline ml-2">Counters</span>
    </a> 
</div>

    <!-- Filter Button -->
<div class="flex justify-end relative">
    <button onclick="toggleFilter()" class="flex items-center justify-center w-10 h-8 bg-pink-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400">
        <img class="w-5 h-5" src="{{ asset('images/filter1.png') }}">
    </button>

<!-- Filter Dropdown -->
<div id="filterDropdown" class="hidden absolute top-14 right-0 bg-white shadow-md p-2 rounded w-36 z-10">
    <select id="statusFilter" class="border p-2 w-full rounded">
        <option value="">All</option>
        <option value="waiting">Waiting</option>
        <option value="active">In Progress</option>
        <option value="completed">Completed</option>
        <option value="expired">Expired</option>
    </select>
    <button onclick="filterTickets()" style="background-color: #ff3385;" class="mt-2 bg-blue-500 text-white px-4 py-1 rounded w-full">Apply</button>
</div>
</div>


<!-- Divider -->
<hr class="bg-gray-300 my-8">

<!-- Table -->
<div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-black uppercase bg-pink-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Full Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Ticket Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user as $user)
<tr class="odd:bg-blue-100 odd:dark:bg-blue-900 even:bg-green-100 even:dark:bg-green-800 border-b dark:border-gray-700 border-gray-200" 
                data-status="{{ $user->status }}" data-expires-at="{{ $user->expires_at }}">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->name}}
                </th>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->phone}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->gender}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->ticket_number}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" data-user-status="{{ $user->status }}" data-user-id="{{ $user->id }}">
                    @if($user->status == 'waiting')
                        <span class="badge bg-warning">Waiting</span>
                    @elseif($user->status == 'active')
                        <span class="badge bg-primary">In Progress</span>
                    @elseif($user->status == 'completed')
                        <span class="badge bg-success">Completed</span>
                    @elseif($user->status == 'expired')
                        <span class="badge bg-danger">Expired</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif
                </td>
                <!-- Modal for Updating the Status -->
                <div class="modal fade" id="statusModal-{{ $user->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statusModalLabel">Select Queue Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="statusForm" method="POST" action="{{ route('admin.user.updateStatus') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}" id="userId">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="waiting" @if($user->status == 'waiting') selected @endif>Waiting</option>
                                            <option value="active" @if($user->status == 'active') selected @endif>In Progress</option>
                                            <option value="completed" @if($user->status == 'completed') selected @endif>Completed</option>
                                            <option value="expired" @if($user->status == 'expired') selected @endif>Expired</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn" style="background-color: #ff3385; color: #ffffff;">Save Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <td class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <div>
                    <a href="javascript:void(0);" style="text-decoration: none;" class="flex items-center text-white font-semibold py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-pink-400" 
                    data-bs-toggle="modal" data-bs-target="#statusModal-{{ $user->id }}" data-user-id="{{ $user->id }}" data-current-status="{{ $user->status }}">
                        <img src="{{ asset('images/dots.png') }}" alt="Status" class="w-5 h-5 mr-2">
                    </a>
                </div>

                <div>
                <!-- Trigger modal -->
                <button onclick="openModal('deleteModal-{{ $user->id }}')" class="flex items-center text-white font-semibold py-1 px-2 rounded hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                <img src="{{ asset('images/bin.png') }}" alt="Delete" class="w-5 h-5 mr-2">
                Delete
                </button>
            </div>
            </td>
            </tr>

        <!-- Modal -->
        <div id="deleteModal-{{ $user->id }}" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 backdrop-blur-lg flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-semibold text-gray-800">Are you sure?</h2>
                <p class="text-gray-600 mt-2">Do you really want to delete this user? This action cannot be undone.</p>

                <!-- Delete confirmation form -->
                <div class="mt-4 flex justify-end space-x-4">
                    <button onclick="closeModal('deleteModal-{{ $user->id }}')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 focus:outline-none">Cancel</button>
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">Delete</button>
                    </form>
                </div>
            </div>
        </div>


    <script>
    function toggleFilter() {
        document.getElementById("filterDropdown").classList.toggle("hidden");
    }

    function filterTickets() {
        const statusFilter = document.getElementById("statusFilter").value;
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            const statusCell = row.querySelector("td[data-user-status]");
            const expiresAt = row.getAttribute('data-expires-at');
            const badge = statusCell ? statusCell.querySelector(".badge") : null;

            if (statusCell && badge) {
                // Convert expiresAt to Date object
                const expiresDate = new Date(expiresAt);

                // Show or hide rows based on selected filter
                if (statusFilter === "" || statusFilter === "all") {
                    row.style.display = "";
                    updateBadge(statusCell, badge, row.getAttribute('data-status'), expiresDate);
                } else if (statusFilter === "expired" && expiresDate < new Date()) {
                    row.style.display = "";
                    updateBadge(statusCell, badge, "expired", expiresDate);
                } else if (statusFilter === "waiting" && row.getAttribute('data-status') === "waiting" && expiresDate > new Date()) {
                    row.style.display = "";
                    updateBadge(statusCell, badge, "waiting", expiresDate);
                } else if (statusFilter === "active" && row.getAttribute('data-status') === "active" && expiresDate > new Date()) {
                    row.style.display = "";
                    updateBadge(statusCell, badge, "active", expiresDate);
                } else if (statusFilter === "completed" && row.getAttribute('data-status') === "completed") {
                    row.style.display = "";
                    updateBadge(statusCell, badge, "completed", expiresDate);
                } else {
                    row.style.display = "none";
                }
            }
        });
    }

    function updateBadge(statusCell, badge, status, expiresDate) {
        if (status === 'expired') {
            badge.classList.remove('bg-warning', 'bg-primary', 'bg-success', 'bg-secondary');
            badge.classList.add('bg-red-500');
            badge.textContent = "Expired";
        } else if (status === 'waiting') {
            badge.classList.remove('bg-warning', 'bg-primary', 'bg-success', 'bg-red-500');
            badge.classList.add('bg-yellow-400');
            badge.textContent = "Waiting";
        } else if (status === 'active') {
            badge.classList.remove('bg-warning', 'bg-primary', 'bg-success', 'bg-red-500');
            badge.classList.add('bg-blue-500');
            badge.textContent = "In Progress";
        } else if (status === 'completed') {
            badge.classList.remove('bg-warning', 'bg-primary', 'bg-success', 'bg-red-500');
            badge.classList.add('bg-green-500');
            badge.textContent = "Completed";
        }
    }
</script>




    <script>
    $('#statusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);  
        var userId = button.data('user-id'); 
        var currentStatus = button.data('current-status'); 
        
        var modal = $(this);
        modal.find('#userId').val(userId);  
        modal.find('#status').val(currentStatus); 
    });
</script>



<script>
    // Open the modal
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    // Close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>


            
        @endforeach
        </tbody>
    </table>
</div> 

@endsection