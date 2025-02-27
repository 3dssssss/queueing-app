<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Queueing - City Treasurer's Office</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">

    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between my-4">
            <div class="pl-4 md:pl-0">
                <a class="flex items-center text-pink-500 text-base xl:text-xl no-underline hover:no-underline font-extrabold font-sans" href="#">
                    <img class="w-8 h-8 rounded-half object-cover mr-2" src="{{ asset('images/linefour.png') }}" alt="Profile Icon">
                    Queueing - City Treasurer's Office
                </a>
            </div>

            <div class="pr-0 flex justify-end">
                <div class="flex relative inline-block float-right">
                    <div class="relative text-sm">
                        <button id="userButton" class="flex items-center mr-3 shadow bg-pink-700 hover:bg-pink-500 focus:shadow-outline focus:outline-none text-white text-sm md:text-base font-bold py-2 px-4 rounded">
                            Menu
                            <svg class="pl-2 h-2 fill-current text-white" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                </g>
                            </svg>
                        </button>

                        <div id="userMenu" class="bg-white rounded shadow-md mt-2 mr-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                            <ul class="list-reset">
                                <li><a href="{{ ('profile') }}" class="px-4 py-2 block hover:bg-gray-400 no-underline hover:no-underline">My account</a></li>
                                <li><hr class="border-t mx-2 border-gray-400"></li>
                                <li><a href="#" class="px-4 py-2 block text-blue-600 font-bold hover:bg-blue-600 hover:text-white no-underline hover:no-underline">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="min-h-screen flex items-center justify-center bg-gray-50 mt-20">

        <div class="bg-pink-100 shadow-lg rounded-lg p-8 w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 text-center">

            <h1 class="text-3xl font-extrabold text-gray-800 mb-6">IT'S YOUR TURN</h1>
            
            <!-- Profile Image -->
            <img class="mx-auto mb-6 rounded-full w-32 h-32 object-cover" src="{{ asset('images/undraw_starry-window.svg') }}" alt="Wait in line">
            
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6">PLEASE GO TO</h1>

            <div class="flex justify-center items-center">
            @if(isset($ticket_counter))
                <p class="text-4xl font-extrabold text-pink-600 bg-pink-300 py-1 rounded-md shadow-lg">
                    {{ $ticket_counter->ticket_counter }}
                </p>
            @else
                <p class="text-red-600">No counter found.</p>
            @endif
            </div>

           

        </div>

    </div>

    <script>
setInterval(function() {
    window.location.href = "{{ route('checkUserStatus') }}";
}, 10000); // Check status every 10 seconds
</script>

</body>

</html>
