<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QID Dashboard</title>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    <!-- Your compiled JavaScript (includes Turbolinks) -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            background: #f3f4f6;
        }
        .bg-sidebar { background: #ffffff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #e0e7ff; color: #3d68ff; }
        .nav-item:hover { background: #e0e7ff; color: #3d68ff; }
        .account-link:hover { background: #3d68ff; color: #ffffff; }
    </style>
</head>
<body class="text-gray-800 flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('dashboard') }}" class="text-gray-800 text-3xl font-semibold uppercase hover:text-blue-500 transition-colors duration-300">QID</a>
        </div>
        <nav class="text-gray-600 text-base font-semibold pt-3">
            <!-- Search Bar -->
            <div class="px-4 mb-6">
                <div class="relative">
                    <input type="text" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition-colors duration-300" placeholder="Search...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                             </svg>
                    </div>
                </div>
            </div>

            <!-- Navigation Items -->
            @php
                $currentRoute = Route::currentRouteName();
            @endphp
            @if(auth()->user()->is_admin == 1)
                <a href="{{ route('dashboard.drug.index') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.drug.index' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-pills mr-3"></i>
                    Drugs
                </a>
            @elseif(auth()->user()->is_admin == 2)
                <a href="{{ route('dashboard.user.view') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.user.view' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
                <a href="{{ route('dashboard.pharmacy.index') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.pharmacy.index' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-clinic-medical mr-3"></i>
                    Pharmacy
                </a>
                <a href="{{ route('dashboard.drug_categories.index') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.drug_categories.index' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-capsules mr-3"></i>
                    Drug Categories
                </a>
                <a href="{{ route('dashboard.drug_warehouses.index') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.drug_warehouses.index' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-warehouse mr-3"></i>
                    Warehouse
                </a>
                <a href="{{ route('dashboard.drug.index') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.drug.index' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-pills mr-3"></i>
                    Drugs
                </a>
                <a href="{{ route('dashboard.orders.index') }}" class="flex items-center text-gray-600 py-4 pl-6 nav-item {{ $currentRoute == 'dashboard.orders.index' ? 'active-nav-link' : '' }} transition-all duration-300 ease-in-out">
                    <i class="fas fa-receipt mr-3"></i>
                    Orders
                </a>
            @endif
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex border-b border-gray-200">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-300 hover:border-gray-400 focus:border-gray-400 focus:outline-none transition-colors duration-300">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white transition-colors duration-300">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white transition-colors duration-300">Support</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 account-link hover:text-white transition-colors duration-300"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="text-gray-800 text-3xl font-semibold uppercase hover:text-blue-500 transition-colors duration-300">QID</a>
                <button @click="isOpen = !isOpen" class="text-gray-800 text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <nav class="flex flex-col pt-4" x-show="isOpen">
                <a href="{{ route('dashboard.user.view') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
                <a href="{{ route('dashboard.pharmacy.index') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300">
                    <i class="fas fa-clinic-medical mr-3"></i>
                    Pharmacy
                </a>
                <a href="{{ route('dashboard.drug_categories.index') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300">
                    <i class="fas fa-capsules mr-3"></i>
                    Drug Categories
                </a>
                <a href="{{ route('dashboard.drug_warehouses.index') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300">
                    <i class="fas fa-warehouse mr-3"></i>
                    Warehouse
                </a>
                <a href="{{ route('dashboard.drug.index') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300">
                    <i class="fas fa-pills mr-3"></i>
                    Drugs
                </a>
                <a href="{{ route('dashboard.orders.index') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300">
                    <i class="fas fa-receipt mr-3"></i>
                    Orders
                </a>
                <a href="{{ route('logout') }}" class="flex items-center text-gray-600 py-2 pl-4 nav-item transition-colors duration-300"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    {{ __('Logout') }}
                </a>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
        
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Turbolinks-specific script -->
    <script>
        document.addEventListener("turbolinks:load", function() {
            // This function will run on the initial page load
            // and after every Turbolinks navigation
            console.log("Page loaded with Turbolinks!");

            // Re-initialize Alpine.js components if needed
            if (window.Alpine) {
                window.Alpine.start();
            }

            // Add any other initialization code here
        });
    </script>
</body>
</html>
