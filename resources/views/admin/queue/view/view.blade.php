@extends('layouts.admin')

@section('title', 'View Existing Queue')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">

<!-- Title -->
<div class="flex items-center mt-12 lg:mt-0">
    <h1 class="flex items-center font-sans font-bold break-normal text-black px-2 text-xl md:text-3xl">
        Queue List
    </h1>
    <a href="{{ route('admin.queue.create') }}" style="text-decoration: none; background-color: #ff3385;" class="ml-4 btn-primary text-white p-2 rounded hover:bg-blue-600 flex items-center transition duration-300 ease-in-out">
        <i class="fas fa-plus" style="color: #FFFFFF;"></i>
        <span class="hidden md:inline ml-2">Create Queue</span>
    </a>
</div>

<!-- Divider -->
<hr class="bg-gray-300 my-12">

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
                    Queue Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Queue Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Queue Code
                </th>
                <th scope="col" class="px-6 py-3">
                    Department
                </th>
                <th scope="col" class="px-6 py-3">
                    Counter
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($queues as $queue)
<tr class="odd:bg-blue-100 odd:dark:bg-blue-900 even:bg-green-100 even:dark:bg-green-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$queue->queue_name}}
                </th>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$queue->queue_type}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$queue->queue_code}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$queue->department}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$queue->ticket_counter}}
                </td>
                <td class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <div>
                <a href="{{ route('admin.queue.edit.edit', $queue->id) }}" style="text-decoration: none;" class="flex items-center text-white font-semibold py-1 px-3 rounded hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                <img src="{{ asset('images/edit.png') }}" alt="Edit" class="w-5 h-5 mr-2">
                Edit
                </a>
                </div>
                <div>
                <!-- Trigger modal -->
                <button onclick="openModal('deleteModal-{{ $queue->id }}')" class="flex items-center text-white font-semibold py-1 px-2 rounded hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                <img src="{{ asset('images/bin.png') }}" alt="Delete" class="w-5 h-5 mr-2">
                Delete
                </button>
            </div>
            </td>
            </tr>

            <!-- Modal -->
            <div id="deleteModal-{{ $queue->id }}" class="fixed inset-0 z-50 hidden bg-opacity-30 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-semibold text-gray-800">Are you sure?</h2>
                <p class="text-gray-600 mt-2">Do you really want to delete this queue? This action cannot be undone.</p>
        
            <!-- Delete confirmation form -->
            <div class="mt-4 flex justify-end space-x-4">
                <button onclick="closeModal('deleteModal-{{ $queue->id }}')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 focus:outline-none">Cancel</button>
                <form action="{{ route('admin.queue.destroy', $queue->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">Delete</button>
                </form>
            </div>
        </div>
    </div>

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

    <!-- <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Queue Name</th>
                <th class="border px-4 py-2">Queue Type</th>
                <th class="border px-4 py-2">Queue Code</th>
                <th class="border px-4 py-2">Department</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($queues as $queue)
                <tr>
                    <td class="border px-4 py-2">{{ $queue->queue_name }}</td>
                    <td class="border px-4 py-2">{{ $queue->queue_type }}</td>
                    <td class="border px-4 py-2">{{ $queue->queue_code }}</td>
                    <td class="border px-4 py-2">{{ $queue->department }}</td>
                    <td class="border px-4 py-2">
                    
                        <a href="" class="text-blue-500">Edit</a> |
                        <a href="" class="text-red-500">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> -->

@endsection