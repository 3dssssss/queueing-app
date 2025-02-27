@extends('layouts.admin')

@section('title', 'Create New Queue')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--Title-->
<div class="flex items-center mt-12 lg:mt-0">
    <h1 class="flex items-center font-sans font-bold break-normal text-black px-2 text-xl md:text-3xl">
        Create New Queue
    </h1>
    
    <a href="{{ url('admin/queue/create/config') }}" style="text-decoration: none; background-color: #ff3385;" class="ml-4 text-white p-2 rounded hover:bg-pink-600 flex items-center transition duration-300 ease-in-out">
        <i class="fas fa-tools" style="color: #FFFFFF;"></i>
        <span class="hidden md:inline ml-2">Configure</span>
    </a> 
</div>

<!--divider-->
<hr class="bg-gray-300 my-12">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif

<!--Card-->
<div id='section2' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

    <form action="{{ route('admin.queue.store') }}" method="POST">
        @csrf

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_name">
                    Queue Name
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="form-input block w-full focus:bg-white" id="queue_name" name="queue_name" type="text" value="">
                <p class="py-2 text-sm text-gray-600">Enter a descriptive name for the queue</p>
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_type">
                    Queue Type
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="queue_type" class="form-select block w-full focus:bg-white" id="queue_type">
                    <option class="bg-gray-200 text-gray-500 cursor-not-allowed" value="" disabled selected>Select Queue Type</option>
                    <option value="General">General</option>
                    <option value="Priority">Priority</option>
                    <option value="Appointment-based">Appointment-based</option>
                </select>

                <p class="py-2 text-sm text-gray-600">Select the queue type</p>
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_code">
                    Queue Code
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="form-input block w-full focus:bg-white" id="queue_code" name="queue_code" type="text" value="">
                <p class="py-2 text-sm text-gray-600">Enter a unique code for the queue</p>
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="department">
                    Department
                </label>
            </div>
            <div class="md:w-2/3">
            <input class="form-input block w-full bg-gray-200 text-black-500 cursor-not-allowed" id="department" name="department" type="text" value="City Treasurer's Office">                
                <p class="py-2 text-sm text-gray-600">Specify the department associated with the queue</p>
            </div>
        </div>

        <div class="md:flex mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-900 font-bold md:text-left mb-3 md:mb-0 pr-4" for="ticket_counter">
                    Counter
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="form-input block w-full focus:bg-white" id="ticket_counter" name="ticket_counter" type="text" value="">
                <p class="py-2 text-sm text-gray-600">Enter the counter number corresponding to it</p>
            </div>
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button class="shadow bg-pink-600 hover:bg-pink-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>

</div>
<!--/Card-->


<!-- working BUT THE ERROR IS SO... >_< -->
<!-- <script>
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script> -->

@endsection