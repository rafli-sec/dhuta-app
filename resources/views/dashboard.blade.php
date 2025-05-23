<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight mb-4">
            {{ __('Dashboard Antrian') }}
        </h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <input
                id="search"
                type="text"
                placeholder="Cari nama pelanggan..."
                class="w-full sm:w-1/3 px-4 py-2 rounded shadow-sm border-[#00000023] focus:ring-[#2196F3] focus:border-[#2196F3]"
                autocomplete="off"
            >
        </div>

        <!-- Status Antrian tetap statis -->
        <div class="flex flex-wrap sm:flex-nowrap justify-between sm:space-x-4 mb-6">
            <div class="bg-yellow-400 text-black p-4 sm:p-7 rounded-lg w-full sm:w-1/4 text-sm sm:text-lg">
                <span class="font-bold">{{ $status_dalam_antrian }}</span>
                <span>: Dalam Antrian</span>
            </div>
            <div class="bg-blue-500 text-white p-4 sm:p-7 rounded-lg w-full sm:w-1/4 text-sm sm:text-lg">
                <span class="font-bold">{{ $status_dikerjakan }}</span>
                <span>: Dikerjakan</span>
            </div>
            <div class="bg-green-500 text-white p-4 sm:p-7 rounded-lg w-full sm:w-1/4 text-sm sm:text-lg">
                <span class="font-bold">{{ $status_selesai }}</span>
                <span>: Selesai</span>
            </div>
            <div class="bg-white text-black p-4 sm:p-7 rounded-lg w-full sm:w-1/4 text-sm sm:text-lg">
                <span>Total Hari Ini</span>
                <span class="font-bold">Rp. {{ number_format($total_hari_ini, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-lg rounded-lg text-center" id="antrian-table">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">No WA</th>
                        <th class="px-4 py-2">Kendaraan</th>
                        <th class="px-4 py-2">No Plat</th>
                        <th class="px-4 py-2">Karyawan</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Layanan</th>
                        <th class="px-4 py-2">Waktu/Tgl</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="antrian-table-body">
                    @foreach($antrians as $antrian)
                        <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-2 py-2">{{ $antrian->nomor_antrian }}</td>
                            <td class="px-2 py-2">{{ $antrian->nama_pelanggan }}</td>
                            <td class="px-2 py-2">{{ $antrian->no_wa }}</td>
                            <td class="px-2 py-2">{{ $antrian->jenis_mobil }}</td>
                            <td class="px-2 py-2">{{ $antrian->nomor_plat }}</td>
                            <td class="px-2 py-2">{{ $antrian->karyawan->nama ?? '-' }}</td>
                            <td class="px-2 py-2">Rp{{ number_format($antrian->harga, 0, ',', '.') }}</td>
                            <td class="px-2 py-2">{{ $antrian->jenis_layanan }}</td>
                            <td class="px-1 py-1">{{ $antrian->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-2 py-2">
                                <form action="{{ route('antrian.updateStatus', $antrian->id_antrian) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-4 py-1 rounded
                                        @if (strtolower($antrian->status) == 'antrian') bg-yellow-400
                                        @elseif (strtolower($antrian->status) == 'dikerjakan') bg-blue-500 text-white
                                        @elseif (strtolower($antrian->status) == 'selesai') bg-green-500 text-white
                                        @endif">
                                        <option value="antrian" {{ strtolower($antrian->status) == 'antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                                        <option value="dikerjakan" {{ strtolower($antrian->status) == 'dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                                        <option value="selesai" {{ strtolower($antrian->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-2 py-2">
                                <a href="{{ route('antrian.edit', $antrian->id_antrian) }}" class="text-blue-600 ml-4">Edit</a>
                                <form action="{{ route('antrian.destroy', $antrian->id_antrian) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function(){
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
            $('#search').on('keyup', function(){
                const query = $(this).val();
        
                $.ajax({
                    url: "{{ route('antrian.search') }}",
                    method: 'GET',
                    data: { query: query },
                    success: function(data){
                        const tbody = $('#antrian-table-body');
                        tbody.empty();
        
                        if(data.length === 0){
                            tbody.append('<tr><td colspan="11" class="py-4">Tidak ada data ditemukan.</td></tr>');
                            return;
                        }
        
                        data.forEach(function(antrian, index){
                            let statusColor = '';
                            switch((antrian.status || '').toLowerCase()){
                                case 'antrian':
                                    statusColor = 'bg-yellow-400';
                                    break;
                                case 'dikerjakan':
                                    statusColor = 'bg-blue-500 text-white';
                                    break;
                                case 'selesai':
                                    statusColor = 'bg-green-500 text-white';
                                    break;
                                default:
                                    statusColor = '';
                            }
        
                            let row = `
                                <tr class="${index % 2 === 0 ? 'bg-white' : 'bg-gray-100'}">
                                    <td class="px-2 py-2">${antrian.nomor_antrian ?? ''}</td>
                                    <td class="px-2 py-2">${antrian.nama_pelanggan ?? '-'}</td>
                                    <td class="px-2 py-2">${antrian.no_wa || '-'}</td>
                                    <td class="px-2 py-2">${antrian.jenis_mobil ?? '-'}</td>
                                    <td class="px-2 py-2">${antrian.nomor_plat || '-'}</td>
                                    <td class="px-2 py-2">${antrian.karyawan ? antrian.karyawan.nama : '-'}</td>
                                    <td class="px-2 py-2">Rp${Number(antrian.harga || 0).toLocaleString('id-ID')}</td>
                                    <td class="px-2 py-2">${antrian.jenis_layanan ?? '-'}</td>
                                    <td class="px-2 py-2">${new Date(antrian.created_at).toLocaleString('id-ID')}</td>
                                    <td class="px-2 py-2">
                                        <form action="/antrian/${antrian.id_antrian}/updateStatus" method="POST">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <input type="hidden" name="_method" value="PATCH">
                                            <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded ${statusColor}">
                                                <option value="antrian" ${ (antrian.status || '').toLowerCase() === 'antrian' ? 'selected' : '' }>Dalam Antrian</option>
                                                <option value="dikerjakan" ${ (antrian.status || '').toLowerCase() === 'dikerjakan' ? 'selected' : '' }>Dikerjakan</option>
                                                <option value="selesai" ${ (antrian.status || '').toLowerCase() === 'selesai' ? 'selected' : '' }>Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-2 py-2">
                                        <a href="/antrian/${antrian.id_antrian}/edit" class="text-blue-600 ml-4">Edit</a>
                                        <form action="/antrian/${antrian.id_antrian}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Yakin ingin hapus data ini?');">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
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
