<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen font-bold">
            <div class="relative flex w-full h-screen" style="opacity: 1;">
                <div class="relative w-full">
                    <img src="{{ Storage::url($room->image) }}" class="object-cover w-full h-screen brightness-50">
                    <!-- Adjust brightness-50 to your desired darkness level (0-100) -->
                    <div
                        class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                        <div style="opacity: 1;">
                            <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                                {{ $room->name }}</p>
                        </div>

                    </div>

                </div>

                <div class="absolute bottom-0 left-0 right-0 z-30 mb-12">
                    <div class="flex flex-col items-center justify-center">

                        <div class="flex justify-center mb-20 space-x-7">
                            <a href="#"
                                class="px-8 py-3 text-sm font-bold uppercase transition duration-300 bg-white border text-slate-950 border-slate-950 hover:bg-slate-950 hover:text-white">
                                JUDGE
                            </a>

                            <a href="/"
                                class="px-8 py-3 text-sm font-bold uppercase transition duration-300 bg-white border border-slate-950 text-slate-950 hover:bg-slate-950 hover:text-white">
                                RESULT
                            </a>
                        </div>
                        <text class="mb-3 text-2xl tracking-wider text-white md:text-xl">{{ $room->class }}</text>
                        <p class="text-2xl tracking-wider text-white md:text-xl">
                            {{ $room->formatted_schedule }}
                        </p>

                    </div>
                </div>



            </div>
        </section>
    </x-slot>
</x-app-layout>
