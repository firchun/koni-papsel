<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONI PAPUA SELATAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }
    </style>
</head>

<body class="relative">
    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ asset('img/bg-koni.jpeg') }}'); z-index: -1;"></div>

    <!-- Navbar -->
    <div class="w-full px-6 py-4 flex justify-between items-center ">
        <div class="text-xl font-bold"><span class="text-black p-1 bg-yellow-400">KONI</span><i><span class="text-white">
                    PAPUA
                    SELATAN</span></i></div>
        @guest
            <a href="{{ route('login') }}" class="bg-transparent border border-white px-6 py-2 rounded text-white">Login
            </a>
        @else
            <a href="{{ url('/home') }}" class="bg-transparent border border-white px-6 py-2 rounded text-white">Dashboard
            </a>
        @endguest
    </div>

    <!-- Hero Text -->
    <div class="text-white text-center mt-20">
        <img src="{{ asset('img/koni_papsel.png') }}" alt="KONI Papua Selatan Logo"
            class="mx-auto mb-6 w-auto h-[150px]">
        <h1 class="text-lg md:text-5xl font-bold">Sistem Informasi Pendaftaran Atlit<br> <i>KONI PAPUA SELATAN</i></h1>
        <p class="mt-4 text-md sm:text-lg">Anda dapat cek pendaftaran atlet dan pelatih di sini..</p>

    </div>

    <!-- Bottom Blur Section -->
    <div id="blurSection"
        class="absolute bottom-0 w-full bg-white/10 backdrop-blur-md transition-all duration-500 overflow-hidden"
        style="height: 120px;">
        <div class="flex justify-center items-center h-full">
            <button id="expandButton" class="bg-black text-white px-4 py-3  shadow">
                Lihat Data
            </button>
        </div>
    </div>

    <!-- Search Form -->
    <div id="searchForm"
        class="hidden absolute inset-0 bg-white/20 backdrop-blur-md flex flex-col justify-center items-center transition-all duration-500 z-50">
        <img src="{{ asset('img/koni_papsel.png') }}" alt="KONI Papua Selatan Logo"
            class="mx-auto mb-6 w-auto h-[150px] transition-all duration-300">
        <input type="text" placeholder="NIK KK/ NIK KTP"
            class="w-3/4 md:w-1/2 p-3 rounded border border-gray-300 transition-all duration-300">

        <div class="mt-4 flex space-x-4">
            <button class="px-6 py-2 bg-black text-white rounded">Cari</button>
            <button id="cancelSearch" class="px-6 py-2 bg-red-500 text-white rounded">Batal</button>
        </div>
    </div>

    <script>
        const blurSection = document.getElementById('blurSection');
        const searchForm = document.getElementById('searchForm');
        const expandButton = document.getElementById('expandButton');
        const cancelSearchBtn = document.getElementById('cancelSearch');

        expandButton.addEventListener('click', () => {
            blurSection.style.height = '100%';
            setTimeout(() => {
                searchForm.classList.remove('hidden');
                blurSection.classList.add('hidden');
            }, 700); // sync with transition
        });

        cancelSearchBtn.addEventListener('click', () => {
            searchForm.classList.add('hidden');
            blurSection.classList.remove('hidden');
            blurSection.style.height = '100px'; // kembalikan ke tinggi awal
        });
    </script>
</body>

</html>
