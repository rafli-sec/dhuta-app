<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Karyawan</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-5">
        <form action="{{ route('karyawan.update', $karyawan->id_karyawan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" id="nama" name="nama" value="{{ $karyawan->nama }}" required>
            </div>

            <div class="mb-4">
                <label for="no_wa" class="block text-sm font-medium text-gray-700">No Hp</label>
                <input type="text" class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" id="no_wa" name="no_wa" value="{{ $karyawan->no_wa }}" required>
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea class="w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500" id="alamat" name="alamat">{{ $karyawan->alamat }}</textarea>
            </div>

            <div class="flex justify-end mt-5">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg mr-2">Update</button>
                <a href="{{ route('karyawan.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
