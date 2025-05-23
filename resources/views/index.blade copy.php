<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dhuta Car Wash</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    #navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 50;
      background-color: #f9fcffd4; /* putih sedikit abu */
      box-shadow: 0 1px 7px rgb(0 0 0 / 0.08);
    }
    html { scroll-behavior: smooth; }
    body {
      background-color: #a0b9d2; /* putih sedikit abu */
      
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
  </style>
</head>
<body class="bg-white text-blue-800">

  <!-- Navbar -->
  <nav id="navbar" class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
    <div class="flex items-center space-x-3">
      {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo Dhuta Car Wash" class="w-10 h-10"> --}}
      <span class="font-bold text-xl text-blue-800">Dhuta Car Wash</span>
    </div>
    <ul class="hidden md:flex space-x-8 text-white-800 font-semibold">
      <li><a href="#home" class="hover:text-white-600 transition">Beranda</a></li>
      <li><a href="#about" class="hover:text-white-600 transition">Tentang</a></li>
      <li><a href="#services" class="hover:text-white-600 transition">Layanan</a></li>
      <li><a href="#faq" class="hover:text-white-600 transition">FAQ</a></li>
      <li><a href="#contact" class="hover:text-white-600 transition">Kontak</a></li>
      <li><a href="{{ url('/antrian') }}" class="hover:text-white-600 transition">Antrian</a></li>
    </ul>

    <!-- Mobile menu button -->
    <button id="btn-menu" class="md:hidden focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
      </svg>
    </button>
  </nav>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden fixed top-16 left-0 right-0 bg-white shadow-md z-40 md:hidden">
    <ul class="flex flex-col space-y-2 p-4 text-center font-semibold text-blue-800">
      <li><a href="#home" class="block py-2 hover:bg-blue-100 rounded">Beranda</a></li>
      <li><a href="#about" class="block py-2 hover:bg-blue-100 rounded">Tentang</a></li>
      <li><a href="#services" class="block py-2 hover:bg-blue-100 rounded">Layanan</a></li>
      <li><a href="#faq" class="block py-2 hover:bg-blue-100 rounded">FAQ</a></li>
      <li><a href="#contact" class="block py-2 hover:bg-blue-100 rounded">Kontak</a></li>
      <li><button class="w-full bg-blue-200 text-blue-800 py-2 rounded hover:bg-blue-300 transition">Booking Sekarang</button></li>
    </ul>
  </div>

  <main class="max-w-7xl mx-auto px-6">

    <!-- Hero Section (Full screen section) -->
    {{-- <section id="home" class="min-h-screen flex flex-col md:flex-row items-center justify-between py-16 gap-10 ">
      <div class="md:w-1/2 space-y-6 px-6 md:px-0">
        <h1 class="text-3xl md:text-5xl font-extrabold text-blue-900">Selamat Datang di Dhuta Car Wash</h1>
        <p class="text-lg md:text-xl text-blue-700">Rasakan pengalaman cuci mobil tanpa noda dengan layanan terbaik dan teknologi terkini.</p>
        <button class="bg-blue-200 text-blue-900 px-6 py-3 rounded hover:bg-blue-300 transition font-semibold">Booking Sekarang</button>
      </div>
      <div class="md:w-1/2 mt-8 md:mt-0">
        <img src="https://i.ibb.co/JFH9yxL/car-blue-hero.png" alt="Mobil Cuci" class="w-full rounded-lg shadow-md" />
      </div>
    </section> --}}<!-- Hero Section (Full screen section) -->
<section id="home" class="min-h-[90vh] md:min-h-screen flex flex-col md:flex-row items-center justify-center md:justify-between py-12 md:py-24 px-6 gap-8 md:gap-16 bg-gradient-to-br from-blue-50 to-white">
  <div class="w-full md:w-1/2 space-y-6 md:space-y-8 max-w-2xl">
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-blue-900">
      <span class="block text-3xl md:text-4xl font-semibold text-blue-600 mb-2">Selamat Datang di</span>
      Dhuta Car Wash
    </h1>
    <p class="text-lg md:text-xl lg:text-2xl text-blue-700 leading-relaxed">
      Rasakan pengalaman cuci mobil tanpa noda dengan layanan terbaik dan teknologi terkini.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 pt-4">
      <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg transition-all duration-300 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1">
        Booking Sekarang
      </button>
      <button class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-8 py-4 rounded-lg transition-all duration-300 font-semibold text-lg">
        Lihat Layanan
      </button>
    </div>
  </div>
  <div class="w-full md:w-1/2 mt-8 md:mt-0 flex justify-center">
    <img 
      src="https://i.ibb.co/JFH9yxL/car-blue-hero.png" 
      alt="Mobil Cuci" 
      class="w-full max-w-xl rounded-lg shadow-xl transform hover:scale-105 transition-transform duration-500" 
    />
  </div>
</section>

    <!-- Tentang Kami (Full screen section) -->
    <section id="about" class="min-h-screen flex flex-col md:flex-row items-center justify-between py-16 gap-10 bg-white rounded-lg shadow-sm bg-blue-50">
      <div class="md:w-1/2 space-y-6 px-6 md:px-0">
        <h2 class="text-3xl font-bold text-blue-900">Tentang Dhuta Car Wash</h2>
        <p class="text-blue-700 text-justify">
          Di Dhuta Car Wash, kami memberikan layanan cuci mobil terbaik dengan peralatan modern dan tenaga profesional yang berpengalaman.
          Kami berkomitmen memberikan kepuasan pelanggan dengan hasil yang bersih dan detail. Layanan kami mencakup berbagai paket untuk memenuhi kebutuhan Anda.
        </p>
        <button class="bg-blue-200 text-blue-900 px-5 py-2 rounded hover:bg-blue-300 transition font-semibold">Pelajari Lebih Lanjut</button>
      </div>
      <div class="md:w-1/2">
        <img src="https://i.ibb.co/bsR5SP3/car-about.png" alt="Mobil Tentang Kami" class="w-full rounded-lg shadow-md" />
      </div>
    </section>

    <!-- Layanan (Full screen section) -->
    <section id="services" class="min-h-screen py-16">
      <h2 class="text-3xl font-bold text-blue-900 mb-6">Layanan Kami</h2>
      <p class="text-blue-700 mb-10 max-w-3xl mx-auto">
        Dari cuci mobil dasar hingga detailing lengkap, kami menyediakan berbagai paket untuk memenuhi kebutuhan perawatan mobil Anda.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg shadow-sm p-6 flex flex-col items-center text-center">
          <img src="https://i.ibb.co/4NgJ0b6/premium-wash.png" alt="Premium Wash" class="w-20 h-20 mb-4" />
          <h3 class="text-xl font-semibold mb-2 text-blue-900">Premium Wash</h3>
          <p class="text-blue-700">Paket detailing lengkap untuk mobil Anda, dengan perhatian detail terbaik.</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 flex flex-col items-center text-center">
          <img src="https://i.ibb.co/ySfXvHY/personalized.png" alt="Personalized Care" class="w-20 h-20 mb-4" />
          <h3 class="text-xl font-semibold mb-2 text-blue-900">Perawatan Personal</h3>
          <p class="text-blue-700">Solusi perawatan khusus sesuai kebutuhan mobil Anda.</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 flex flex-col items-center text-center">
          <img src="https://i.ibb.co/h9b5C5T/express-wash.png" alt="Express Wash" class="w-20 h-20 mb-4" />
          <h3 class="text-xl font-semibold mb-2 text-blue-900">Express Wash</h3>
          <p class="text-blue-700">Cuci cepat dengan hasil maksimal untuk Anda yang sibuk.</p>
        </div>
      </div>
    </section>

    <!-- FAQ (Full screen section) -->
    <section id="faq" class="min-h-screen py-16 bg-white rounded-lg shadow-sm">
      <h2 class="text-3xl font-bold text-blue-900 mb-6">Pertanyaan yang Sering Diajukan (FAQ)</h2>
      <div class="max-w-4xl mx-auto space-y-4">
        <details class="border rounded-md p-4">
          <summary class="cursor-pointer font-semibold text-blue-800">Apakah perlu membuat janji sebelum datang?</summary>
          <p class="mt-2 text-blue-700">Disarankan membuat janji agar pelayanan lebih cepat dan terjadwal.</p>
        </details>
        <details class="border rounded-md p-4">
          <summary class="cursor-pointer font-semibold text-blue-800">Berapa lama waktu cuci mobil?</summary>
          <p class="mt-2 text-blue-700">Waktu cuci standar sekitar 30-45 menit, tergantung paket layanan.</p>
        </details>
        <details class="border rounded-md p-4">
          <summary class="cursor-pointer font-semibold text-blue-800">Apakah ada layanan cuci interior?</summary>
          <p class="mt-2 text-blue-700">Ya, kami menyediakan paket detailing yang mencakup cuci interior dan detailing lengkap.</p>
        </details>
      </div>
    </section>

    <!-- Kontak (Full screen section) -->
    <section id="contact" class="min-h-screen py-16">
      <h2 class="text-3xl font-bold text-blue-900 mb-6">Kontak Kami</h2>
      <form class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-sm space-y-6" onsubmit="return submitForm(event)">
        <div>
          <label for="nama" class="block font-semibold mb-1 text-blue-900">Nama</label>
          <input id="nama" name="nama" type="text" required class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>
        <div>
          <label for="email" class="block font-semibold mb-1 text-blue-900">Email</label>
          <input id="email" name="email" type="email" required class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>
        <div>
          <label for="pesan" class="block font-semibold mb-1 text-blue-900">Pesan</label>
          <textarea id="pesan" name="pesan" rows="4" required class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"></textarea>
        </div>
        <button type="submit" class="bg-blue-200 text-blue-900 px-6 py-3 rounded hover:bg-blue-300 transition font-semibold w-full">
          Kirim Pesan
        </button>
      </form>
    </section>

  </main>

  <footer class="bg-blue-100 text-blue-700 py-8 mt-16">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
      <div class="flex items-center space-x-3">
        <img src="https://i.ibb.co/RjcHfrW/logo-dhuta.png" alt="Dhuta Car Wash Logo" class="w-10 h-10" />
        <p>© 2025 Dhuta Car Wash. All rights reserved.</p>
      </div> 
      <div class="flex space-x-8 text-blue-800 ">
        <div>
          <h3 class="font-bold">Quick Links</h3>
          <ul>
            <li><a href="#home" class="hover:text-blue-600">Home</a></li>
            <li><a href="#about" class="hover:text-blue-600">About</a></li>
            <li><a href="#contact" class="hover:text-blue-600">Contact</a></li>
            <li><a href="#queue" class="hover:text-blue-600">Queue</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold">Our Services</h3>
          <ul>
            <li><a href="#exterior-wash" class="hover:text-blue-600">Exterior Wash</a></li>
            <li><a href="#interior-detailing" class="hover:text-blue-600">Interior Detailing</a></li>
            <li><a href="#full-service" class="hover:text-blue-600">Full Service</a></li>
            <li><a href="#fleet-wash" class="hover:text-blue-600">Fleet Wash</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold">Connect with Us</h3>
          <ul>
            <li><a href="#" class="hover:text-blue-300">Facebook</a></li>
            <li><a href="#" class="hover:text-blue-300">Instagram</a></li>
            <li><a href="#" class="hover:text-blue-300">Twitter</a></li>
            <li><a href="#" class="hover:text-blue-300">LinkedIn</a></li>
          </ul>
        </div>
      </div>
      
    </div>
  </footer>

  <script>
    const btnMenu = document.getElementById('btn-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    btnMenu.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    function submitForm(event) {
      event.preventDefault();
      alert('Terima kasih sudah menghubungi kami! Pesan Anda telah terkirim.');
      event.target.reset();
      return false;
    }
  </script>

</body>
</html>
