<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Antrian Dhuta Car Wash</title>
        <meta http-equiv="refresh" content="30">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
          .brand-header {
            background: #1e40af;
            background: linear-gradient(to right, #1e3a8a, #1d4ed8);
          }
          .status-chip {
            min-width: 90px;
            text-align: center;
          }
        </style>
      </head>
      
<body class="bg-gray-50">
  <!-- Header -->
  <header class="brand-header text-white py-4 shadow-md">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto">
        <h1 class="text-xl text-center font-semibold tracking-wide">
          <div class="text-sm opacity-90 mb-1">WELCOME TO</div>
          DHUTA CAR WASH
        </h1>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Queue Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <h2 class="px-6 py-4 border-b border-gray-200 font-semibold text-gray-700">
        STATUS ANTRIAN
      </h2>
      
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 text-gray-600">
            <tr>
              <th class="px-4 py-3 text-left text-sm">No</th>
              <th class="px-4 py-3 text-left text-sm">Jenis Kendaraan</th>
              <th class="px-4 py-3 text-left text-sm">No Plat</th>
              <th class="px-4 py-3 text-left text-sm">Karyawan</th>
              <th class="px-4 py-3 text-left text-sm">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($antrians as $i => $antrian)
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-600">{{ $i+1 }}</td>
                <td class="px-4 py-3 font-medium">{{ $antrian->jenis_kendaraan }}</td>
                <td class="px-4 py-3 font-mono text-blue-600">{{ $antrian->nomor_plat }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $antrian->karyawan->nama ?? '-' }}</td>
                <td class="px-4 py-3">
                  @php
                    $statusConfig = [
                      'antrian' => 'bg-blue-100 text-blue-800',
                      'dikerjakan' => 'bg-amber-100 text-amber-800',
                      'selesai' => 'bg-green-100 text-green-800'
                    ];
                    $style = $statusConfig[$antrian->status] ?? 'bg-gray-100 text-gray-800';
                  @endphp
                  <span class="status-chip px-3 py-1 rounded-full text-sm {{ $style }}">
                    {{ ucfirst($antrian->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                  Tidak ada antrian
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Refresh Info -->
    <p class="text-center text-sm text-gray-500 mt-4">
      Halaman diperbarui otomatis setiap 30 detik
    </p>
  </main>

  <!-- Footer -->
  <footer class="border-t border-gray-200 mt-8 py-6 bg-white">
    <div class="container mx-auto px-4 text-center text-sm text-gray-600">
      <p class="mb-2">© 2023 Dhuta Car Wash</p>
      <p>
        For personal use only • 
        <a href="https://www.facebook.com/whitepaper/whitepaper" class="text-blue-600 hover:underline">
          Visit our Facebook
        </a>
      </p>
    </div>
  </footer>
</body>
</html>