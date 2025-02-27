@extends('layouts.admin')

@section('title', 'Counters')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<!-- Title -->
<div class="flex items-center mt-12 lg:mt-0">
    <h1 class="flex items-center font-sans font-bold break-normal text-black px-2 text-xl md:text-4xl">
        Counters
    </h1>
</div>

<!-- Counters Button -->
<div class="flex justify-end relative">
    <form method="GET" action="{{ route('admin.user.counter') }}">
        <input type="hidden" name="counter" value="Assessment">
        <button type="submit" class="flex items-center justify-center bg-pink-300 text-black text-l rounded focus:outline-none focus:ring-2 focus:ring-pink-400 px-2 py-3 ml-2">
            <img class="w-5 h-5 mr-2" src="{{ asset('images/assessment.png') }}" alt="Assessment Icon">
            Assessment
        </button>
    </form>
    <form method="GET" action="{{ route('admin.user.counter') }}">
        <input type="hidden" name="counter" value="Verification and Approval">
        <button type="submit" class="flex items-center justify-center bg-pink-300 text-black text-l rounded focus:outline-none focus:ring-2 focus:ring-pink-400 px-2 py-3 ml-2">
            <img class="w-5 h-5 mr-2" src="{{ asset('images/verify.png') }}" alt="Verification Icon">
            Verification
        </button>
    </form>
    <form method="GET" action="{{ route('admin.user.counter') }}">
        <input type="hidden" name="counter" value="Payment Processing">
        <button type="submit" class="flex items-center justify-center bg-pink-300 text-black text-l rounded focus:outline-none focus:ring-2 focus:ring-pink-400 px-2 py-3 ml-2">
            <img class="w-5 h-5 mr-2" src="{{ asset('images/payment.png') }}" alt="Payment Icon">
            Payment
        </button>
    </form>
    <!-- <form method="GET" action="{{ route('admin.user.counter') }}">
        <input type="hidden" name="counter" value="Disbursement">
        <button type="submit" class="flex items-center justify-center bg-pink-300 text-black text-l rounded focus:outline-none focus:ring-2 focus:ring-pink-400 px-2 py-3 ml-2">
            <img class="w-5 h-5 mr-2" src="{{ asset('images/disbursement.png') }}" alt="Disbursement Icon">
            Disbursement
        </button>
    </form> -->
</div>


<!-- Display Selected Counter -->
@if($counterName)
    <div class="mt-6 px-3 py-3 bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-300 border-l-4 border-pink-500 shadow-md rounded-lg">
        <h3 class="text-xl font-bold">
            Showing Tickets for: <span class="text-pink-600 dark:text-pink-400">{{ $counterName }}</span>
        </h3>
    </div>
@endif


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
                    Age
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
            </tr>
        </thead>
        <tbody>
        @forelse ($tickets as $ticket)
        <tr class="odd:bg-blue-100 odd:dark:bg-blue-900 even:bg-green-100 even:dark:bg-green-800 border-b dark:border-gray-700 border-gray-200" 
            data-status="{{ $ticket->status }}" data-expires-at="{{ $ticket->expires_at }}">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$ticket->name}}
            </th>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$ticket->email}}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$ticket->phone}}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$ticket->age}}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$ticket->gender}}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{$ticket->ticket_number}}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" data-user-status="{{ $ticket->status }}" data-user-id="{{ $ticket->id }}">
                @if($ticket->status == 'waiting')
                    <span class="badge bg-warning">Waiting</span>
                @elseif($ticket->status == 'active')
                    <span class="badge bg-primary">In Progress</span>
                @elseif($ticket->status == 'completed')
                    <span class="badge bg-success">Completed</span>
                @elseif($ticket->status == 'expired')
                    <span class="badge bg-danger">Expired</span>
                @else
                    <span class="badge bg-secondary">Unknown</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center py-4 text-black dark:text-gray-300">No available tickets</td>
        </tr>
@endforelse


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
        </tbody>
    </table>
</div> 

@endsection