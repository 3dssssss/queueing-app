@extends('layouts.admin')

@section('title', 'Staff')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container mx-auto p-6">

    @if(session('success'))
        <div id="toast" class="fixed top-24 right-5 bg-pink-500 text-white p-4 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => document.getElementById('toast').remove(), 3000);
        </script>
    @endif

    <div x-data="{ openModal: false, search: '', activeCounter: null }">
        <!-- Search Bar -->
        <!-- <input type="text" x-model="search" placeholder="Search counter..."
            class="border border-pink-400 p-2 rounded w-full focus:ring-2 focus:ring-pink-400 mb-4"> -->

        <!-- Add Staff Button -->
        <button @click="openModal = true" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 mb-6">
            + Add Staff
        </button>

        <!-- Add Staff Modal -->
        <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
                <h3 class="text-2xl font-semibold text-pink-700 mb-3">Add New Staff</h3>

                <!-- Close Button -->
                <button @click="openModal = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">✖</button>

                <form action="{{ route('admin.staff.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-700 font-medium">Name:</label>
                        <input type="text" id="name" name="name" required autocomplete="name"
                            class="border border-pink-400 p-2 rounded w-full focus:ring-2 focus:ring-pink-400">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email:</label>
                        <input type="email" id="email" name="email" required autocomplete="email"
                            class="border border-pink-400 p-2 rounded w-full focus:ring-2 focus:ring-pink-400">
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 font-medium">Password:</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                            class="border border-pink-400 p-2 rounded w-full focus:ring-2 focus:ring-pink-400">
                    </div>
                    <div class="flex justify-between">
                        <button type="button" @click="openModal = false" 
                            class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-lg">
                            Add Staff
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Counter List (Accordion + Search + Scrollable Grid) -->
        <div x-data="{ showModal: false, selectedCounter: null, selectedStaffId: '', selectedQueueName: '' }" class="container mx-auto p-6">
            <h2 class="text-3xl font-bold text-pink-700 mb-6">Counter Management</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($counters as $counter)
                <div class="bg-pink-50 rounded-xl p-5 border border-pink-300 transition hover:shadow-2xl">
                    <!-- Counter Name & Ticket Count -->
                    <h3 class="text-2xl font-bold text-pink-800 mb-2">{{ $counter->ticket_counter }}</h3>
                    <h2 class="text-xl font-bold text-pink-800 mb-4">{{ $counter->queue_name }}</h3>
                    <p class="text-pink-700 mt-1">🎟 Tickets: 
                        <span class="font-bold">{{ $counter->ticket_count }}</span>
                    </p>

                    <!-- Staff Assigned -->
                    <p class="text-pink-700 mt-1">👨‍💼 Staff: 
                        <span class="font-medium text-pink-900">
                            {{ $counter->staff->name ?? 'Not Assigned' }}
                        </span>
                    </p>

                    <!-- Action Buttons -->
                    <div class="mt-5 flex space-x-3">
                        <!-- Edit Button -->
                        <button @click="
                            showModal = true;
                            selectedCounter = {{ $counter->id }};
                            selectedStaffId = '{{ $counter->staff_id ?? '' }}';
                            selectedQueueName = '{{ $counter->queue_name }}';
                        "
                        class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-2 rounded-lg shadow-md transition flex items-center justify-center">                    
                            <img src="{{ asset('images/edityt.png') }}" alt="Edit" class="w-5 h-5 mr-2">
                        </button>

                        <!-- Delete Button -->
                        <form method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this counter?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-2 rounded-lg shadow-md transition">
                                <img src="{{ asset('images/delyt.png') }}" alt="Delete" class="w-5 h-5 mr-2">
                            </button>
                        </form>

                        <!-- Edit Button -->
                        <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-lg shadow-md transition flex items-center justify-center">                    
                            <img src="{{ asset('images/moreyt.png') }}" alt="More" class="w-5 h-5 mr-2">
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Edit Modal -->
            <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-2xl shadow-2xl w-96 border-4 border-pink-300">
                    <h2 class="text-2xl font-semibold text-pink-700 mb-4">Edit Counter</h2>

                    <form x-show="selectedCounter" :action="'/admin/staff/counter-management/' + selectedCounter" method="POST">
                        @csrf
                            @method('PUT')

                        <!-- Counter Name (Read-Only) -->
                        <label class="block text-pink-700 font-medium">Counter Name:</label>
                        <input type="text" x-model="selectedQueueName" readonly
                            class="border border-pink-400 p-2 rounded-lg w-full bg-gray-100 mt-1">

                        <!-- Staff Dropdown -->
                        <label class="block text-pink-700 font-medium mt-3">Assign Staff:</label>
                        <select name="staff_id" x-model="selectedStaffId"
                            class="border border-pink-400 p-2 rounded-lg w-full focus:ring-2 focus:ring-pink-400 mt-1">
                            <option value="">-- Select Staff --</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}">
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Save & Cancel Buttons -->
                        <div class="mt-6 flex justify-between">
                            <button type="button" @click="showModal = false"
                                class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded-lg">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-pink-500 hover:bg-pink-600 text-white py-2 px-4 rounded-lg">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
