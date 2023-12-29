<x-app-layout :sidebar=true>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit produk') }}
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
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('admin.manageProduct.update',$barang->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
            
                    <div>
                        <x-input-label for="namaBarang" :value="__('Nama barang')" />
                        <x-text-input id="namaBarang" name="namaBarang" type="text" class="mt-1 block w-full" :value="old('namaBarang', $barang->namaBarang)" required autofocus autocomplete="namaBarang" />
                        <x-input-error class="mt-2" :messages="$errors->get('namaBarang')" />
                    </div>
            
                    <div>
                        <x-input-label for="stokBarang" :value="__('Stok')" />
                        <x-text-input id="stokBarang" name="stokBarang" type="number" class="mt-1 block w-full" :value="old('stokBarang', $barang->stokBarang)" required autocomplete="stokBarang" />
                        <x-input-error class="mt-2" :messages="$errors->get('stokBarang')" />
                    </div>
            
                    <div>
                        <x-input-label for="hargaBarang" :value="__('Harga')" />
                        <x-text-input id="hargaBarang" name="hargaBarang" type="number" class="mt-1 block w-full" :value="old('hargaBarang', $barang->hargaBarang)" required autofocus autocomplete="hargaBarang" />
                        <x-input-error class="mt-2" :messages="$errors->get('hargaBarang')" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select class="rounded" name="status" id="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak aktif</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>
            
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="my-2 p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('admin.manageProduct.img.update',$barang->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('post')
            
                    <div>
                        <x-input-label for="image_path" :value="__('Gambar barang')" />
                        {{-- <x-text-input id="image_path" name="image_path" type="text" class="mt-1 block w-full"/> --}}
                        <input class="w-[50%] border-[5px] rounded" type="file" name="image_path"/>
                        <x-input-error class="mt-2" :messages="$errors->get('image_path')" />
                    </div>
            
                    
            
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
