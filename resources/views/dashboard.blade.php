<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Home
        </h2>
    </x-slot> --}}

    <div class="container flex flex-col sm:flex-row justify-center my-32 gap-32">
        <div class="welcome flex items-center text-white max-w-full">
            <h1 class="text-4xl font-bold">Selamat Datang di Mambalabu Gunshop, 
                <span class="w-full block">{{ Auth::user()->name }}</span>
            </h1>
        </div>
    
        <div class="mambalabu w-64 h-64">
            <img src="{{ asset('images/mambalabu.jpeg') }}" alt="">
        </div>
    </div>

    {{-- Media Video Lokal --}}
    <div class="container flex justify-center mt-32">
        <video width="720" height="480" controls>
            <source src="{{ asset('videos/gunshop.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung video tag.
        </video>
    </div>
    

    
</x-app-layout>
