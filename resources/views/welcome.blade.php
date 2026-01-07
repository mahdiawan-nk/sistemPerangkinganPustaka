<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kehadiran Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="min-h-screen flex flex-col bg-base-200">

    <!-- ================= HEADER / NAVBAR ================= -->
    <header class="bg-base-100 border-b border-base-300 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 py-3">

                <!-- Logo & Title -->
                <div class="flex items-center gap-3">
                    <img src="https://poltek-kampar.ac.id/storage/photos/22/logo_services/logo_polkam_no_background7.png"
                        alt="Logo Politeknik Kampar" class="w-12 h-12 object-contain" />

                    <div class="leading-tight">
                        <h1 class="text-sm md:text-base font-bold uppercase">
                            Sistem Kehadiran Perpustakaan
                        </h1>
                        <p class="text-xs md:text-sm font-semibold uppercase text-base-content/70">
                            Politeknik Kampar
                        </p>
                    </div>
                </div>

                <!-- Info -->
                <div class="flex flex-wrap items-center gap-2 md:justify-end">
                    <span class="badge badge-outline px-4 py-3 text-xs md:text-sm">
                        📍 Bangkinang
                    </span>
                    <span class="badge badge-outline px-4 py-3 text-xs md:text-sm">
                        📅 12 Dec 2025
                    </span>
                    <span class="badge badge-outline px-4 py-3 text-xs md:text-sm">
                        👤 2 Visitor
                    </span>
                </div>

            </div>
        </nav>
    </header>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 min-h-screen">
        <section class="hero bg-base-200 dark:bg-slate-800">
            <div class="hero-content px-4 py-8 sm:py-10 md:py-12 text-center">
                <div class="max-w-4xl space-y-4">

                    <h1
                        class="font-bold uppercase leading-tight
                       text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
                        Selamat Datang di <br class="hidden sm:block" />
                        Perpustakaan Politeknik Kampar
                    </h1>

                    <p class="text-sm sm:text-base md:text-lg text-base-content/70">
                        Sistem Kehadiran & Layanan Digital Perpustakaan
                    </p>

                </div>
            </div>
        </section>

        <div class="overflow-hidden bg-base-100 border-y border-base-300 my-4 max-w-7xl mx-auto">
            <div class="flex w-max items-center animate-marquee hover:[animation-play-state:paused]"
                aria-label="Informasi Perpustakaan">
                <!-- duplicate text for seamless loop -->
                <span class="mx-10 py-2 text-sm sm:text-base font-medium whitespace-nowrap">
                    📢 Selamat Datang di Perpustakaan, Silakan Lakukan Absensi Kunjungan. |
                    Ayo Berkunjung ke Perpustakaan — Ilmu Menanti Anda
                </span>
                <span class="mx-10 py-2 text-sm sm:text-base font-medium whitespace-nowrap">
                    📢 Selamat Datang di Perpustakaan, Silakan Lakukan Absensi Kunjungan. |
                    Ayo Berkunjung ke Perpustakaan — Ilmu Menanti Anda
                </span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto ">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 ">

                <!-- ================= LEFT CARD : FORM ================= -->
                <div class="card bg-base-100 shadow-lg" x-data x-init="Echo.channel('visitors')
                    .listen('.visitor.created', () => {
                        {{-- alert('New Visitor'); --}}
                    })">
                    <div class="card-body">
                        <h2 class="text-lg font-bold mb-2">
                            Form Kunjungan Perpustakaan
                        </h2>
                        <livewire:visitor.create />
                    </div>
                </div>

                <!-- ================= RIGHT CARD : INFO SCAN ================= -->
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body flex flex-col items-center text-center gap-4">

                        <h2 class="text-lg font-semibold">
                            Silakan scan kartu anggota Anda <br>
                            pada scanner untuk absensi kehadiran.
                        </h2>

                        <div class="w-full max-w-sm">
                            <svg fill="#000000" class="w-fit" viewBox="0 0 24 24" id="barcode-scan"
                                data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color">
                                <path id="secondary"
                                    d="M16,18a1,1,0,0,1-1-1V16a1,1,0,0,1,2,0v1A1,1,0,0,1,16,18Zm-4,0a1,1,0,0,1-1-1V16a1,1,0,0,1,2,0v1A1,1,0,0,1,12,18ZM8,18a1,1,0,0,1-1-1V16a1,1,0,0,1,2,0v1A1,1,0,0,1,8,18Zm12-5H4a1,1,0,0,1,0-2H20a1,1,0,0,1,0,2ZM16,9a1,1,0,0,1-1-1V7a1,1,0,0,1,2,0V8A1,1,0,0,1,16,9ZM12,9a1,1,0,0,1-1-1V7a1,1,0,0,1,2,0V8A1,1,0,0,1,12,9ZM8,9A1,1,0,0,1,7,8V7A1,1,0,0,1,9,7V8A1,1,0,0,1,8,9Z"
                                    style="fill: rgb(44, 169, 188);"></path>
                                <path id="primary"
                                    d="M3,9A1,1,0,0,1,2,8V4A2,2,0,0,1,4,2H8A1,1,0,0,1,8,4H4V8A1,1,0,0,1,3,9ZM22,8V4a2,2,0,0,0-2-2H16a1,1,0,0,0,0,2h4V8a1,1,0,0,0,2,0ZM9,21a1,1,0,0,0-1-1H4V16a1,1,0,0,0-2,0v4a2,2,0,0,0,2,2H8A1,1,0,0,0,9,21Zm13-1V16a1,1,0,0,0-2,0v4H16a1,1,0,0,0,0,2h4A2,2,0,0,0,22,20Z"
                                    style="fill: rgb(0, 0, 0);"></path>
                            </svg>
                        </div>

                        <p class="text-base-content/70">
                            Non-anggota atau anggota yang lupa membawa kartu
                            silakan input kehadiran melalui form.
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-base-100 border-t border-base-300">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <p class="text-center text-sm text-base-content/60">
                © {{ date('Y') }} Politeknik Kampar — Sistem Kehadiran Perpustakaan
            </p>
        </div>
    </footer>

    <dialog id="welcome_modal" class="modal">
        <div class="modal-box relative p-6 bg-white dark:bg-gray-800 rounded-xl shadow-xl animate-fadeIn">
            <!-- Close Button -->
            <form method="dialog">
                <button
                    class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-200">
                    ✕
                </button>
            </form>

            <!-- Success Icon -->
            <div class="flex justify-center">
                <div
                    class="bg-green-100 text-green-600 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-4">
                    ✅
                </div>
            </div>

            <!-- Title -->
            <h3 class="text-center text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                Hi, Selamat Datang!
            </h3>

            <!-- Description -->
            <p class="text-center text-gray-600 dark:text-gray-300 mb-4">
                Anda berhasil mengisi kehadiran di pustaka. Terima kasih telah datang!
            </p>

            <!-- Optional: Additional Info -->
            <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                Waktu kehadiran: <span id="visit_time">{{ now()->format('H:i') }}</span>
            </div>
        </div>
    </dialog>

    <dialog id="barcode_gagal" class="modal">
        <div class="modal-box relative p-6 bg-white dark:bg-gray-800 rounded-xl shadow-xl animate-fadeIn">
            <!-- Close Button -->
            <form method="dialog">
                <button
                    class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-200">
                    ✕
                </button>
            </form>

            <!-- Success Icon -->
            <div class="flex justify-center">
                <div
                    class="bg-red-100 text-red-600 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-4">
                    ❌
                </div>
            </div>

            <!-- Title -->
            <h3 class="text-center text-xl font-semibold text-red-700 dark:text-red-300 mb-2">
                Kartu Anggota Tidak Dikenal
            </h3>

            <!-- Description -->
            <p class="text-center text-gray-600 dark:text-gray-300 mb-4">
                Kartu anggota tidak dikenal. Silakan periksa kembali kartu Anda.
            </p>
        </div>
    </dialog>

    @fluxScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Echo.channel('visitors')
                .listen('.visitor.created', (e) => {
                    const modal = document.getElementById('welcome_modal');
                    if (modal) {
                        modal.showModal();

                        // Auto close after 5 seconds
                        setTimeout(() => {
                            modal.close();
                        }, 5000);
                    }
                });
        });
        document.addEventListener('livewire:init', () => {
            Livewire.on('openWelcomeModal', () => {
                const modal = document.getElementById('welcome_modal');
                if (modal) {
                    modal.showModal();

                    // Auto close after 5 seconds
                    setTimeout(() => {
                        modal.close();
                    }, 5000);
                }
            });

            Livewire.on('openBarcodeGagalModal', () => {
                const modal = document.getElementById('barcode_gagal');
                if (modal) {
                    modal.showModal();
                    setTimeout(() => {
                        modal.close();
                    }, 5000);
                }
            });
        });
    </script>
</body>

</html>
