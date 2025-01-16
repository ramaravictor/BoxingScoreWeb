<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen " style="opacity: 1;">
            <div class="relative w-full ">
                <img src="{{ $room->redCorner->image ? asset('storage/' . $room->redCorner->image) : asset('default-red.jpg') }}"
                    class="absolute inset-y-0 left-0 object-cover w-1/2 h-full brightness-50">
                <img src="{{ $room->blueCorner->image ? asset('storage/' . $room->blueCorner->image) : asset('default-blue.jpg') }}"
                    class="absolute inset-y-0 right-0 object-cover w-1/2 h-full brightness-50">

                <!-- Adjust brightness-50 to your desired darkness level (0-100) -->
                <div
                    class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                    <div style="opacity: 1;">
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">
                            {{ $room->name }}</p>
                    </div>
                    <div style="opacity: 1;">
                        <p
                            class="mt-4 text-xl font-normal leading-relaxed tracking-wider text-center text-white md:text-xl lg:max-w-lg">
                            {{ $room->class }}
                        </p>
                        <p
                            class="mt-4 text-xl font-normal leading-relaxed tracking-wider text-center text-white md:text-xl lg:max-w-lg">
                            {{ $room->formatted_schedule }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 left-0 right-0 z-30">
                <div class="flex flex-col items-center justify-center">
                    <div class="flex justify-center mb-12 space-x-7">
                        @if ($finalScoreExists)
                            <!-- Tombol View Result -->
                            <a href="{{ route('finalscore.show', $room->id) . '#final-score' }}"
                                class="px-8 py-3 text-sm font-bold uppercase transition duration-300 bg-white border border-slate-950 text-slate-950 hover:bg-slate-950 hover:border-white hover:text-white">
                                VIEW RESULT
                            </a>
                        @else
                            <!-- Tombol Calculate Score -->
                            @can('dewanjuri')
                                <a href="{{ route('round-scores.calculate', ['room_id' => $room->id]) . '#final-desicion' }}"
                                    class="px-8 py-3 text-sm font-bold uppercase transition duration-300 bg-white border text-slate-950 border-slate-950 hover:bg-slate-950 hover:text-white">
                                    CALCULATE SCORE
                                </a>
                            @endcan
                        @endif
                    </div>

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

    @auth
        @if (!Auth::user()->is_dewanjuri)
            <main class="relative overflow-hidden bg-white">
                <!-- Konten hanya untuk Juri -->
                <section id="round-score" class="py-6 lg:px-32 lg:py-16">
                    <div class="flex flex-col p-5 main-container aos-init aos-animate lg:mb-16" data-aos="fade-up">
                        <text class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-7xl">
                            Match Score by: {{ Auth::user()->name }}
                        </text>
                    </div>

                    @if (session('success'))
                        <div id="success-message"
                            class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif


                    <!-- Scrollable Table Container -->
                    <div class="overflow-x-auto">
                        <form id="scoreForm" method="POST" action="{{ route('round-scores.store') }}">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">

                            <table class="min-w-full text-center border border-collapse border-gray-200" id="scoreTable">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th colspan="5"
                                            class="p-4 text-lg font-bold uppercase border-b border-gray-300 text-slate-950">
                                            {{ $room->redCorner->name ?? 'Red Fighter' }}
                                        </th>
                                        <th class="p-4 text-lg font-bold uppercase border-b border-gray-300 text-slate-950">
                                            Round</th>
                                        <th colspan="6"
                                            class="p-4 text-lg font-bold uppercase border-b border-gray-300 text-slate-950">
                                            {{ $room->blueCorner->name ?? 'Blue Fighter' }}
                                        </th>
                                    </tr>
                                    <tr class="text-sm font-bold text-gray-600 uppercase">
                                        <th class="p-2 border border-gray-300">Point</th>
                                        <th class="p-2 border border-gray-300">Knock Down</th>
                                        <th class="p-2 border border-gray-300">Damage</th>
                                        <th class="p-2 border border-gray-300">Foul</th>
                                        <th class="p-2 border border-gray-300">Score</th>
                                        <th class="p-2 border border-gray-300">#</th>
                                        <th class="p-2 border border-gray-300">Point</th>
                                        <th class="p-2 border border-gray-300">Knock Down</th>
                                        <th class="p-2 border border-gray-300">Damage</th>
                                        <th class="p-2 border border-gray-300">Foul</th>
                                        <th class="p-2 border border-gray-300">Score</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @for ($round = 1; $round <= 5; $round++)
                                        <tr>
                                            <!-- Red Corner Columns -->
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][red_point]"
                                                    value="{{ $roundScores[$round]['red_point'] ?? 0 }}" min="0"
                                                    max="100"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 red-point">
                                            </td>
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][red_kd]"
                                                    value="{{ $roundScores[$round]['red_kd'] ?? 0 }}" min="0"
                                                    max="100"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 red-kd">
                                            </td>
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][red_damage]"
                                                    value="{{ $roundScores[$round]['red_damage'] ?? 0 }}" min="0"
                                                    max="100"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 red-damage">
                                            </td>
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][red_foul]"
                                                    value="{{ $roundScores[$round]['red_foul'] ?? 0 }}" min="0"
                                                    max="3"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 red-foul">
                                            </td>
                                            <td class="p-3 font-bold text-red-500">
                                                <span class="red-score">{{ $roundScores[$round]['red_score'] ?? 0 }}</span>
                                                <input type="hidden" name="scores[{{ $round }}][red_score]"
                                                    value="{{ $roundScores[$round]['red_score'] ?? 0 }}"
                                                    class="hidden-red-score">
                                            </td>

                                            <!-- Round Number -->
                                            <td class="p-3 text-xl font-bold border border-gray-300 text-slate-950">
                                                {{ $round }}</td>

                                            <!-- Blue Corner Columns -->
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][blue_point]"
                                                    value="{{ $roundScores[$round]['blue_point'] ?? 0 }}" min="0"
                                                    max="100"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 blue-point">
                                            </td>
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][blue_kd]"
                                                    value="{{ $roundScores[$round]['blue_kd'] ?? 0 }}" min="0"
                                                    max="100"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 blue-kd">
                                            </td>
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][blue_damage]"
                                                    value="{{ $roundScores[$round]['blue_damage'] ?? 0 }}" min="0"
                                                    max="100"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 blue-damage">
                                            </td>
                                            <td class="p-3">
                                                <input type="number" name="scores[{{ $round }}][blue_foul]"
                                                    value="{{ $roundScores[$round]['blue_foul'] ?? 0 }}" min="0"
                                                    max="3"
                                                    class="w-full px-2 py-1 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 blue-foul">
                                            </td>
                                            <td class="p-3 font-bold text-blue-500">
                                                <span
                                                    class="blue-score">{{ $roundScores[$round]['blue_score'] ?? 0 }}</span>
                                                <input type="hidden" name="scores[{{ $round }}][blue_score]"
                                                    value="{{ $roundScores[$round]['blue_score'] ?? 0 }}"
                                                    class="hidden-blue-score">
                                            </td>
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>


                            <!-- Submit Button -->
                            <div class="flex justify-center mt-12">
                                <button type="submit"
                                    class="px-8 py-3 text-sm font-bold text-white uppercase transition duration-300 border bg-slate-950 border-slate-950 hover:bg-white hover:text-slate-950">
                                    Save Scores
                                </button>
                            </div>
                        </form>
                    </div>

                </section>
            </main>
        @endif
    @endauth



</x-app-layout>




<script>
    function calculateScores() {
        const rows = document.querySelectorAll("#scoreTable tbody tr");

        rows.forEach(row => {
            const redPoint = parseInt(row.querySelector(".red-point").value) || 0;
            const redKD = parseInt(row.querySelector(".red-kd").value) || 0;
            const redDamage = parseInt(row.querySelector(".red-damage").value) || 0;
            const redFoul = parseInt(row.querySelector(".red-foul").value) || 0;

            const bluePoint = parseInt(row.querySelector(".blue-point").value) || 0;
            const blueKD = parseInt(row.querySelector(".blue-kd").value) || 0;
            const blueDamage = parseInt(row.querySelector(".blue-damage").value) || 0;
            const blueFoul = parseInt(row.querySelector(".blue-foul").value) || 0;

            // Check if all values are 0
            const isRedEmpty = redPoint === 0 && redKD === 0 && redDamage === 0 && redFoul === 0;
            const isBlueEmpty = bluePoint === 0 && blueKD === 0 && blueDamage === 0 && blueFoul === 0;

            if (isRedEmpty && isBlueEmpty) {
                // Set default scores to 0 if all inputs are empty
                row.querySelector(".red-score").innerText = "0.0";
                row.querySelector(".blue-score").innerText = "0.0";
                row.querySelector(".hidden-red-score").value = "0.0";
                row.querySelector(".hidden-blue-score").value = "0.0";
                return;
            }

            let redScore = 9,
                blueScore = 9;

            // Compare Points
            if (redPoint > bluePoint) {
                redScore = 10;
            } else if (bluePoint > redPoint) {
                blueScore = 10;
            } else {
                // Compare KD if Points are Equal
                if (redKD > blueKD) {
                    redScore = 10;
                } else if (blueKD > redKD) {
                    blueScore = 10;
                }
            }

            // Apply Damage Adjustment
            blueScore -= redDamage;
            redScore -= blueDamage;

            // Apply Foul Adjustment
            redScore -= redFoul;
            blueScore -= blueFoul;

            // Prevent Negative Scores
            redScore = Math.max(redScore, 0);
            blueScore = Math.max(blueScore, 0);

            // Update Scores in Table
            row.querySelector(".red-score").innerText = redScore.toFixed(1);
            row.querySelector(".blue-score").innerText = blueScore.toFixed(1);

            // Update Hidden Input Values
            row.querySelector(".hidden-red-score").value = redScore.toFixed(1);
            row.querySelector(".hidden-blue-score").value = blueScore.toFixed(1);
        });
    }


    // Add Event Listeners to Inputs
    document.querySelectorAll("#scoreTable input").forEach(input => {
        input.addEventListener("input", calculateScores);
    });

    // Initial Calculation
    calculateScores();
</script>
