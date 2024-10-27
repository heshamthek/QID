<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Admin Dashboard</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="Admin Dashboard Template">

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        :root {
            --sidebar-bg: #ffffff;
            --active-nav-link: #51eaea;
            --nav-item-hover: #51eaea77; 
            --text-sidebar: #000000;
            --icon-bg: #2e2f31; 
            --icon-color: #ffffff;
            --main-bg: #e2e2e2;; 
            --main-text: #000000; 
        }

        .font-family-karla {
            font-family: 'Karla', sans-serif;
        }

        .bg-sidebar {
            background: var(--sidebar-bg);
        }

        .active-nav-link {
            background: var(--active-nav-link);
            border-radius: 12px;
        }

        .nav-item:hover {
            background: var(--nav-item-hover);
            border-radius: 12px;
        }

        .text-sidebar {
            color: var(--text-sidebar);
            font-weight: 600;
        }

        .icon-sidebar {
            background: var(--icon-bg);
            color: var(--icon-color);
            padding: 10px;
            border-radius: 50%;
        }

        .root {
            padding: 20px;
            background: var(--main-bg);
            color: var(--main-text);
            flex: 1;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-gray-50 font-family-karla flex">


<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-lg p-4">
    <div class="p-6">
        <a href="{{ route('dashboard') }}" class="text-gray-800 text-3xl font-semibold uppercase hover:text-gray-500">QID</a>
    </div>
    <nav class="text-sidebar text-base font-semibold pt-3">

        @if(auth()->user()->is_admin == 1) 
           <a href="{{ route('dashboard.drug.index') }}"
               class="flex items-center {{ request()->is('dashboard/drug') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-pills fa-sm"></i> 
                </div>
                <span class="ml-1">Drugs</span>
            </a>

        @elseif(auth()->user()->is_admin  == 2)
            <a href="{{ route('dashboard.user.view') }}"
               class="flex items-center {{ request()->is('dashboard/user') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-users fa-sm"></i>
                </div>
                <span class="ml-1">Users</span>
            </a>

            <a href="{{ route('dashboard.pharmacy.index') }}"
               class="flex items-center {{ request()->is('dashboard/pharmacy') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-clinic-medical fa-sm"></i>
                </div>
                <span class="ml-1">Pharmacy</span>
            </a>

            <a href="{{ route('dashboard.drug_categories.index') }}"
               class="flex items-center {{ request()->is('dashboard/categories') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-capsules fa-sm"></i>
                </div>
                <span class="ml-1">Drug Categories</span>
            </a>


            <a href="{{ route('dashboard.drug_warehouses.index') }}"
               class="flex items-center {{ request()->is('dashboard/warehouses') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-warehouse fa-sm"></i>
                </div>
                <span class="ml-1">Warehouse</span>
            </a>


            <a href="{{ route('dashboard.drug.index') }}"
               class="flex items-center {{ request()->is('dashboard/drug') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-pills fa-sm"></i> <!-- Drug icon -->
                </div>
                <span class="ml-1">Drugs</span>
            </a>

            <a href="{{ route('dashboard.orders.index') }}"class="flex items-center {{ request()->is('dashboard/orders') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm"><div class="icon-sidebar flex items-center justify-center mr-2"><i class="fas fa-receipt fa-sm"></i> <!-- Order icon --></div><span class="ml-1">Orders</span></a>
        @elseif(auth()->user()->is_admin  == 0)
        @endif

    </nav>
</aside>



    <!-- Main Content -->
    <div class="w-full flex flex-col h-screen overflow-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class=" overflow-hidden focus:border-gray-300 focus:outline-none transition duration-200">
                    <h1>Q</h1>
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full absolute right-0 z-0" style="display: none;">
                    <div class="absolute right-0 bg-white text-gray-800 py-2 rounded shadow profile-dropdown">
                        <a href="#" class="block px-4 py-2 account-link">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="block px-4 py-2 account-link">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                              </div>
                </button>
            </div>
        </header>

        <div x-data="{ isOpen: false }" class="sm:hidden flex justify-between items-center bg-white p-4">
            <div class="text-gray-800 text-3xl font-semibold uppercase">QID</div>
            <button @click="isOpen = !isOpen" class="p-2 focus:outline-none">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        
            <!-- Mobile Navigation -->
            <div x-show="isOpen"
                 class="absolute top-16 left-0 bg-white shadow-lg rounded-lg z-50 w-full"
                 @click.away="isOpen = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                <nav class="flex flex-col">
                    <a href="{{ route('dashboard.user.view') }}" class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200">
                        <i class="fas fa-user"></i> Users
                    </a>
                    <a href="{{ route('dashboard.pharmacy.index') }}" class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200">
                        <i class="fas fa-clinic-medical"></i> Pharmacy
                    </a>
                    <a href="{{ route('dashboard.drug_categories.index') }}" class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200">
                        <i class="fas fa-pills"></i> Drug Categories
                    </a>
                    <a href="{{ route('dashboard.drug_warehouses.index') }}" class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200">
                        <i class="fas fa-warehouse"></i> Warehouse
                    </a>
                    <a href="{{ route('dashboard.orders.index') }}" class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200">
                        <i class="fas fa-capsules"></i> Drugs
                    </a>
                    <a href="{{ route('dashboard.drug.index') }}" class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200">
                        <i class="fas fa-receipt"></i> Drugs
                    </a>
                    <a href="{{ route('logout') }}" 
                       class="py-2 px-4 flex items-center gap-2 hover:bg-gray-200"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                </nav>
            </div>
        </div>
        
        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>


        <!-- Root Section -->
        <div class="root">
            <!-- Main Content Goes Here -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.2.2/cdn.min.js" defer></script>
</body>

</html>



