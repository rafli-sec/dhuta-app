<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight mb-4">
            {{ __('Riwayat Antrian') }}
        </h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tombol Salin & Export sejajar -->
        <div class="mb-6 flex space-x-4">
            {{-- <form method="POST" action="{{ route('riwayats.salin') }}">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Salin Data Antrian Selesai ke riwayats
                </button>
            </form> --}}

            <a href="{{ route('riwayats.export') }}" 
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Export Data Riwayat ke Excel
            </a>
        </div>

        <!-- Filter Section dalam satu form -->
        <form method="GET" action="{{ route('riwayats.index') }}" class="mb-6 flex flex-wrap items-end gap-4">
            <input
                id="search"
                name="search"
                type="text"
                placeholder="Cari Nama Pelanggan..."
                value="{{ request('search') }}"
                class="border rounded px-4 py-2 w-full md:w-1/3"
                autocomplete="off"
            />

            <input
                type="date"
                name="tanggal_mulai"
                value="{{ request('tanggal_mulai') }}"
                class="border rounded px-4 py-2"
            />

            <input
                type="date"
                name="tanggal_selesai"
                value="{{ request('tanggal_selesai') }}"
                class="border rounded px-4 py-2"
            />

            <select name="karyawan_id" class="border rounded px-4 py-2 w-full md:w-1/4">
                <option value="">Pilih Karyawan</option>
                @foreach($karyawans as $karyawan)
                    <option value="{{ $karyawan->id_karyawan }}" {{ request('karyawan_id') == $karyawan->id_karyawan ? 'selected' : '' }}>
                        {{ $karyawan->nama }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Filter
            </button>

            <a href="{{ route('riwayats.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                Reset Filter
            </a>
        </form>

        <!-- Tabel Riwayat -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-lg rounded-lg text-center" id="riwayats-table">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">ID Antrian</th>
                        <th class="px-4 py-2">Nama Pelanggan</th>
                        <th class="px-4 py-2">Jenis Kendaraan</th>
                        <th class="px-4 py-2">No Plat</th>
                        <th class="px-4 py-2">No WA</th>
                        <th class="px-4 py-2">Karyawan</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Jenis Layanan</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Waktu Datang-Selesai</th>
                    </tr>
                </thead>
                <tbody id="riwayats-table-body">
                    @forelse($riwayats as $riwayat)
                        <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-4 py-2">
                                {{ $loop->iteration + ($riwayats->currentPage() - 1) * $riwayats->perPage() }}
                            </td>
                            <td class="px-3 py-2">{{ $riwayat->id_antrian ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $riwayat->nama_pelanggan }}</td>
                            <td class="px-3 py-2">{{ $riwayat->jenis_mobil }}</td>
                            <td class="px-3 py-2">{{ $riwayat->nomor_plat }}</td>
                            <td class="px-3 py-2">{{ $riwayat->no_wa }}</td>
                            <td class="px-3 py-2">{{ $riwayat->karyawan->nama ?? '-' }}</td>
                            <td class="px-3 py-2"> Rp. {{ number_format($riwayat->harga, 0, ',', '.') }}</td>
                            <td class="px-3 py-2">{{ $riwayat->jenis_layanan  }}</td>
                            <td class="px-3 py-2">{{ $riwayat->status  }}</td>
                            <td class="px-3 py-2">
                                {{ $riwayat->created_at->format('d/m/Y H:i') }}
                                @if($riwayat->updated_at && $riwayat->updated_at != $riwayat->created_at)
                                    <br>
                                    <small>(Waktu Selesai: {{ $riwayat->updated_at->format('H:i') }})</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-3">Tidak ada data riwayats</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $riwayats->withQueryString()->links() }}
        </div>
    </div>

    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('riwayats.search') }}",
                    method: 'GET',
                    data: { query: query },
                    success: function(data){
                        const tbody = $('#riwayats-table-body');
                        tbody.empty();

                        if(data.length === 0){
                            tbody.append('<tr><td colspan="10" class="py-4">Tidak ada data ditemukan.</td></tr>');
                            return;
                        }

                        $.each(data, function(index, riwayat){
                            let row = `
                                <tr class="${index % 2 === 0 ? 'bg-white' : 'bg-gray-100'}">
                                    <td class="px-4 py-2">${index + 1}</td>
                                    <td class="px-4 py-2">${riwayat.id_antrian ?? '-'}</td>
                                    <td class="px-4 py-2">${riwayat.nama_pelanggan}</td>
                                    <td class="px-4 py-2">${riwayat.jenis_mobil}</td>
                                    <td class="px-4 py-2">${riwayat.nomor_plat ?? '-'}</td>
                                    <td class="px-4 py-2">${riwayat.no_wa}</td>
                                    <td class="px-4 py-2">${riwayat.karyawan ? riwayat.karyawan.nama : '-'}</td>
                                    <td class="px-4 py-2">Rp. ${Number(riwayat.harga).toLocaleString('id-ID')}</td>
                                    <td class="px-4 py-2">${riwayat.status.charAt(0).toUpperCase() + riwayat.status.slice(1)}</td>
                                    <td class="px-4 py-2">${new Date(riwayat.created_at).toLocaleString('id-ID')}</td>
                                </tr>
                            `;
                            tbody.append(row);
                        });
                    },
                    error: function(xhr, status, error){
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
</x-app-layout>
