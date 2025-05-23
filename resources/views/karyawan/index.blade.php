<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Halaman Karyawan</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-5">
        <!-- Alert Success -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        <!-- Tambah Karyawan Button -->
        <a href="{{ route('karyawan.create') }}" class="btn btn-warning bg-yellow-500 text-white p-2 rounded-lg mb-4 inline-block">+ Karyawan</a>

        <!-- Tabel Daftar Karyawan -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">No</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Nama</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">No Hp</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Alamat</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $key => $karyawan)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2 text-sm">{{ $key + 1 }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $karyawan->nama }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $karyawan->no_wa }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $karyawan->alamat }}</td>
                            <td class="border px-4 py-2 text-sm">
                                <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" class="text-yellow-500 hover:text-yellow-600">Edit</a>
                                <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
