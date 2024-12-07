<footer class="px-6 py-12 bg-gradient-to-r from-slate-900 to-slate-950"
    style="font-family: 'Oswald', sans-serif; text-transform: uppercase;">
    <div class="w-full max-w-screen-xl mx-auto">
        <div class="md:flex md:justify-between">
            <div class="mb-5 md:mb-0">

                <a href="/" class="flex">
                    <img src="{{ asset('img/boxing.png') }}" alt="Logo" class="w-auto h-16" />
                </a>

                <div class="mt-5 text-white dark:text-white">
                    <div id="clock" class="text-4xl font-semibold"></div>
                </div>


            </div>
            <div class="grid">
                <div>
                    <h2 class="mb-3 text-sm font-semibold text-white uppercase dark:text-white">Capstone Project</h2>
                    <h3 class="mb-3 text-sm font-medium text-white dark:text-white">Infromation Technology, UMY
                    </h3>
                </div>
                <div class="flex">

                    <a href="#" class="text-white hover:text-white dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        <span class="sr-only">Instagram Page</span>
                    </a>
                    <a href="#" class="text-white hover:text-white dark:hover:text-white ms-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-white hover:text-white dark:hover:text-white ms-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5">
                            <path fill="currentColor"
                                d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                        </svg>
                        <span class="sr-only">Tiktok page</span>
                    </a>
                </div>
            </div>
            <!-- Back to Top Button -->
            <a href="#" id="backToTop"
                class="fixed flex items-center justify-center w-12 h-12 text-white transition duration-300 bg-gray-800 rounded-full shadow-lg bottom-6 right-6 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </a>

        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('clock').textContent = timeString;
    }

    // Memperbarui jam setiap detik
    setInterval(updateClock, 1000);

    // Memanggil fungsi untuk memperbarui jam saat halaman dimuat
    updateClock();
</script>

<script>
    // Smooth scroll back to top
    const backToTopButton = document.getElementById('backToTop');

    // Scroll event to show/hide button
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopButton.style.display = 'flex';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    // Smooth scroll when button is clicked
    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
