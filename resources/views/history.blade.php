<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen " style="opacity: 1;">
            <div class="relative w-full ">
                <img src="img/wallpaper1.jpg" class="object-cover w-full h-screen brightness-50">
                <!-- Adjust brightness-50 to your desired darkness level (0-100) -->
                <div
                    class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                    <div style="opacity: 1;">
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                            HISTORY MATCH</p>
                    </div>
                    <div style="opacity: 1;">
                        <p
                            class="mt-4 text-xs font-normal leading-relaxed tracking-wider text-center text-white md:text-xl lg:max-w-lg">
                            Never Give Up.
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

                <div class="flex flex-col p-5 main-container aos-init aos-animate lg:mb-12" data-aos="fade-up">
                    <text
                        class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-7xl">PAST
                        EVENTS</text>
                </div>


                <!-- List of Events -->
                <!-- Desktop View -->
                <div class="hidden px-4 py-6 space-y-6 md:block">
                    @foreach ($rooms as $room)
                        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-md overflow-hidden h-[200px]">
                            <!-- Image Section -->
                            <div class="w-full h-full md:w-1/4">
                                <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('default-image.jpg') }}"
                                    alt="{{ $room->name }}" class="object-cover w-full h-full">
                            </div>

                            <!-- Details Section -->
                            <div class="flex flex-col justify-between flex-1 p-6">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">{{ $room->name }}</h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <span class="font-semibold">
                                            {{ \Carbon\Carbon::parse($room->schedule)->format('D, M j / g:i A') }}
                                        </span>
                                        | {{ $room->location }}
                                    </p>
                                    <p class="mt-3 text-gray-700">{{ $room->class }}</p>
                                </div>
                                <p class="text-sm text-gray-600">{{ $room->weight ?? 'N/A' }} kg</p>
                            </div>

                            <!-- Actions Section -->
                            <div class="flex flex-col items-center justify-center p-6 space-y-4">
                                <a href="{{ route('rooms.show', $room->id) }}"
                                    class="px-4 py-2 text-sm font-semibold text-center text-white uppercase transition border border-slate-950 bg-slate-950 hover:bg-white hover:text-slate-950 w-36">
                                    View Score
                                </a>
                                @can('dewanjuri')
                                    <a href="{{ route('rooms.show', $room->id) }}"
                                        class="px-4 py-2 text-sm font-semibold text-center text-white uppercase transition border border-slate-950 bg-slate-950 hover:bg-white hover:text-slate-950 w-36">
                                        Edit Results
                                    </a>
                                @endcan

                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Mobile View -->
                <div class="block px-4 py-6 space-y-10 md:hidden">
                    @foreach ($rooms as $room)
                        <!-- Card Wrapper -->
                        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                            <!-- Image Section -->
                            <div class="relative">
                                <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('default-image.jpg') }}"
                                    alt="{{ $room->name }}" class="object-cover w-full h-48">
                            </div>

                            <!-- Details Section -->
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-bold text-gray-900">{{ $room->name }}</h3>
                                <p class="text-sm font-semibold text-gray-600">
                                    {{ \Carbon\Carbon::parse($room->schedule)->format('D, M j / g:i A') }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $room->location }}</p>
                                <p class="mt-2 text-sm text-gray-700">{{ $room->class }}</p>
                            </div>

                            <!-- Buttons -->
                            <div class="flex border-t divide-x divide-gray-200">
                                <a href="{{ route('rooms.show', $room->id) }}"
                                    class="flex-1 py-3 text-sm font-bold text-center uppercase text-slate-950 hover:bg-gray-300">
                                    View Score
                                </a>
                                <a href="{{ route('rooms.show', $room->id) }}"
                                    class="flex-1 py-3 text-sm font-bold text-center uppercase text-slate-950 hover:bg-gray-300">
                                    Edit Result
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>





            </div>
        </section>
    </main>
</x-app-layout>
