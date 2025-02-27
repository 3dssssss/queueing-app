<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Queueing - City Treasurer's Office</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <style>
        .max-h-64 {
            max-height: 16rem;
        }
        /*Quick overrides of the form input as using the CDN version*/
        .form-input,
        .form-textarea,
        .form-select,
        .form-multiselect {
            background-color: #edf2f7;
        }
    </style>

</head>

<body class="bg-red-100 text-black tracking-wider leading-normal">

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

                    <div class="flex relative inline-block space-x-4">
                    
                    <!-- Notification Button with Badge -->
                    <button id="dropdownButton" type="button"
                        class="relative flex items-center text-white px-4 py-2 rounded-lg shadow hover:bg-pink-300 transition">
                        <img class="w-5 h-5 mr-2" src="{{ asset('images/notification.png') }}" alt="Notification Icon">
                        <!-- Notification Badge (Initially Hidden) -->
                        <span id="notifBadge"
                            class="absolute top-0 right-0 transform translate-x-2 -translate-y-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full hidden">
                            !
                        </span>
                    </button>

                    <!-- Dropdown Menu with Scroll -->
                    <div id="dropdownMenu"
                        class="absolute right-0 mt-12 w-64 bg-white border border-gray-300 rounded-lg shadow-lg hidden z-50 max-h-64 overflow-y-auto">
                        <div id="ticketAlertContainer" class="p-2 space-y-2"></div>
                    </div>

                        <button id="userButton" class="flex items-center mr-3 shadow bg-pink-700 hover:bg-pink-500 focus:shadow-outline focus:outline-none text-white text-sm md:text-base font-bold py-2 px-4 rounded">
                            Menu
                            <svg class="pl-2 h-2 fill-current text-white" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                </g>
                            </svg>
                        </button>

                        </div>

                        <div id="userMenu" class="bg-white rounded shadow-md mt-2 mr-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                            <ul class="list-reset">
                                <li><a href="{{ ('profile') }}" class="px-4 py-2 block hover:bg-gray-400 no-underline hover:no-underline">My account</a></li>
                                <li>
                                    <hr class="border-t mx-2 border-gray-400">
                                </li>
                                <li><a href="#" class="px-4 py-2 block text-pink-600 font-bold hover:bg-pink-600 hover:text-white no-underline hover:no-underline">Logout</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </nav>
    <!--Container-->
    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-16">
        <div class="w-full lg:w-1/5 px-6 text-xl text-gray-800 leading-normal">
            <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Menu</p>
            <div class="block lg:hidden sticky inset-0">
                <button id="menu-toggle" class="flex w-full justify-end px-3 py-3 bg-white lg:bg-transparent border rounded border-gray-600 hover:border-pink-600 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 float-right" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </button>
            </div>
            <div class="w-full sticky inset-0 hidden max-h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" style="top:6em;" id="menu-content">
                <ul class="list-reset py-2 md:py-0">
                    <li class="py-1 md:my-2 hover:bg-pink-100 lg:hover:bg-transparent border-l-4 border-transparent font-bold border-pink-600">
                        <a href='#section1' class="block pl-4 align-middle text-gray-700 no-underline hover:text-pink-600">
                            <span class="pb-1 md:pb-0 text-sm">Contact</span>
                        </a>
                    </li>
                    <li class="py-1 md:my-2 hover:bg-pink-100 lg:hover:bg-transparent border-l-4 border-transparent">
                        <a href='#section2' class="block pl-4 align-middle text-gray-700 no-underline hover:text-pink-600">
                            <span class="pb-1 md:pb-0 text-sm">Service</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!--Section container-->
        <section class="w-full lg:w-4/5">

            <!--Title-->
            <h1 class="flex items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl mt-12 lg:mt-0 md:text-2xl">
				Queueing - City Treasurer's Office
			</h1>

            <!--divider-->
            <hr class="bg-gray-300 my-12">

            <!--Title-->
            <h2 id='section1' class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Contact</h2>

            <!--Card-->
            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white"> 
            <div class="flex">
            <img src="{{ asset('images/phone.svg') }}" alt="Edit" class="w-5 h-5 mr-2">    
            044-9197370 to 89 Local 1116 to 17
            </div>
            <div class="flex">
            <img src="{{ asset('images/envelope.svg') }}" alt="Edit" class="w-5 h-5 mr-2">    
            cto_sjdm@yahoo.com.ph
            </div>
            </div>
            <!--/Card-->

            <!--divider-->
            <hr class="bg-gray-300 my-12">

            <!--Title-->
            <h2 class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Service</h2>

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

            <!--Card-->
            <div id='section2' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

            <form method="POST" action="{{ route('user_tickets.store') }}"> 
            @csrf

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="ticket_number">
                                Ticket Number
                            </label>
                        </div>
                        <div class="md:w-2/3">
                        <input class="form-input block w-full border border-gray-400 focus:border-pink-500 focus:ring-2 focus:ring-pink-300 rounded-md transition-all duration-200"
                        id="ticket_number" name="ticket_number" type="text" value="{{ $ticketNumber ?? '' }}">
                            <p class="py-2 text-sm text-gray-600">Enter your ticket number</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="queue_id">
                                Service
                            </label>
                        </div>
                        <div class="md:w-2/3">
                        <select name="queue_id" class="form-select block w-full focus:bg-white" id="queue_id" required>
                        <option value="" disabled selected>Select a service</option>
                        @foreach($queue as $queue)
                        <option value="{{ $queue->id }}" data-code="{{ $queue->queue_code }}" data-name="{{ $queue->queue_name }}">
                            {{ $queue->queue_name }}
                        </option>
                        @endforeach
                        </select>

                            <p class="py-2 text-sm text-gray-600">Select the purpose of the transaction</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="notes">
                                Notes
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea class="form-textarea block w-full focus:bg-white" id="notes" name="notes" value="" rows="8"></textarea>
                            <p class="py-2 text-sm text-gray-600">Optional: Additional notes</p>
                        </div>
                    </div>

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-40">
                            <button class="shadow bg-pink-700 hover:bg-pink-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Save
                            </button>
                        </div>
                        <div class="md:w-0">
                            <a href="{{ url('display')}}"class="shadow bg-pink-700 hover:bg-pink-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Next
                            </a>
                        </div>
                    </div>
                </form>

            </div>
            <!--/Card-->


        </section>
        <!--/Section container-->

        <!--Back link -->
        <div class="w-full lg:w-4/5 lg:ml-auto text-base md:text-sm text-gray-600 px-4 py-24 mb-12">
          <span class="text-base text-pink-600 font-bold">&lt;</span> <a href="#" class="text-base md:text-sm text-pink-600 font-bold no-underline hover:underline">Back link</a>
         </div>

      </div>
      <!--/container-->

      <script>  
    document.getElementById('dropdownButton').addEventListener('click', function (event) {
    let dropdown = document.getElementById('dropdownMenu');
    let notifBadge = document.getElementById('notifBadge');

    dropdown.classList.toggle('hidden'); // Toggle dropdown visibility
    notifBadge.classList.add('hidden'); // Hide badge when dropdown opens

    // Fetch expired tickets
    fetch('{{ route("check.expired.tickets") }}')
        .then(response => response.json())
        .then(data => {
            let alertContainer = document.getElementById('ticketAlertContainer');
            alertContainer.innerHTML = ''; // Clear previous notifications

            if (data.expired_tickets.length > 0) {
                data.expired_tickets.forEach(ticket => {
                    let alertDiv = document.createElement('div');
                    alertDiv.className = "flex items-center p-2 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm";
                    alertDiv.innerHTML = `
                        <svg class="w-5 h-5 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10A8 8 0 112 10a8 8 0 0116 0zM9 6a1 1 0 012 0v4a1 1 0 01-2 0V6zm1 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <span><strong>${ticket.ticket_number}</strong> (Expired on ${ticket.expires_at})</span>
                    `;
                    alertContainer.appendChild(alertDiv);
                });

                // Show badge if there are new expired tickets
                notifBadge.classList.remove('hidden');
            }
        });

    // Prevent dropdown from closing when clicking inside it
    event.stopPropagation();
});

// Check for new notifications every 30 seconds
setInterval(() => {
    fetch('{{ route("check.expired.tickets") }}')
        .then(response => response.json())
        .then(data => {
            let notifBadge = document.getElementById('notifBadge');

            if (data.expired_tickets.length > 0) {
                notifBadge.classList.remove('hidden'); // Show badge
            } else {
                notifBadge.classList.add('hidden'); // Hide badge if no expired tickets
            }
        });
}, 30000); // Check every 30 seconds

// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
    let dropdown = document.getElementById('dropdownMenu');
    let dropdownButton = document.getElementById('dropdownButton');

    if (!dropdown.contains(event.target) && !dropdownButton.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("queue_id").addEventListener("change", function() {
        let selectedOption = this.options[this.selectedIndex];
        let queueName = selectedOption.getAttribute("data-name"); // Get queue_name
        let queueCode = selectedOption.getAttribute("data-code"); // Get queue_code

        if (queueCode) {
            fetch(`/generate-ticket?queue_code=${queueCode}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("ticket_number").value = data.ticket_number;
                })
                .catch(error => console.error('Error fetching ticket number:', error));
        }
    });
});
</script>



</script>

<!-- Toggle dropdown list -->
<script>
/*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

var userMenuDiv = document.getElementById("userMenu");
var userMenu = document.getElementById("userButton");

 var helpMenuDiv = document.getElementById("menu-content");
 var helpMenu = document.getElementById("menu-toggle");

document.onclick = check;

function check(e){
  var target = (e && e.target) || (event && event.srcElement);

  //User Menu
  if (!checkParent(target, userMenuDiv)) {
	// click NOT on the menu
	if (checkParent(target, userMenu)) {
	  // click on the link
	  if (userMenuDiv.classList.contains("invisible")) {
		userMenuDiv.classList.remove("invisible");
	  } else {userMenuDiv.classList.add("invisible");}
	} else {
	  // click both outside link and outside menu, hide menu
	  userMenuDiv.classList.add("invisible");
	}
  }

   //Help Menu
   if (!checkParent(target, helpMenuDiv)) {
	// click NOT on the menu
	if (checkParent(target, helpMenu)) {
	  // click on the link
	  if (helpMenuDiv.classList.contains("hidden")) {
		helpMenuDiv.classList.remove("hidden");
	  } else {helpMenuDiv.classList.add("hidden");}
	} else {
	  // click both outside link and outside menu, hide menu
	  helpMenuDiv.classList.add("hidden");
	}
   }

}

function checkParent(t, elm) {
  while(t.parentNode) {
	if( t == elm ) {return true;}
	t = t.parentNode;
  }
  return false;
}

</script>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- Scroll Spy -->
<script>
/* http://jsfiddle.net/LwLBx/ */

// Cache selectors
var lastId,
    topMenu = $("#menu-content"),
    topMenuHeight = topMenu.outerHeight()+175,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
  $('html, body').stop().animate({ 
      scrollTop: offsetTop
  }, 300);
  if (!helpMenuDiv.classList.contains("hidden")) {
		helpMenuDiv.classList.add("hidden");
	  }
  e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;

   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";

   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("font-bold border-pink-600")
         .end().filter("[href='#"+id+"']").parent().addClass("font-bold border-pink-600");
   }                   
});

</script>
</body>
</html>

