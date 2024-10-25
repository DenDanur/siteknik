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
    

    {{-- <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div x-data="{ currentImage: 0 }" class="relative w-full max-w-4xl mx-auto">
            <!-- Carousel Images -->
            <div class="overflow-hidden rounded-lg shadow-lg">
                <template x-for="(image, index) in [
                    '/images/home1.jpeg', 
                    '/images/home2.jpeg', 
                    '/images/home3.jpeg', 
                    '/images/home4.jpeg', 
                    '/images/home5.jpeg'
                ]" :key="index">
                    <div 
                        x-show="currentImage === index" 
                        class="w-full transition-transform duration-500 ease-in-out"
                    >
                        <img :src="image" alt="Image" class="w-full h-96 object-cover">
                    </div>
                </template>
            </div>

            <!-- Carousel Controls -->
            <div class="absolute inset-0 flex items-center justify-between px-4">
                <button 
                    @click="currentImage = currentImage > 0 ? currentImage - 1 : 4" 
                    class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700"
                >
                    &#8592;
                </button>
                <button 
                    @click="currentImage = currentImage < 4 ? currentImage + 1 : 0" 
                    class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700"
                >
                    &#8594;
                </button>
            </div>

            <!-- Image Indicators -->
            <div class="flex justify-center mt-4">
                <template x-for="(image, index) in [0, 1, 2, 3, 4]" :key="index">
                    <button 
                        @click="currentImage = index" 
                        :class="currentImage === index ? 'bg-blue-500' : 'bg-gray-300'"
                        class="w-3 h-3 mx-1 rounded-full"
                    ></button>
                </template>
            </div>
        </div>
    </div> --}}
</x-app-layout>
