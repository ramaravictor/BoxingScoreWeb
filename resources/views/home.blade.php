<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen " style="opacity: 1;">
            <div class="relative w-full ">
                <img src="img/wallpaper3.jpg" class="object-cover w-full h-screen brightness-50">
                <!-- Adjust brightness-50 to your desired darkness level (0-100) -->
                <div
                    class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                    <div style="opacity: 1;">
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                            To Infinity and Beyond</p>
                    </div>
                    <div style="opacity: 1;">
                        <p
                            class="mt-4 text-xs font-normal leading-relaxed tracking-wider text-center text-white md:text-xl lg:max-w-lg">
                            Your Dreams Start Here.
                        </p>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 z-30">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-sm tracking-widest text-white font-lora">SCROLL TO DISCOVER</p>
                    <div class="w-0.5 h-16 lg:h-24 mt-4">
                        <div style="height: 100%;">
                            <div class="w-0.5 bg-white h-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>

    <main class="relative overflow-hidden">
        {{-- CARD ROOM --}}
        <section class="py-6 bg-white lg:px-32 lg:py-16">
            <div class="relative isolate">
                <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
                @can('dewanjuri')
                    <div class="flex justify-center mb-5 space-x-10">
                        <a href="{{ url('/admin/rooms/create') }}"
                            class="px-8 py-3 text-sm font-bold text-white uppercase transition duration-300 border bg-slate-950 border-slate-950 hover:bg-white hover:text-slate-950">
                            CREATE ROOMS
                        </a>

                        <a href="{{ route('history') }}"
                            class="px-8 py-3 text-sm font-bold text-white uppercase transition duration-300 border bg-slate-950 border-slate-950 hover:bg-white hover:text-slate-950">
                            VIEW HISTORYS
                        </a>
                    </div>
                @endcan
                <div class="flex flex-col p-5 main-container aos-init aos-animate lg:mb-12" data-aos="fade-up">
                    <text
                        class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-7xl">UPCOMING
                        MATCH</text>
                </div>

                <div class="container flex flex-col items-center gap-10 p-5 mx-auto font-bold uppercase lg:flex-row">
                    @foreach ($rooms as $room)
                        <div class="relative flex-1">
                            <div style="opacity: 1;">
                                <img src="{{ Storage::url($room->image) }}"
                                    class="w-full aspect-[3/4] md:aspect-[4/3] brightness-50 object-cover">
                                <div class="absolute bottom-0 left-0 right-0 p-4 md:p-8">
                                    <p class="text-2xl tracking-wider text-white md:text-3xl">{{ $room->name }}</p>
                                    <p class="text-2xl tracking-wider text-white md:text-xl">{{ $room->class }}</p>
                                    <p class="text-2xl tracking-wider text-white md:text-xl">
                                        {{ \Carbon\Carbon::parse($room->schedule)->timezone('Asia/Jakarta')->translatedFormat('D, M j / g:i A') }}
                                        WIB
                                    </p>

                                    <div class="flex pt-3">
                                        <a href="{{ route('rooms.show', $room->id) }}"
                                            class="px-4 py-2 transition duration-300 ease-in-out bg-white border border-white text-slate-950 hover:bg-slate-950 hover:text-white">
                                            GO TO EVENT
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
