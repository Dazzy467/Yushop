<x-app-layout :sidebar=true>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>        
    </x-slot>

    <!-- For admin dashboard -->
    <x-sidebar>
        <x-slot name="header">
            <div class="bg-gray-900 text-center py-5 hidden sm:block">
                <h1 class="text-gray-300 font-extrabold">
                    Admin dashboard
                </h1>
            </div>
        </x-slot>
        <li><a href="{{ route('Admindashboard') }}">Dashboard</a></li>
        <li class="mt-3"><a href="{{route('admin.manageUser')}}">Manage Users</a></li>
        <li class="mt-3"><a href="{{ route('admin.manageProduct') }}">Products</a></li>
    </x-sidebar>

    <div class="py-12 ml-10 sm:ml-48">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    {{ Auth::user()->name }}
                </div>
                <div class="flex justify-start p-5">
                    <div id="userCard" class="rounded px-2 bg-gray-200 dark:bg-gray-950 dark:text-gray-300">
                        <h3 class="font-extrabold">Jumlah User</h3>
                        <div class="flex items-center justify-evenly py-2">
                            <i class="fa-solid fa-user" style="font-size: 2rem"></i>
                            <span class="font-extrabold" style="font-size: 2rem">{{ $User->count() }}</span>
                        </div>
                    </div>

                    <div id="barangCard" class="rounded px-2 mx-2 bg-gray-200 dark:bg-gray-950 dark:text-gray-300">
                        <h3 class="font-extrabold">Jumlah Barang</h3>
                        <div class="flex items-center justify-evenly py-2">
                            <i class="fa-solid fa-box" style="font-size: 2rem"></i>
                            <span class="font-extrabold" style="font-size: 2rem">{{ $Barang->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
