<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
   <!-- Favicon -->
   <link rel="icon" 
   href="{{ asset('images/favicon.ico') }}" 
   type="image/x-icon">

  <!-- Jika pakai PNG -->
  <link rel="icon" 
    href="{{ asset('images/favicon.png') }}" 
    type="image/png">

  <!-- Optional: shortcut icon -->
  <link rel="shortcut icon" 
   href="{{ asset('images/favicon.ico') }}" 
   type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dhuta Car Wash</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }
    #navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 50;
      background-color: rgba(255, 255, 255, 0.079);
      box-shadow: 0 1px 7px rgb(0 0 0 / 0.08);
      backdrop-filter: blur(8px);
    }
    html { scroll-behavior: smooth; }
    .section-title {
      position: relative;
      display: inline-block;
    }
    .section-title:after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 50px;
      height: 3px;
      background: #3b82f6;
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Navbar -->
  <nav id="navbar" class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/logo.png') }}" alt="Logo Dhuta Car Wash" class="w-15 h-10">
      <span class="font-bold text-2xl text-blue-600">DHUTA</span>
      <span class="font-bold text-2xl text-gray-800">CAR WASH</span>
    </div>
    <ul class="hidden md:flex space-x-8 font-medium">
      <li><a href="#home" class="hover:text-blue-600 transition">HOME</a></li>
      <li><a href="#about" class="hover:text-blue-600 transition">ABOUT</a></li>
      <li><a href="#services" class="hover:text-blue-600 transition">SERVICES</a></li>
      <li><a href="#faq" class="hover:text-blue-600 transition">FAQ</a></li>
      <li><a href="#contact" class="hover:text-blue-600 transition">CONTACT</a></li>
      <li><a href="{{ url('/pelanggan') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">QUEUE</a></li>
    </ul>

    <!-- Mobile menu button -->
    <button id="btn-menu" class="md:hidden focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
      </svg>
    </button>
  </nav>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden fixed top-16 left-0 right-0 bg-white shadow-md z-40 md:hidden">
    <ul class="flex flex-col space-y-2 p-4 font-medium text-gray-800">
      <li><a href="#home" class="block py-2 hover:bg-blue-50 rounded">HOME</a></li>
      <li><a href="#about" class="block py-2 hover:bg-blue-50 rounded">ABOUT</a></li>
      <li><a href="#services" class="block py-2 hover:bg-blue-50 rounded">SERVICES</a></li>
      <li><a href="#faq" class="block py-2 hover:bg-blue-50 rounded">FAQ</a></li>
      <li><a href="#contact" class="block py-2 hover:bg-blue-50 rounded">CONTACT</a></li>
      <li><li>
        <a href="{{ route('pelanggan') }}"
           class="block bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-center">
          LIAT ANTRIAN
        </a>
      </li>
      </li>
    

    </ul>
  </div>

  <main class="max-w-7xl mx-auto px-6 pt-24">

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex flex-col md:flex-row items-center justify-between py-16 gap-10">
      <div class="md:w-1/2 space-y-8">
        <div class="space-y-4">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
            <span class="text-blue-600">WELCOME TO</span><br>
            <span class="text-gray-800">DHUTA CAR WASH</span>
          </h1>
          <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
            Kami rela lemas asal anda puas
          </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="{{ route('pelanggan') }}"><button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg transition-all font-semibold text-lg shadow-lg">
            Lihat Antrian
          </button>
        </a>
        </div>
      </div>
      <div class="md:w-1/2 mt-8 md:mt-0">
        <img src="{{ asset('images/dhutcarwash.jpg') }}" alt="Car Wash" class="w-full rounded-lg shadow-xl" />
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white rounded-xl shadow-sm">
      <div class="text-center mb-16">
        <h2 class="section-title text-3xl font-bold text-gray-800 inline-block">TENTANG LAYANAN KAMI</h2>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-gray-50 p-8 rounded-lg">
          <h3 class="text-xl font-bold text-blue-600 mb-4">PENGALAMAN PELANGGAN BARU</h3>
          <p class="text-gray-600">Pelanggan dapat melihat status antrian secara real-time dan menerima notifikasi ketika giliran antrian sudah hampir tiba atau mobil sudah siap dicuci. Fitur ini memudahkan pelanggan dalam menitipkan mobil dan menghemat waktu tunggu.</p>
        </div>
        
        <div class="bg-gray-50 p-8 rounded-lg">
          <h3 class="text-xl font-bold text-blue-600 mb-4">BISNIS UNGGUL</h3>
          <p class="text-gray-600">Menyediakan produk premium dan bahan berkualitas tinggi untuk memberikan perlindungan dan kilau tahan lama pada kendaraan pelanggan.</p>
        </div>
        
        <div class="bg-gray-50 p-8 rounded-lg">
          <h3 class="text-xl font-bold text-blue-600 mb-4">SOLUSI BISNIS</h3>
          <p class="text-gray-600">Menawarkan paket perawatan kendaraan untuk perusahaan dan armada dengan jadwal yang fleksibel sesuai kebutuhan bisnis.</p>
        </div>
      </div>
    </section>
    

    <!-- Elevate Section -->
    <section class="py-20">
      <div class="bg-blue-600 text-white rounded-xl p-12 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Dhuta Car Wash</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Adalah pilihan terbaik untuk menjaga kendaraan Anda tetap bersih, terlindungi, dan tampil menawan. Kami menyediakan layanan yang ramah, cepat, dan terpercaya, serta menjamin kepuasan pelanggan yang selalu kembali.</p>
        {{-- <button class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-100 transition">
          SEE PACKAGES
        </button> --}}
      </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-white rounded-xl shadow-sm">
      <div class="text-center mb-16">
        <h2 class="section-title text-3xl font-bold text-gray-800 inline-block">PERTANYAAN YANG SERING DIAJUKAN</h2>
      </div>
      
      <div class="max-w-3xl mx-auto space-y-6">
        <div class="border-b pb-6">
          <h3 class="text-xl font-bold text-blue-600 mb-2">APA YANG MEMBUAT KAMI BERBEDA?</h3>
          <p class="text-gray-600">We use eco-friendly products and advanced technology to deliver superior results without compromising the environment.</p>
        </div>
        
        <div class="border-b pb-6">
          <h3 class="text-xl font-bold text-blue-600 mb-2">MISI KAMI</h3>
          <p class="text-gray-600">To provide exceptional car care services that exceed customer expectations through innovation and quality.</p>
        </div>
        
        <div class="border-b pb-6">
          <h3 class="text-xl font-bold text-blue-600 mb-2">NILAI-NILAI KAMI</h3>
          <p class="text-gray-600">Customer satisfaction, environmental responsibility, and continuous improvement drive everything we do.</p>
        </div>
      </div>
    </section>

    
    <!-- Locations Section -->
<section class="py-20">
  <div class="text-center mb-8"> <!-- Mengurangi margin bawah pada judul -->
    <h2 class="section-title text-3xl font-bold text-gray-800 inline-block">LOKASI KAMI</h2>
  </div>
  
  <section class="flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-sm"> <!-- Mengurangi padding pada container iframe -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.9397729949783!2d122.46776997465322!3d-4.032712495941019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d988c5d9c35792b%3A0xd7588eb139dfa631!2sDhuta%20Car%20Wash!5e0!3m2!1sen!2sid!4v1747399619861!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>
</section>

    

    <!-- Experience Section -->
    <section class="py-20 bg-blue-600 text-white rounded-xl">
      <div class="text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">RASAKAN PERBEDAANNYA</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
          Bergabunglah dengan ribuan pelanggan yang merasa puas dan mempercayakan perawatan kendaraan mereka kepada Dhuta Car Wash..</p>
          <a href="https://wa.me/6281241974732" target="_blank">
            <button class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-100 transition">
              CONTACT US
            </button>
          </a>
          
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20">
      <div class="bg-white rounded-xl shadow-sm p-12">
        <div class="text-center mb-16">
          <h2 class="section-title text-3xl font-bold text-gray-800 inline-block">GET IN TOUCH</h2>
        </div>
        
        <form class="max-w-2xl mx-auto space-y-6">
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block font-medium mb-2 text-gray-700">Name</label>
              <input type="text" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div>
              <label for="email" class="block font-medium mb-2 text-gray-700">Email</label>
              <input type="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
          </div>
          
          <div>
            <label for="subject" class="block font-medium mb-2 text-gray-700">Subject</label>
            <input type="text" id="subject" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300">
          </div>
          
          <div>
            <label for="message" class="block font-medium mb-2 text-gray-700">Message</label>
            <textarea id="message" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"></textarea>
          </div>
          
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold text-lg w-full">
            SEND MESSAGE
          </button>
        </form>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <h3 class="text-2xl font-bold mb-4">
            <span class="text-blue-400">DHUTA</span>
            <span>CAR WASH</span>
          </h3>
          <p class="text-gray-400">Premium car care services with exceptional quality and customer experience.</p>
        </div>
        
        <div>
          <h4 class="text-lg font-semibold mb-4">QUICK LINKS</h4>
          <ul class="space-y-2">
            <li><a href="#home" class="text-gray-400 hover:text-white transition">Home</a></li>
            <li><a href="#about" class="text-gray-400 hover:text-white transition">About</a></li>
            <li><a href="#services" class="text-gray-400 hover:text-white transition">Services</a></li>
            <li><a href="#contact" class="text-gray-400 hover:text-white transition">Contact</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="text-lg font-semibold mb-4">SERVICES</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition">Exterior Wash</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Interior Detailing</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Premium Packages</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Fleet Services</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="text-lg font-semibold mb-4">CONTACT US</h4>
          <ul class="space-y-2">
            <li class="text-gray-400">123 Car Care Ave, Jakarta</li>
            <li class="text-gray-400">hello@dhutacarwash.com</li>
            <li class="text-gray-400">+62 812-4197-4732</li>
          </ul>
        </div>
      </div>
      
      <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
        <p>© 2025 Dhuta Car Wash. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    const btnMenu = document.getElementById('btn-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    btnMenu.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  </script>

</body>
</html>