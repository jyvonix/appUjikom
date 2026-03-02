<x-siswa-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-900 leading-tight">
            Persiapan Ujian 📝
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-indigo-50">
            <div class="bg-indigo-900 p-8 text-white text-center">
                <div class="inline-block p-4 bg-indigo-800 rounded-full mb-4">
                    <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold">Informasi Ujian</h3>
                <p class="mt-2 text-indigo-200 opacity-90 text-sm tracking-wide uppercase">Tahun Ajaran 2025/2026</p>
            </div>
            
            <div class="p-8">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="p-3 bg-white shadow-sm rounded-xl text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Jumlah Soal</p>
                                <p class="text-lg font-black text-gray-800">{{ $soals->count() }} Butir</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="p-3 bg-white shadow-sm rounded-xl text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Standar KKM</p>
                                <p class="text-lg font-black text-gray-800">{{ $kkm }} Poin</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 md:col-span-2">
                            <div class="p-3 bg-white shadow-sm rounded-xl text-amber-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Kesempatan Mengerjakan</p>
                                <p class="text-lg font-black text-gray-800">{{ $total_ujian }} / {{ $max_retakes }} Kali</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-2xl">
                        <h4 class="text-blue-800 font-bold mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Petunjuk Pengerjaan:
                        </h4>
                        <ul class="text-blue-700 text-sm space-y-2 list-disc list-inside opacity-90">
                            <li>Baca setiap soal dengan teliti sebelum menjawab.</li>
                            <li>Pilih salah satu jawaban yang menurut Anda paling benar.</li>
                            <li>Pastikan semua soal sudah terjawab sebelum klik selesai.</li>
                            <li>Skor akan langsung muncul setelah Anda menyelesaikan ujian.</li>
                        </ul>
                    </div>

                    @if($soals->isEmpty())
                        <div class="text-center p-4 bg-yellow-50 text-yellow-700 rounded-xl border border-yellow-200 font-medium">
                            Maaf, saat ini belum ada soal yang tersedia untuk Anda kerjakan.
                        </div>
                    @elseif($sudah_mencapai_batas)
                        <div class="text-center p-6 bg-red-50 text-red-700 rounded-2xl border border-red-100">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m12-3V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2h11l5 5V12z"></path>
                            </svg>
                            <p class="font-black uppercase tracking-wider mb-1">Batas Maksimal Tercapai</p>
                            <p class="text-sm font-bold opacity-80 leading-relaxed">Anda sudah tidak memiliki kesempatan lagi untuk mengulangi ujian ini. Silakan hubungi admin atau guru jika ada kendala.</p>
                        </div>
                    @else
                        <div class="pt-4">
                            <a href="{{ route('siswa.soal.kerjakan') }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-indigo-200 transition duration-300 transform hover:-translate-y-1">
                                Mulai Kerjakan Sekarang 🚀
                            </a>
                            <p class="text-center mt-4 text-xs text-gray-400">Pastikan koneksi internet Anda stabil.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-siswa-layout>
