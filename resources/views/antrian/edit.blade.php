<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Antrian</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-5">
        <form action="{{ route('antrian.update', $antrian->id_antrian) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nomor Antrian -->
            <div class="mb-4">
                <label for="nomor_antrian" class="block text-sm font-medium text-gray-700">Nomor Antrian</label>
                <input type="text" id="nomor_antrian" name="nomor_antrian" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" value="{{ $antrian->nomor_antrian }}" required readonly>
            </div>

            <!-- Nama Pelanggan -->
            <div class="mb-4">
                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" value="{{ $antrian->nama_pelanggan }}" required>
            </div>

            <!-- No WA -->
            <div class="mb-4">
                <label for="no_wa" class="block text-sm font-medium text-gray-700">No WA</label>
                <input type="text" id="no_wa" name="no_wa" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" value="{{ $antrian->no_wa }}" required>
            </div>

            <!-- Jenis Mobil -->
            <div class="mb-4">
                <label for="jenis_mobil" class="block text-sm font-medium text-gray-700">Jenis Mobil</label>
                <input type="text" id="jenis_mobil" name="jenis_mobil" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" value="{{ $antrian->jenis_mobil }}" required>
            </div>

            <!--  nomor_plat -->
            <div class="mb-4">
                <label for="nomor_plat" class="block text-sm font-medium text-gray-700">Nomor Plat</label>
                <input type="text" id="nomor_plat" name="nomor_plat" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" value="{{ $antrian->nomor_plat }}" required>
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" value="{{ $antrian->harga }}" required>
            </div>

            <!-- Jenis Layanan -->
            <select id="jenis_layanan" name="jenis_layanan" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
                <option value="Cuci Full" {{ $antrian->jenis_layanan == 'Cuci Full' ? 'selected' : '' }}>Cuci Full</option>
                <option value="Cuci Body + Interior" {{ $antrian->jenis_layanan == 'Cuci Body + Interior' ? 'selected' : '' }}>Cuci Body + Interior</option>
                <option value="Cuci Body Saja" {{ $antrian->jenis_layanan == 'Cuci Body Saja' ? 'selected' : '' }}>Cuci Body Saja</option>
            </select>
            
            
            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
                    <option value="antrian" {{ $antrian->status == 'antrian' ? 'selected' : '' }}>Antrian</option>
                    <option value="dikerjakan" {{ $antrian->status == 'dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                    <option value="selesai" {{ $antrian->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <!-- Karyawan -->
            <div class="mb-4">
                <label for="karyawan_id" class="block text-sm font-medium text-gray-700">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id_karyawan }}" {{ $karyawan->id_karyawan == $antrian->karyawan_id ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end mt-5">
                {{-- <a href="{{ route('antrian.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</a> --}}
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg mr-2">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
