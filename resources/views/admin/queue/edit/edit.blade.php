@extends('layouts.admin')

@section('title', 'Edit Queue')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">

    <!--Title-->
<div class="flex items-center mt-12 lg:mt-0">
    <h1 class="flex items-center font-sans font-bold break-normal text-black px-2 text-xl md:text-3xl">
        Edit Queue
    </h1>
</div>
    <!-- Divider -->
    <hr class="bg-gray-300 my-12">

<!-- Card -->
<div id='section2' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

    <form action="{{ route('admin.queue.update', $queue->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_name">
                    Queue Name
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="form-input block w-full focus:bg-white" id="queue_name" name="queue_name" type="text" value="{{ old('queue_name', $queue->queue_name) }}" required>
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_type">
                    Queue Type
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="queue_type" class="form-select block w-full focus:bg-white" id="queue_type" required>
                    <option class="bg-gray-200 text-gray-500 cursor-not-allowed" value="" disabled selected>Select Queue Type</option>
                    <option value="General" {{ $queue->queue_type == 'General' ? 'selected' : '' }}>General</option>
                    <option value="Priority" {{ $queue->queue_type == 'Priority' ? 'selected' : '' }}>Priority</option>
                    <option value="Appointment-based" {{ $queue->queue_type == 'Appointment-based' ? 'selected' : '' }}>Appointment-based</option>
                    </select>

            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_code">
                    Queue Code
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="form-input block w-full focus:bg-white" id="queue_code" name="queue_code" type="text" value="{{ old('queue_code', $queue->queue_code) }}" required>
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="department">
                    Department
                </label>
            </div>
            <div class="md:w-2/3">
            <input class="form-input block w-full bg-gray-200 text-black-500 cursor-not-allowed" id="department" name="department" type="text" value="{{ old('department', $queue->department) }}">                
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="ticket_counter">
                    Counter
                </label>
            </div>
            <div class="md:w-2/3">
            <input class="form-input block w-full focus:bg-white" id="ticket_counter" name="ticket_counter" type="text" value="{{ old('ticket_counter', $queue->ticket_counter) }}" required>
            </div>
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button class="shadow bg-pink-500 hover:bg-pink-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>

</div>

@endsection