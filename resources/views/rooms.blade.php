<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen " style="opacity: 1;">
            <div class="relative w-full ">
                <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('default-image.jpg') }}"
                    class="object-cover w-full h-screen brightness-50">
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
                                class="px-8 py-3 text-sm font-bold uppercase transition duration-300 bg-white border border-slate-950 text-slate-950 hover:bg-slate-950 hover:text-white">
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

                            <table class="w-full text-center border-collapse min-w-[700px]" id="scoreTable">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th rowspan="2" class="px-4 py-2 border">Round</th>
                                        <th colspan="2" class="px-4 py-2 border">Damage</th>
                                        <th colspan="2" class="px-4 py-2 border">Knock Down</th>
                                        <th colspan="2" class="px-4 py-2 border">Penalty</th>
                                        <th colspan="2" class="px-4 py-2 border">Total Score</th>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-red-500 border">Red</th>
                                        <th class="px-4 py-2 text-blue-500 border">Blue</th>
                                        <th class="px-4 py-2 text-red-500 border">Red</th>
                                        <th class="px-4 py-2 text-blue-500 border">Blue</th>
                                        <th class="px-4 py-2 text-red-500 border">Red</th>
                                        <th class="px-4 py-2 text-blue-500 border">Blue</th>
                                        <th class="px-4 py-2 text-red-500 border">Red</th>
                                        <th class="px-4 py-2 text-blue-500 border">Blue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($round = 1; $round <= 5; $round++)
                                        <tr>
                                            <td class="px-4 py-2 border">Round {{ $round }}</td>
                                            <td class="px-4 py-2 border">
                                                <input type="number" name="scores[{{ $round }}][damage_red]"
                                                    value="{{ $roundScores[$round]['damage_red'] ?? 0 }}" min="0"
                                                    max="10" class="w-full text-center damage-red">
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <input type="number" name="scores[{{ $round }}][damage_blue]"
                                                    value="{{ $roundScores[$round]['damage_blue'] ?? 0 }}" min="0"
                                                    max="10" class="w-full text-center damage-blue">
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <input type="number" name="scores[{{ $round }}][knock_red]"
                                                    value="{{ $roundScores[$round]['knock_red'] ?? 0 }}" min="0"
                                                    max="10" class="w-full text-center knock-red">
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <input type="number" name="scores[{{ $round }}][knock_blue]"
                                                    value="{{ $roundScores[$round]['knock_blue'] ?? 0 }}" min="0"
                                                    max="10" class="w-full text-center knock-blue">
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <input type="number" name="scores[{{ $round }}][penalty_red]"
                                                    value="{{ $roundScores[$round]['penalty_red'] ?? 0 }}" min="0"
                                                    max="10" class="w-full text-center penalty-red">
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <input type="number" name="scores[{{ $round }}][penalty_blue]"
                                                    value="{{ $roundScores[$round]['penalty_blue'] ?? 0 }}" min="0"
                                                    max="10" class="w-full text-center penalty-blue">
                                            </td>
                                            <td class="px-4 py-2 text-white bg-red-500 border result-red">
                                                <span
                                                    class="total-red">{{ $roundScores[$round]['total_red'] ?? 0 }}</span>
                                                <input type="hidden" name="scores[{{ $round }}][total_red]"
                                                    class="hidden-total-red"
                                                    value="{{ $roundScores[$round]['total_red'] ?? 0 }}">
                                            </td>
                                            <td class="px-4 py-2 text-white bg-blue-500 border result-blue">
                                                <span
                                                    class="total-blue">{{ $roundScores[$round]['total_blue'] ?? 0 }}</span>
                                                <input type="hidden" name="scores[{{ $round }}][total_blue]"
                                                    class="hidden-total-blue"
                                                    value="{{ $roundScores[$round]['total_blue'] ?? 0 }}">
                                            </td>
                                        </tr>
                                    @endfor

                                </tbody>

                            </table>
                            <!-- Submit Button -->
                            <div class="flex justify-center mt-8">
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
    function calculateResults() {
        const rows = document.querySelectorAll("#scoreTable tbody tr");

        rows.forEach(row => {
            const damageRed = parseFloat(row.querySelector('.damage-red').value) || 0;
            const damageBlue = parseFloat(row.querySelector('.damage-blue').value) || 0;
            const knockRed = parseFloat(row.querySelector('.knock-red').value) || 0;
            const knockBlue = parseFloat(row.querySelector('.knock-blue').value) || 0;
            const penaltyRed = parseFloat(row.querySelector('.penalty-red').value) || 0;
            const penaltyBlue = parseFloat(row.querySelector('.penalty-blue').value) || 0;

            // Perhitungan Total Skor
            const scoreRed = Math.max(damageRed - knockRed - penaltyRed, 0);
            const scoreBlue = Math.max(damageBlue - knockBlue - penaltyBlue, 0);

            // Tampilkan skor di dalam span
            row.querySelector('.total-red').innerText = scoreRed.toFixed(1);
            row.querySelector('.total-blue').innerText = scoreBlue.toFixed(1);

            // Update nilai input hidden
            row.querySelector('.hidden-total-red').value = scoreRed.toFixed(1);
            row.querySelector('.hidden-total-blue').value = scoreBlue.toFixed(1);
        });
    }

    // Jalankan fungsi perhitungan setiap kali input berubah
    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("input", calculateResults);
    });

    // Jalankan sekali saat halaman dimuat
    calculateResults();
</script>
