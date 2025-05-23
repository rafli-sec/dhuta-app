<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Antrian</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-5">
        <form action="{{ route('antrian.store') }}" method="POST">
            @csrf
            <!-- Nama Pelanggan -->
            <div class="mb-3 ">
                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500">
            </div>

            <!-- No WA -->
            <div class="mb-4">
                <label for="no_wa" class="block text-sm font-medium text-gray-700">No WA</label>
                <input type="text" id="no_wa" name="no_wa" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500">
            </div>


            <!-- Jenis Mobil -->
            <div class="mb-4">
                <label for="jenis_mobil" class="block text-sm font-medium text-gray-700">Jenis Kendaran</label>
                <input type="text" id="jenis_mobil" name="jenis_mobil" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
            </div>

            <!-- Tambahkan input untuk nomor_plat -->
            <div class="mb-4">
                <label for="nomor_plat" class="block text-sm font-medium text-gray-700">Nomor Plat</label>
                <input type="text" id="nomor_plat" name="nomor_plat" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500"  required>
            </div>


            <!-- Harga -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
            </div>

            <!-- Jenis Layanan -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="jenis_layanan" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
                    <option value="Cuci Full">Cuci Full</option>
                    <option value="Cuci Body + Interior">Cuci Body + interior</option>
                    <option value="Cuci Body Saja">Cuci Body Saja</option>
                </select>
            </div>

            <!--Status-->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
                    <option value="antrian">Antrian</option>
                    <option value="dikerjakan">Dikerjakan</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <!-- Karyawan -->
            <div class="mb-4">
                <label for="karyawan_id" class="block text-sm font-medium text-gray-700">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" required>
                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end mt-5">
                <a href="{{ route('dashboard') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg">Batal</a>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg mr-2">Tambah</button>
            </div>
        </form>
    </div>
</x-app-layout>
