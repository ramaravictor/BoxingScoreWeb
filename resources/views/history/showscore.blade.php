<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen " style="opacity: 1;">
            <div class="relative w-full ">
                @if (isset($room))
                    <img src="{{ $room->redCorner->image ? asset('storage/' . $room->redCorner->image) : asset('default-red.jpg') }}"
                        class="absolute inset-y-0 left-0 object-cover w-1/2 h-full brightness-50">
                    <img src="{{ $room->blueCorner->image ? asset('storage/' . $room->blueCorner->image) : asset('default-blue.jpg') }}"
                        class="absolute inset-y-0 right-0 object-cover w-1/2 h-full brightness-50">

                    <div
                        class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                            {{ $room->name }}
                        </p>
                        <p class="mt-12 text-xl text-white uppercase">
                            {{ $room->weight_class }}
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
                                    class="px-2 py-1 text-sm font-bold text-white uppercase bg-red-500 rounded lg:text-xl">WIN</span>
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
                                    class="px-2 py-1 text-sm font-bold text-white uppercase bg-blue-500 rounded lg:text-xl">WIN</span>
                            </div>
                        @endif
                    </div>

                    <!-- Main Content -->
                    <div class="grid items-center grid-cols-3 gap-4 px-8 py-6 text-center">
                        <!-- Red Fighter -->
                        <div class="flex flex-col items-center space-y-4">
                            <div class="relative">
                                <img src="{{ $room->redCorner->image ? asset('storage/' . $room->redCorner->image) : asset('default-red.jpg') }}"
                                    alt="{{ $room->redCorner->name ?? 'Unknown Fighter' }}"
                                    class="object-cover w-full h-full">
                                <div
                                    class="absolute bottom-0 left-0 right-0 hidden p-2 text-center sm:block bg-red-900/70">
                                    <p class="text-xs font-semibold text-white uppercase">Red Corner</p>
                                    <p class="text-xs font-bold text-white uppercase lg:text-4xl">
                                        {{ $room->redCorner->name ?? 'Unknown Fighter' }}
                                    </p>
                                </div>
                                <p class="text-sm font-bold text-red-500 uppercase lg:hidden">
                                    {{ $room->redCorner->name ?? 'RED FIGHTER' }}
                                </p>
                            </div>
                        </div>

                        <!-- Match Info Desktop View-->
                        <div class="flex flex-col justify-center">
                            <p class="font-bold text-slate-950 text-7xl">VS</p>
                            <div class="hidden grid-cols-3 gap-4 mt-4 text-center text-gray-600 sm:grid">
                                <!-- Round -->
                                <div>
                                    <p class="text-sm font-semibold uppercase">ROUND</p>
                                    <p class="text-2xl font-bold text-slate-950">{{ $finalScore->round }}</p>
                                </div>
                                <!-- Winner -->
                                <div>
                                    <p class="text-sm font-semibold uppercase">WINNER</p>
                                    <p class="text-2xl font-bold text-slate-950">
                                        {{ strtoupper($finalScore->winner) }}
                                    </p>
                                </div>
                                <!-- Method -->
                                <div>
                                    <p class="text-sm font-semibold uppercase">METHOD</p>
                                    <p class="text-2xl font-bold uppercase text-slate-950">
                                        {{ ucfirst(str_replace('_', ' ', $finalScore->method)) }}
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- Blue Fighter -->
                        <div class="flex flex-col items-center space-y-4">
                            <!-- Blue Corner Fighter Image -->
                            <div class="relative">
                                <img src="{{ $room->blueCorner->image ? asset('storage/' . $room->blueCorner->image) : asset('default-blue.jpg') }}"
                                    alt="{{ $room->blueCorner->name ?? 'Unknown Fighter' }}"
                                    class="object-cover w-full h-full">
                                <div
                                    class="absolute bottom-0 left-0 right-0 hidden p-2 text-center sm:block bg-blue-900/70">
                                    <p class="text-xs font-bold text-white uppercase">Blue Corner</p>
                                    <p class="text-xs font-bold text-white uppercase lg:text-4xl">
                                        {{ $room->blueCorner->name ?? 'Unknown Fighter' }}
                                    </p>
                                </div>
                                <p class="text-sm font-bold text-blue-500 uppercase lg:hidden">
                                    {{ $room->blueCorner->name ?? 'BLUE FIGHTER' }}
                                </p>

                            </div>
                        </div>
                    </div>

                    <!-- Match Info Mobile View -->
                    <div class="flex flex-col justify-center pt-4 border-t border-gray-300 lg:hidden">
                        <div class="grid grid-cols-3 gap-1 mb-3 text-center">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Round</p>
                                <p class="text-sm font-bold text-slate-950">{{ $finalScore->round }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">winner</p>
                                <p class="text-sm font-bold uppercase text-slate-950">{{ $finalScore->winner }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Method</p>
                                <p class="text-sm font-bold uppercase text-slate-950">
                                    {{ ucfirst(str_replace('_', ' ', $finalScore->method)) }}
                                </p>
                            </div>
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
