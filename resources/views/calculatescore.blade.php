<x-app-layout>
    <x-slot name="header">
        <!-- Session Success Message -->
        @if (session('success'))
            <div id="session-message"
                class="absolute top-0 left-0 right-0 z-50 p-4 text-center text-green-700 bg-green-100 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
            <script>
                // Hilangkan session message setelah 5 detik
                setTimeout(() => {
                    const sessionMessage = document.getElementById('session-message');
                    if (sessionMessage) {
                        sessionMessage.style.transition = 'opacity 1s ease';
                        sessionMessage.style.opacity = '0';
                        setTimeout(() => sessionMessage.remove(), 1000); // Hapus elemen setelah animasi
                    }
                }, 5000);
            </script>
        @endif

        <!-- Header Section -->
        <section class="relative flex w-full h-screen" style="opacity: 1;">
            <div class="relative w-full">
                <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('default-image.jpg') }}"
                    class="object-cover w-full h-screen brightness-50">
                <!-- Adjust brightness-50 to your desired darkness level (0-100) -->
                <div
                    class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                    <div style="opacity: 1;">
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                            {{ $room->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
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





    <section id="final-desicion" class="py-6 lg:px-32 lg:mt-16">
        <div class="flex flex-col p-5 main-container aos-init aos-animate lg:mb-16" data-aos="fade-up">
            <text class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-7xl">
                final decision by: {{ Auth::user()->name }}
            </text>
        </div>

        <!-- Scrollable Table Container -->
        <div class="overflow-x-auto">
            <form id="scoreForm" method="POST" action="{{ route('round-scores.store') }}">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                <table class="w-full text-center border-collapse min-w-[700px] border border-slate-950">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border border-slate-950" rowspan="2">Round</th>
                            @foreach ($judges as $judge)
                                <th class="px-4 py-2 border border-slate-950" colspan="2">{{ $judge->name }}</th>
                            @endforeach
                        </tr>
                        <tr class="bg-gray-100">
                            @foreach ($judges as $judge)
                                <th class="px-4 py-2 text-red-500 border border-slate-950">
                                    {{ $room->redCorner->name ?? 'RED FIGHTER' }}</th>
                                <th class="px-4 py-2 text-blue-500 border border-slate-950">
                                    {{ $room->blueCorner->name ?? 'BLUE FIGHTER' }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($round = 1; $round <= 5; $round++)
                            <tr>
                                <td class="px-4 py-2 border border-slate-950">Round {{ $round }}</td>
                                @foreach ($judges as $judge)
                                    @php
                                        $score = $roundScores
                                            ->where('round_number', $round)
                                            ->where('user_id', $judge->id)
                                            ->first();
                                    @endphp
                                    <td class="px-4 py-2 text-white bg-red-500 border border-slate-950">
                                        {{ $score->total_red ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2 text-white bg-blue-500 border border-slate-950">
                                        {{ $score->total_blue ?? 'N/A' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                        <!-- Total Row -->
                        <tr class="font-bold bg-gray-100">
                            <td class="px-4 py-2 border border-slate-950">Total</td>
                            @foreach ($judges as $judge)
                                @php
                                    $totalRed = $roundScores->where('user_id', $judge->id)->sum('total_red');
                                    $totalBlue = $roundScores->where('user_id', $judge->id)->sum('total_blue');
                                @endphp
                                <td class="px-4 py-2 text-white bg-red-500 border border-slate-950">
                                    {{ $totalRed }}
                                </td>
                                <td class="px-4 py-2 text-white bg-blue-500 border border-slate-950">
                                    {{ $totalBlue }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </section>




    <!-- Button Section -->
    <div class="flex justify-center mt-8">
        <button id="toggleAverageButton"
            class="px-8 py-3 mb-20 text-sm font-bold text-white uppercase transition duration-300 border bg-slate-950 border-slate-950 hover:bg-white hover:text-slate-950">
            Score Average
        </button>
    </div>







    <!-- Section Average Result -->
    <section id="average-result" class="hidden py-6 lg:px-32">
        <div class="p-8 py-8 mx-auto mt-5 bg-white border border-gray-300 rounded-lg shadow-lg max-w-7xl">
            <div class="flex flex-col items-center justify-center ">
                <h2 class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-5xl">
                    Score Average
                </h2>
            </div>
            <form id="final-decision-form" method="POST" action="{{ route('finalscore.store') }}" class="mt-8">
                @csrf
                <!-- Main Content -->
                <div class="grid items-center grid-cols-3 gap-4 mb-5 text-center">
                    <!-- Fighter 1 -->
                    <div class="flex flex-col items-center space-y-4">
                        <img src="{{ $room->redCorner->image ? asset('storage/' . $room->redCorner->image) : asset('default-image.jpg') }}"
                            alt="Red Fighter" class="object-cover w-40 h-40 rounded-full">
                        <p class="text-4xl font-bold text-red-500">
                            {{ $room->redCorner->name ?? 'RED FIGHTER' }}
                        </p>
                    </div>

                    <!-- VS and Match Info -->
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <p class="font-bold text-gray-800 text-7xl">VS</p>
                        <div class="grid items-center grid-cols-3 gap-6">
                            <!-- Round Input -->
                            <div class="flex flex-col items-center">
                                <label for="round-input" class="mb-2 text-sm text-gray-500 uppercase">Round</label>
                                <input type="number" id="round-input" name="round" value="1" min="1"
                                    max="10"
                                    class="w-20 px-4 py-2 font-bold text-center text-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Winner Dropdown -->
                            <div class="flex flex-col items-center">
                                <label for="winner" class="mb-2 text-sm text-gray-500 uppercase">Winner</label>
                                <select id="winner" name="winner"
                                    class="w-32 px-2 py-2 text-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="red" class="font-bold text-red-500">RED</option>
                                    <option value="blue" class="font-bold text-blue-500">BLUE</option>
                                </select>
                            </div>
                            <!-- Method Dropdown -->
                            <div class="flex flex-col items-center">
                                <label for="method" class="mb-2 text-sm text-gray-500 uppercase">Method</label>
                                <select id="method" name="method"
                                    class="w-32 px-2 py-2 text-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="ko_tko">KO/TKO</option>
                                    <option value="decision_point">Decision-Point</option>
                                    <option value="disqualified">Disqualified</option>
                                </select>
                            </div>
                        </div>
                        <!-- Hidden Inputs -->
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="score_ave_red" value="{{ $averageRed }}">
                        <input type="hidden" name="score_ave_blue" value="{{ $averageBlue }}">
                    </div>

                    <!-- Fighter 2 -->
                    <div class="flex flex-col items-center space-y-4">
                        <img src="{{ $room->blueCorner->image ? asset('storage/' . $room->blueCorner->image) : asset('default-image.jpg') }}"
                            alt="Blue Fighter" class="object-cover w-40 h-40 rounded-full">
                        <p class="text-4xl font-bold text-blue-500">
                            {{ $room->blueCorner->name ?? 'BLUE FIGHTER' }}
                        </p>
                    </div>
                </div>


                <!-- Average Score Cards -->
                <div class="flex flex-wrap justify-center gap-8">
                    <!-- Red Team Card -->
                    <div class="w-full max-w-xs p-6 text-center bg-gray-100 rounded-lg shadow-lg">
                        <h3 class="text-lg font-bold text-gray-700 uppercase">SCORE:</h3>
                        <p class="my-2 text-4xl font-bold text-red-500">{{ $averageRed }}</p>
                        <div class="text-center text-gray-700">
                            <p class="text-sm font-semibold">Total Damage: <span
                                    class="text-red-500">{{ $totalDamage['red'] }}</span></p>
                            <p class="text-sm font-semibold">Total Knock Down: <span
                                    class="text-red-500">{{ $totalKnockDown['red'] }}</span></p>
                            <p class="text-sm font-semibold">Total Penalty: <span
                                    class="text-red-500">{{ $totalPenalty['red'] }}</span></p>
                        </div>
                    </div>

                    <!-- Blue Team Card -->
                    <div class="w-full max-w-xs p-6 text-center bg-gray-100 rounded-lg shadow-lg">
                        <h3 class="text-lg font-bold text-gray-700 uppercase">SCORE:</h3>
                        <p class="my-2 text-4xl font-bold text-blue-500">{{ $averageBlue }}</p>
                        <div class="text-center text-gray-700">
                            <p class="text-sm font-semibold">Total Damage: <span
                                    class="text-blue-500">{{ $totalDamage['blue'] }}</span></p>
                            <p class="text-sm font-semibold">Total Knock Down: <span
                                    class="text-blue-500">{{ $totalKnockDown['blue'] }}</span></p>
                            <p class="text-sm font-semibold">Total Penalty: <span
                                    class="text-blue-500">{{ $totalPenalty['blue'] }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 mb-8 text-sm font-bold text-white uppercase transition duration-300 border bg-slate-950 border-slate-950 hover:bg-white hover:text-slate-950">
                        Submit Final Decision
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>



<!-- JavaScript for Button Click -->
<script>
    document.getElementById('toggleAverageButton').addEventListener('click', function() {
        // Show Average Section
        document.getElementById('average-result').classList.remove('hidden');

        // Hide Score Average Button
        this.classList.add('hidden');

        // Show Submit Final Decision Button
        document.getElementById('final-decision-form').classList.remove('hidden');

        // Smooth Scroll to Average Section
        document.getElementById('average-result').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
