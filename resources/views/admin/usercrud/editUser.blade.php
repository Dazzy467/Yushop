<x-app-layout :sidebar=true>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit user') }}
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
                <form method="post" action="{{ route('admin.manageUser.update',$user->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
            
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
            
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
            
                    <div>
                        <x-input-label for="telp" :value="__('No telp')" />
                        <x-text-input id="telp" name="noTelp" type="text" class="mt-1 block w-full" :value="old('telp', $user->noTelp)" required autofocus autocomplete="telp" />
                        <x-input-error class="mt-2" :messages="$errors->get('telp')" />
                    </div>
            
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
            
                        {{-- @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif --}}
                    </div>
                </form>
            </div>

            <div class="my-2 p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('admin.manageUser.password.update',$user->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')
            
                    <div>
                        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                        <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
            
                    <div>
                        <x-input-label for="update_password_password" :value="__('New Password')" />
                        <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
            
                    <div>
                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
            
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
            
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
