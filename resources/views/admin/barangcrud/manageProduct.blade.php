@vite(['resources/js/manageProduct.js'])

<x-app-layout :sidebar=true>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen produk') }}
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
        <li><a href="dashboard">Dashboard</a></li>
        <li class="mt-3"><a href="manageuser">Manage Users</a></li>
        <li class="mt-3"><a href="#">Products</a></li>
    </x-sidebar>

    <div class="py-12 ml-10 sm:ml-48">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-center font-bold dark:text-gray-300">
                        Manajemen produk
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
                <div class=" p-5">
                    <table id="productTable" class="table-auto rounded w-[100%] z-0">
                        <thead>
                            <tr class="bg-slate-950">
                                <th class="text-center font-semibold text-gray-300">No.</th>
                                <th class="font-semibold text-left text-gray-300">Gambar barang</th>
                                <th class="font-semibold text-left text-gray-300">Nama barang</th>
                                <th class="font-semibold text-left text-gray-300">Harga</th>
                                <th class="font-semibold text-left text-gray-300">Stok</th>
                                <th class="font-semibold text-left text-gray-300">Status</th>
                                <th class="text-center font-semibold text-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($Barang as $val)
                                <tr class="odd:bg-gray-100 even:bg-gray-300 odd:dark:bg-slate-700 even:dark:bg-slate-800 hover:bg-slate-400 dark:hover:bg-indigo-600">
                                    <td class="dark:text-gray-300 text-center">{{ $no++ }}</td>
                                    <td class="dark:text-gray-300">
                                        @if($val->image_path)
                                        <img src="{{ Storage::url('public/images/'.$val->id.'/'.$val->image_path) }}" style="height: 50px;width:100px;">
                                        @else 
                                        <span>No image found!</span>
                                        @endif

                                    </td>
                                    <td class="dark:text-gray-300">{{ $val->namaBarang }}</td>
                                    <td class="dark:text-gray-300">{{ $val->hargaBarang }}</td>
                                    <td class="dark:text-gray-300">{{ $val->stokBarang }}</td>

                                    @if ($val->status === 1)
                                        <td class="dark:text-gray-300">aktif</td>
                                    @else
                                        <td class="dark:text-gray-300">Tidak aktif</td>
                                    @endif
                                    <td>
                                        <div class="flex justify-center">
                                            <div>
                                                {{-- <a href="{{__('/DeleteUser/'.$val->idUser)}}" class="fa-solid fa-trash-can text-red-600" style="font-size: 24px;"></a> --}}
                                                <form action="{{ route('admin.manageProduct.delete', $val->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{__('manageproduct/'.$val->id)}}" class="fa-solid fa-pen-to-square pe-2 text-sky-500" style="font-size: 24px;"></a>
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
                        <a href="{{ route('admin.manageProduct.add') }}" class="rounded bg-gray-800 p-2">
                            <p class="text-white font-bold">
                                Tambah produk
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
