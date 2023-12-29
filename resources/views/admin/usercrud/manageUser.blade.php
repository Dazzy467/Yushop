@vite(['resources/js/manageUser.js'])

<x-app-layout :sidebar=true>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen user') }}
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
                <div>
                    <h3 class="text-center font-bold dark:text-gray-300">
                        Manajemen user
                    </h3>
                    <div class="px-10">
                        @if (session('status'))
                        <div 
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="w-[100%] h-auto bg-green-300 justify-center">
                            <p
                                class="text-center text-lg text-white font-bold "
                            >{{ session('status') }}</p>
                        </div>
                        @endif
                    </div>


                </div>
                <div class="justify-center p-5">
                    <table id="userTable" class="table-auto rounded w-[100%] z-0">
                        <thead>
                            <tr class="bg-slate-950">
                                <th class="text-center font-semibold text-gray-300">No.</th>
                                <th class="font-semibold text-left text-gray-300">Nama</th>
                                <th class="font-semibold text-left text-gray-300">Email</th>
                                <th class="font-semibold text-left text-gray-300">No. Telp</th>
                                <th class="text-center font-semibold text-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($User as $val)
                                <tr class="odd:bg-gray-100 even:bg-gray-300 odd:dark:bg-slate-700 even:dark:bg-slate-800 hover:bg-slate-400 dark:hover:bg-indigo-600">
                                    <td class="dark:text-gray-300 text-center">{{ $no++ }}</td>
                                    <td class="dark:text-gray-300">{{ $val->name }}</td>
                                    <td class="dark:text-gray-300">{{ $val->email }}</td>
                                    <td class="dark:text-gray-300">{{ $val->noTelp }}</td>
                                    <td>
                                        <div class="flex justify-center">
                                            <div>
                                                {{-- <a href="{{__('/DeleteUser/'.$val->idUser)}}" class="fa-solid fa-trash-can text-red-600" style="font-size: 24px;"></a> --}}
                                                <form action="{{ route('admin.manageUser.delete', $val->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{__('manageuser/'.$val->id)}}" class="fa-solid fa-pen-to-square pe-2 text-sky-500" style="font-size: 24px;"></a>
                                                    <button class="fa-solid fa-trash-can text-red-600" style="font-size: 24px;" type="submit"></button>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-between">
                        <a href="{{ route('admin.manageuser.add') }}" class="rounded bg-gray-800 p-2">
                            <p class="text-white font-bold">
                                Tambah user
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
