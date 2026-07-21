@extends('layouts.app')

@section('title', 'Checklist Penyegelan UGB — ' . $perizinan->nomor_izin ?? ('ID #'.$perizinan->id))

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.penyegelan_ugb.index') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Daftar Penyegelan
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">SOP Penyegelan Alat Undian UGB (8 Langkah)</h1>
        <p class="text-sm text-slate-500 mt-1">
            Penyelenggara: <span class="font-semibold text-emerald-700">{{ $perizinan->nama_penyelenggara }}</span>
            &mdash; Izin: {{ $perizinan->nomor_izin ?? ('#' . $perizinan->id) }}
        </p>
    </div>

    <!-- Progress Bar -->
    @php
        $progress = $penyegelan ? $penyegelan->progress : 0;
    @endphp
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mb-8">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Progress Penyegelan</span>
            <span class="text-sm font-extrabold text-emerald-600">{{ $progress }}%</span>
        </div>
        <div class="w-full bg-slate-100 rounded-full h-3">
            <div class="bg-gradient-to-r from-emerald-400 to-teal-500 h-3 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
        </div>
    </div>

    <form action="{{ route('admin.penyegelan_ugb.store', $perizinan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @php
            $saksi = $penyegelan->saksi ?? [['nama' => '', 'jabatan' => '', 'instansi' => '']];
            $petugas_penyegelan = $penyegelan->petugas_penyegelan ?? [['nama' => '', 'nip' => '', 'jabatan' => '']];
            $checklist_data = $penyegelan->checklist_data ?? [];
            $daftar_pemenang = $penyegelan->daftar_pemenang ?? [['nama' => '', 'hadiah' => '', 'no_undian' => '']];
        @endphp

        <!-- Langkah 1 & 2 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-800">1. Verifikasi Izin & 2. Koordinasi Saksi</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tanggal Penyegelan <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_penyegelan" required
                            value="{{ old('tanggal_penyegelan', $penyegelan->tanggal_penyegelan ? $penyegelan->tanggal_penyegelan->format('Y-m-d') : date('Y-m-d')) }}"
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                    </div>
                    <div class="space-y-1.5 flex flex-col justify-end">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="checklist_data[verif_izin]" value="1" {{ !empty($checklist_data['verif_izin']) ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                            <span class="text-sm font-semibold text-slate-700">Dokumen Izin UGB Terverifikasi (Langkah 1)</span>
                        </label>
                    </div>
                </div>

                <!-- Saksi -->
                <div class="border-t border-slate-100 pt-5">
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Daftar Saksi (Notaris, Polisi, Dinsos)</label>
                        <button type="button" onclick="addSaksi()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">+ Tambah Saksi</button>
                    </div>
                    <div id="saksi-container" class="space-y-3">
                        @foreach($saksi as $index => $s)
                        <div class="grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <input type="text" name="saksi[{{ $index }}][nama]" value="{{ $s['nama'] ?? '' }}" placeholder="Nama Saksi" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                            <input type="text" name="saksi[{{ $index }}][jabatan]" value="{{ $s['jabatan'] ?? '' }}" placeholder="Jabatan" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                            <input type="text" name="saksi[{{ $index }}][instansi]" value="{{ $s['instansi'] ?? '' }}" placeholder="Instansi (ex: Polsek)" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="checklist_data[saksi_hadir]" value="1" {{ !empty($checklist_data['saksi_hadir']) ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                            <span class="text-sm font-semibold text-slate-700">Semua saksi hadir dan siap (Langkah 2)</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Langkah 3 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-800">3. Penunjukan Petugas Penyegelan</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Nomor Surat Tugas</label>
                    <input type="text" name="nomor_surat_tugas" value="{{ old('nomor_surat_tugas', $penyegelan->nomor_surat_tugas ?? '') }}" placeholder="094/..." class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Petugas Penyegelan</label>
                        <button type="button" onclick="addPetugas()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">+ Tambah Petugas</button>
                    </div>
                    <div id="petugas-container" class="space-y-3">
                        @foreach($petugas_penyegelan as $index => $p)
                        <div class="grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <input type="text" name="petugas_penyegelan[{{ $index }}][nama]" value="{{ $p['nama'] ?? '' }}" placeholder="Nama Petugas" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                            <input type="text" name="petugas_penyegelan[{{ $index }}][nip]" value="{{ $p['nip'] ?? '' }}" placeholder="NIP" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                            <input type="text" name="petugas_penyegelan[{{ $index }}][jabatan]" value="{{ $p['jabatan'] ?? '' }}" placeholder="Jabatan" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Langkah 4 & 5 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-800">4. Pengecekan Alat & 5. Uji Coba</h3>
            </div>
            <div class="p-6 space-y-5">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="checklist_data[alat_dicek]" value="1" {{ !empty($checklist_data['alat_dicek']) ? 'checked' : '' }}
                        class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                    <span class="text-sm font-semibold text-slate-700">Alat pengundian telah dicek dan dipastikan kosong (Langkah 4)</span>
                </label>

                <div class="space-y-1.5 border-t border-slate-100 pt-5">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Hasil Uji Coba Alat (Langkah 5)</label>
                    <textarea name="hasil_uji_coba" rows="3" class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500" placeholder="Alat berputar normal, tidak ada rekayasa...">{{ old('hasil_uji_coba', $penyegelan->hasil_uji_coba ?? '') }}</textarea>
                </div>
                <label class="flex items-center gap-3 cursor-pointer mt-2">
                    <input type="checkbox" name="checklist_data[uji_coba_selesai]" value="1" {{ !empty($checklist_data['uji_coba_selesai']) ? 'checked' : '' }}
                        class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                    <span class="text-sm font-semibold text-slate-700">Uji coba selesai dan alat berfungsi wajar (Langkah 5)</span>
                </label>
            </div>
        </div>

        <!-- Langkah 6 & 7 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-800">6. Penyegelan & 7. Pembacaan Tata Tertib</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5 flex flex-col justify-center">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="checklist_data[segel_terpasang]" value="1" {{ !empty($checklist_data['segel_terpasang']) ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                            <span class="text-sm font-semibold text-slate-700">Stiker Segel Telah Terpasang (Langkah 6)</span>
                        </label>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Upload Foto Segel (Langkah 6)</label>
                        <input type="file" name="foto_segel" accept=".jpg,.jpeg,.png"
                            class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        @if($penyegelan && $penyegelan->foto_segel)
                            <a href="{{ Storage::url($penyegelan->foto_segel) }}" target="_blank" class="text-[10px] font-bold text-emerald-600 hover:underline">Lihat Foto Saat Ini</a>
                        @endif
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-5">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="checklist_data[tatib_dibaca]" value="1" {{ !empty($checklist_data['tatib_dibaca']) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                        <span class="text-sm font-semibold text-slate-700">Tata Tertib Undian telah dibacakan ke publik (Langkah 7)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Langkah 8 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-800">8. Penarikan Undian & Penetapan Pemenang</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Daftar Pemenang Utama</label>
                        <button type="button" onclick="addPemenang()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">+ Tambah Pemenang</button>
                    </div>
                    <div id="pemenang-container" class="space-y-3">
                        @foreach($daftar_pemenang as $index => $pem)
                        <div class="grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <input type="text" name="daftar_pemenang[{{ $index }}][nama]" value="{{ $pem['nama'] ?? '' }}" placeholder="Nama Pemenang" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                            <input type="text" name="daftar_pemenang[{{ $index }}][hadiah]" value="{{ $pem['hadiah'] ?? '' }}" placeholder="Hadiah (ex: Mobil)" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                            <input type="text" name="daftar_pemenang[{{ $index }}][no_undian]" value="{{ $pem['no_undian'] ?? '' }}" placeholder="Nomor Undian" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-5">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="checklist_data[undian_selesai]" value="1" {{ !empty($checklist_data['undian_selesai']) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-slate-300 text-emerald-600">
                        <span class="text-sm font-semibold text-slate-700">Penarikan undian selesai, saksi menandatangani Berita Acara (Langkah 8)</span>
                    </label>
                </div>
                
                <div class="space-y-1.5 mt-4">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Catatan Tambahan Proses Penyegelan</label>
                    <textarea name="catatan" rows="2" class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500" placeholder="Semua berjalan lancar...">{{ old('catatan', $penyegelan->catatan ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
            <button type="submit" name="status" value="proses"
                class="rounded-xl bg-slate-100 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-200 border border-slate-300 transition">
                Simpan Progress Sementara
            </button>
            <button type="submit" name="status" value="selesai"
                onclick="return confirm('Apakah Anda yakin semua SOP penyegelan sudah selesai?')"
                class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-xs font-bold text-white shadow hover:opacity-90 transition">
                Tandai Selesai &rarr;
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    let saksiCount = {{ count($saksi) }};
    let petugasCount = {{ count($petugas_penyegelan) }};
    let pemenangCount = {{ count($daftar_pemenang) }};

    function addSaksi() {
        const div = document.createElement('div');
        div.className = 'grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200';
        div.innerHTML = `<input type="text" name="saksi[${saksiCount}][nama]" placeholder="Nama Saksi" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                         <input type="text" name="saksi[${saksiCount}][jabatan]" placeholder="Jabatan" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                         <input type="text" name="saksi[${saksiCount}][instansi]" placeholder="Instansi" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">`;
        document.getElementById('saksi-container').appendChild(div);
        saksiCount++;
    }

    function addPetugas() {
        const div = document.createElement('div');
        div.className = 'grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200';
        div.innerHTML = `<input type="text" name="petugas_penyegelan[${petugasCount}][nama]" placeholder="Nama Petugas" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                         <input type="text" name="petugas_penyegelan[${petugasCount}][nip]" placeholder="NIP" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                         <input type="text" name="petugas_penyegelan[${petugasCount}][jabatan]" placeholder="Jabatan" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">`;
        document.getElementById('petugas-container').appendChild(div);
        petugasCount++;
    }

    function addPemenang() {
        const div = document.createElement('div');
        div.className = 'grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200';
        div.innerHTML = `<input type="text" name="daftar_pemenang[${pemenangCount}][nama]" placeholder="Nama Pemenang" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                         <input type="text" name="daftar_pemenang[${pemenangCount}][hadiah]" placeholder="Hadiah" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">
                         <input type="text" name="daftar_pemenang[${pemenangCount}][no_undian]" placeholder="Nomor Undian" class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500">`;
        document.getElementById('pemenang-container').appendChild(div);
        pemenangCount++;
    }
</script>
@endsection
@endsection
