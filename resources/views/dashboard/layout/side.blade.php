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
            --sidebar-bg: #ffffff; /* Dark Blue Background for the sidebar */
            --active-nav-link: #3583ff; /* Active nav link color */
            --nav-item-hover: rgba(75, 141, 248, 0.2); /* Light Blue Hover Effect */
            --text-sidebar: #000000; /* White text color for sidebar */
            --icon-bg: #2e2f31; /* Darker background for icons */
            --icon-color: #ffffff; /* Blue icon color */
            --main-bg: #F0F4F8; /* Light background color for the main content */
            --main-text: #000000; /* Dark text color for the main content */
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

    <!-- Sidebar -->
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-lg p-4">
        <div class="p-6">
            <a href="{{ route('dashboard.pharmacy.index') }}" class="text-gray-800 text-3xl font-semibold uppercase hover:text-gray-500">QID</a>
        </div>
        <nav class="text-sidebar text-base font-semibold pt-3">
            <!-- Users Link -->
            <a href="{{ route('dashboard.user.view') }}"
               class="flex items-center {{ request()->is('dashboard/user/users') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-users fa-sm"></i>
                </div>
                <span class="ml-1">Users</span>
            </a>

            <!-- Pharmacy Link -->
            <a href="{{ route('dashboard.pharmacy.index') }}"
               class="flex items-center {{ request()->is('dashboard/pharmacy') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-clinic-medical fa-sm"></i>
                </div>
                <span class="ml-1">Pharmacy</span>
            </a>

            <!-- Drug Categories Link -->
            <a href="{{ route('dashboard.drug_categories.index') }}"
               class="flex items-center {{ request()->is('dashboard/drug-categories') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-capsules fa-sm"></i>
                </div>
                <span class="ml-1">Drug Categories</span>
            </a>

            <!-- Warehouse Link -->
            <a href="{{ route('dashboard.drug_warehouses.index') }}"
               class="flex items-center {{ request()->is('dashboard/drug_warehouses') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-warehouse fa-sm"></i>
                </div>
                <span class="ml-1">Warehouse</span>
            </a>

            <!-- Drugs Link -->
            <a href="{{ route('dashboard.drug.index') }}"
               class="flex items-center {{ request()->is('dashboard/drug') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item transition-all duration-200 text-sm">
                <div class="icon-sidebar flex items-center justify-center mr-2">
                    <i class="fas fa-pills fa-sm"></i> <!-- Drug icon -->
                </div>
                <span class="ml-1">Drugs</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="w-full flex flex-col h-screen overflow-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none transition duration-200">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400" alt="User Image" class="w-full h-full object-cover">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full absolute right-0 z-0" style="display: none;">
                    <div class="absolute right-0 bg-white text-gray-800 py-2 rounded shadow profile-dropdown">
                        <a href="#" class="block px-4 py-2 account-link">Profile</a>
                        <a href="#" class="block px-4 py-2 account-link">Settings</a>
                        <a href="#" class="block px-4 py-2 account-link">Logout</a>
                    </div>
                </button>
            </div>
        </header>

        <!-- Mobile Header -->
        <div class="sm:hidden flex justify-between items-center bg-white p-4">
            <div class="text-gray-800 text-3xl font-semibold uppercase">QID</div>
            <button @click="isOpen = !isOpen" class="p-2 focus:outline-none">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>
        <div x-data="{ isOpen: false }">
            <div x-show="isOpen" class="absolute bg-white shadow-lg rounded-lg z-50 w-48 mt-2" style="display: none;">
                <nav class="flex flex-col">
                    <a href="{{ route('dashboard.user.view') }}" class="py-2 px-4 hover:bg-gray-200">Users</a>
                    <a href="{{ route('dashboard.pharmacy.index') }}" class="py-2 px-4 hover:bg-gray-200">Pharmacy</a>
                    <a href="{{ route('dashboard.drug_categories.index') }}" class="py-2 px-4 hover:bg-gray-200">Drug Categories</a>
                    <a href="{{ route('dashboard.drug_warehouses.index') }}" class="py-2 px-4 hover:bg-gray-200">Warehouse</a>
                    <a href="{{ route('dashboard.drug.index') }}" class="py-2 px-4 hover:bg-gray-200">Drugs</a> <!-- New Drugs Link -->
                </nav>
            </div>
        </div>

        <!-- Root Section -->
        <div class="root">
            <!-- Main Content Goes Here -->
            @yield('content') 
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.2.2/cdn.min.js" defer></script>
</body>

</html>
