{{-- @vite(['resources/css/sidebar.css']) --}}
<nav class="sidebar fixed h-screen top-0 left-0 z-40 w-10 sm:w-48 bg-gray-300 dark:bg-sky-950 overflow-y-auto" id="sidebar">
    {{ $header }}
    <ul class="font-sans dark:text-gray-300 my-5 hidden sm:block px-5">
        {{ $slot }}
    </ul>
</nav>