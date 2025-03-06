@extends('layouts.admin')

@section('title', 'Ticket Configuration')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Ticket Configuration</title>
    
    <div class="max-w-lg mx-auto bg-pink-100 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Ticket Configuration</h2>

        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
        
        <form method="POST" action="{{ route('admin.update_settings') }}">
            @csrf
            <!-- Ticket Numbering Format -->
            <div class="mb-4">
            <label for="ticket-number-format" class="block text-sm font-medium text-gray-700">Ticket Numbering Format</label>
            <select id="ticket-number-format" name="ticket-number-format" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-normal p-3">
                <option value="sequential">Sequential</option>
                <option value="custom">Custom Format</option>
            </select>
            </div>

            <!-- Ticket Expiry Time -->
            <div class="mb-4">
                <label for="ticket-expiry-time" class="block text-sm font-medium text-gray-700">Ticket Expiry Time (in minutes)</label>
                <input type="number" id="ticket_expiration_minutes" name="ticket_expiration_minutes" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-normal p-3" 
                placeholder="Enter expiry time" value="{{ $settings->ticket_expiration_minutes ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-pink-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                    Save Settings
                </button>
            </div>
        </form>
        <!-- Image -->
        <img class="img-profile w-300 h-300"
    src="{{ asset('images/undraw_quiet-street.svg') }}"> 
    </div>
    
@endsection