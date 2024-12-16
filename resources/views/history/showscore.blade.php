<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen " style="opacity: 1;">
            <div class="relative w-full ">
                @if (isset($room))
                    <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('default-image.jpg') }}"
                        class="object-cover w-full h-screen brightness-50">
                    <div
                        class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                            {{ $room->name }}
                        </p>
                        <p class="mt-4 text-xl text-white">
                            {{ $room->class }}
                        </p>
                        <p class="mt-4 text-xl text-white">
                            {{ $room->schedule }}
                        </p>
                    </div>
                @else
                    <p class="mt-5 font-bold text-center text-red-500">Room data not found.</p>
                @endif
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
        {{-- final score --}}
        <section id="final-score" class="py-6 bg-white lg:px-32 lg:py-16">
            <div class="relative mb-12 isolate">
                <!-- Gradient Background -->
                <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg]
                        bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%,
                        60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%,
                        27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>

                <!-- Section Title -->
                <div class="flex flex-col p-5 main-container aos-init aos-animate lg:mb-12" data-aos="fade-up">
                    <text class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-7xl">
                        FINAL RESULT
                    </text>
                </div>

                <!-- Score Card -->
                <div class="mx-auto overflow-hidden bg-white border border-gray-200 shadow-lg max-w-7xl">
                    <!-- Header WIN -->

                    <div class="flex items-center justify-between px-8 py-4 bg-slate-950">
                        @if ($finalScore->winner == 'red')
                            <!-- Winner RED: Label di kiri -->
                            <div class="flex items-center">
                                <span
                                    class="px-2 py-1 text-xs font-bold text-white uppercase bg-red-500 rounded">WIN</span>
                            </div>
                            <div class="flex-1 text-center">
                                <h3 class="text-lg font-bold text-white uppercase">{{ $room->class }}</h3>
                            </div>
                        @else
                            <!-- Winner BLUE: Label di kanan -->
                            <div class="flex-1 px-8 text-center">
                                <h3 class="text-lg font-bold text-white uppercase">{{ $room->class }}</h3>
                            </div>
                            <div class="items-center flex-2">
                                <span
                                    class="px-2 py-1 text-xs font-bold text-white uppercase bg-blue-500 rounded">WIN</span>
                            </div>
                        @endif
                    </div>

                    <!-- Main Content -->
                    <div class="grid items-center grid-cols-3 gap-4 px-8 py-6 text-center">
                        <!-- Red Fighter -->
                        <div class="flex flex-col items-center space-y-4">
                            <img src="{{ $room->redCorner->image ? asset('storage/' . $room->redCorner->image) : asset('default-image.jpg') }}"
                                alt="Blue Fighter" class="object-cover w-40 h-40 rounded-full">
                            <p class="text-4xl font-bold text-red-500 uppercase">
                                {{ $room->redCorner->name ?? 'BLUE FIGHTER' }}
                            </p>
                            {{-- <p class="mt-2 text-sm font-semibold text-gray-600 uppercase">
                                    <span class="inline-block w-2 h-2 mr-1 bg-blue-500 rounded-full"></span>Country
                                </p> --}}
                        </div>

                        <!-- Match Info -->
                        <div class="flex flex-col justify-center">
                            <p class="text-4xl font-bold text-gray-800">VS</p>
                            <div class="grid grid-cols-3 gap-4 mt-4 text-center text-gray-600">
                                <!-- Round -->
                                <div>
                                    <p class="text-sm font-semibold uppercase">ROUND</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $finalScore->round }}</p>
                                </div>
                                <!-- Winner -->
                                <div>
                                    <p class="text-sm font-semibold uppercase">WINNER</p>
                                    <p class="text-2xl font-bold text-gray-800">
                                        {{ strtoupper($finalScore->winner) }}
                                    </p>
                                </div>
                                <!-- Method -->
                                <div>
                                    <p class="text-sm font-semibold uppercase">METHOD</p>
                                    <p class="text-2xl font-bold text-gray-800 uppercase">
                                        {{ ucfirst(str_replace('_', ' ', $finalScore->method)) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Blue Fighter -->
                        <div class="flex flex-col items-center space-y-4">
                            <img src="{{ $room->blueCorner->image ? asset('storage/' . $room->blueCorner->image) : asset('default-image.jpg') }}"
                                alt="Blue Fighter" class="object-cover w-40 h-40 rounded-full">
                            <p class="text-4xl font-bold text-blue-500 uppercase">
                                {{ $room->blueCorner->name ?? 'BLUE FIGHTER' }}
                            </p>
                            {{-- <p class="mt-2 text-sm font-semibold text-gray-600 uppercase">
                                    <span class="inline-block w-2 h-2 mr-1 bg-blue-500 rounded-full"></span>Country
                                </p> --}}
                        </div>
                    </div>
                </div>

                <!-- Gradient Footer Background -->
                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr
                        from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%,
                        60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%,
                        27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
            </div>
        </section>

    </main>


</x-app-layout>
