<x-app-layout>
    <x-slot name="header">
        <section class="relative flex w-full h-screen bg-blue-800">
            <div class="relative w-full">
                <img src="img/fight.jpg" class="object-cover w-full h-screen filter brightness-50">
                <div
                    class="absolute top-0 left-0 right-0 flex flex-col items-center justify-center px-8 mt-24 bottom-20 lg:px-32">
                    <div>
                        <p class="text-5xl font-bold tracking-wider text-center text-white uppercase lg:text-7xl">Fighter
                            Informations
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



    <section class="p-8 bg-white lg:p-32">
        <div class="relative isolate">
            <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <div class="flex flex-col main-container">
                <text class="text-3xl font-bold tracking-wider text-center uppercase text-slate-950 lg:text-7xl">Fighter
                    List</text>

                {{-- <ul>
                    @foreach ($fighters as $fighter)
                        <li>{{ $fighter->name }} - {{ $fighter->description }}</li>
                    @endforeach
                </ul> --}}
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </section>


    <script>
        document.querySelectorAll('.toggle-description').forEach(button => {
            button.addEventListener('click', () => {
                const description = button.closest('.flex.flex-col').querySelector('.description');
                if (description.classList.contains('hidden')) {
                    description.classList.remove('hidden');
                    button.textContent = 'HIDE DETAILS';
                } else {
                    description.classList.add('hidden');
                    button.textContent = 'SEE DETAILS';
                }
            });
        });
    </script>

    <style>
        @media (min-width: 768px) {
            .description {
                display: block !important;
            }

            .toggle-description {
                display: none !important;
            }
        }
    </style>


</x-app-layout>
