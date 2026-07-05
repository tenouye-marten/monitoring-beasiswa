<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold">

                    Riwayat Import Mahasiswa

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Daftar aktivitas import data mahasiswa.

                </p>

            </div>

            <a href="{{ route('admin.mahasiswa.index') }}">

                <x-secondary-button>

                    Kembali

                </x-secondary-button>

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

                    {{ session('success') }}

                </div>

            @endif

            <div class="bg-white rounded-xl border shadow-sm">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-4 py-3 text-left">No</th>

                                <th class="px-4 py-3 text-left">Tanggal</th>

                                <th class="px-4 py-3 text-left">Nama File</th>

                                <th class="px-4 py-3 text-center">Total</th>

                                <th class="px-4 py-3 text-center">Berhasil</th>

                                <th class="px-4 py-3 text-center">Duplikat</th>

                                <th class="px-4 py-3 text-center">Gagal</th>

                                <th class="px-4 py-3 text-left">Petugas</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y">

                            @forelse($logs as $log)

                                <tr>

                                    <td class="px-4 py-3">

                                        {{ $logs->firstItem() + $loop->index }}

                                    </td>

                                    <td class="px-4 py-3">

                                        {{ \Carbon\Carbon::parse($log->tanggal_import)->format('d/m/Y H:i') }}

                                    </td>

                                    <td class="px-4 py-3">

                                        {{ $log->nama_file }}

                                    </td>

                                    <td class="px-4 py-3 text-center">

                                        {{ $log->total_data }}

                                    </td>

                                    <td class="px-4 py-3 text-center text-green-600 font-semibold">

                                        {{ $log->berhasil }}

                                    </td>

                                    <td class="px-4 py-3 text-center text-yellow-600 font-semibold">

                                        {{ $log->duplikat }}

                                    </td>

                                    <td class="px-4 py-3 text-center text-red-600 font-semibold">

                                        {{ $log->gagal }}

                                    </td>

                                    <td class="px-4 py-3">

                                        {{ $log->user->name ?? '-' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="py-10 text-center text-gray-500">

                                        Belum ada riwayat import.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="border-t p-6">

                    {{ $logs->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>