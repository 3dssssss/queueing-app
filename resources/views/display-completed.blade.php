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

            <h1 class="text-3xl font-extrabold text-gray-800 mb-6">TRANSACTION COMPLETED</h1>
            
            <!-- Profile Image -->
            <img class="mx-auto mb-6 rounded-full w-32 h-32 object-cover" src="{{ asset('images/double-check.gif') }}" alt="completed">

            <!-- Button to Open Modal -->
            <div class="flex justify-center">
                <button id="openModal"
                    class="relative flex items-center justify-center text-white px-4 py-2 text-sm rounded-lg shadow bg-pink-500 hover:bg-pink-300 transition w-auto mx-auto">
                    PROCEED
                </button>
            </div>

            <!-- NOTE 1: I HAVE A VONAGE AND TWILIO FOR SMS IN CONFIG/SERVICES.PHP-->
            <!-- NOTE 2: I ALSO HAVE A VONAGE AND TWILIO FOR SMS IN THE .ENV -->
            <!-- NOTE 3: IF THERE SEEMS TO BE AN ISSUE THEN REMOVE THOSE TWO -->
             <!-- TBC...-->

            <!-- Modal (Initially Hidden) -->
            <div id="counterModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-pink-50 rounded-lg shadow-lg p-6 w-80 text-center">
                    
                    <!-- Counter Selection Section -->
                    <h2 class="text-lg font-semibold mb-4">Select Your Next Counter</h2>

                        <!-- Counter Button -->
                        <div id="counterOptions" class="space-y-2">
                        <button class="counterBtn w-full px-4 py-2 rounded border border-pink-300 bg-white hover:bg-pink-100"
                            data-queue="Assessment">
                            Counter #1 (Assessment)
                        </button>
                        <button class="counterBtn w-full px-4 py-2 rounded border border-pink-300 bg-white hover:bg-pink-100"
                            data-queue="Verification and Approval">
                            Counter #2 (Verification and Approval)
                        </button>
                        <button class="counterBtn w-full px-4 py-2 rounded border border-pink-300 bg-white hover:bg-pink-100"
                            data-queue="Payment Processing">
                            Counter #3 (Payment Processing)
                        </button>
                    </div>

                        <!-- Close & Cancel Buttons -->
                        <div class="mt-4 flex justify-center">
                        <button id="closeModal" class="px-2 py-1 bg-red-400 text-white rounded hover:bg-red-500">
                                Cancel
                            </button>
                        </div>

                    </div>
                </div>

    <script>
    // let completedServices = @json_encode($completedServices ?? []);

        document.addEventListener("DOMContentLoaded", function () {
            // console.log("Completed Services:", completedServices); // Debugging

            if (completedServices.includes("Payment Processing")) {
                console.log("Payment Processing completed. All options remain enabled.");
                return; 
            }

            completedServices.forEach(service => {
                let button = [...document.querySelectorAll(".counterBtn")].find(btn => btn.dataset.queue === service);
                if (button) {
                    button.disabled = true;
                    button.classList.add("opacity-50", "cursor-not-allowed");
                }
            });

            completedServices.forEach(service => {
                let option = document.querySelector(`#queue_id option[data-name='${service}']`);
                if (option) {
                    option.disabled = true;
                    option.style.color = "gray";
                }
            });

            document.querySelectorAll('.counterBtn').forEach(button => {
                button.addEventListener('click', function() {

                    document.querySelectorAll('.counterBtn').forEach(btn => {
                        btn.disabled = true;
                        btn.classList.add("opacity-50", "cursor-not-allowed");
                    }); 

                    setTimeout(() => {
                        window.location.href = "{{ route('dashboard') }}"; 
                    }, 500);
                });
            });
        });
    </script>

<script>
// Open modal when clicking "Proceed"
document.getElementById('openModal').addEventListener('click', function () {
    document.getElementById('counterModal').classList.remove('hidden');
});

// Close modal when clicking "Cancel" button
document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('counterModal').classList.add('hidden');
});

// Handle counter selection
document.querySelectorAll(".counterBtn").forEach(button => {
    button.addEventListener("click", function () {
        alert("Proceeding to " + this.dataset.queue);
        document.getElementById('counterModal').classList.add('hidden'); // Close modal after selection
    });
});
</script>

    </div>
</div> 

</body>

</html>
