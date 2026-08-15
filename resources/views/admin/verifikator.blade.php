@extends('layouts.app')

@section('title', 'Dashboard Verifikator & Manajemen User')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-emerald-500/10 text-emerald-600 ring-1 ring-emerald-500/20 mb-2">
                PETUGAS / VERIFIKATOR
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pusat Verifikasi &amp; Manajemen Pengguna</h1>
            <p class="text-sm text-slate-500 mt-1">Mengulas keabsahan berkas perizinan, memvalidasi pendaftaran user baru, dan mengelola akun pengguna.</p>
        </div>
        <div>
            <button onclick="openModal('create-modal')" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-sm font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                <span class="mr-1.5 font-black">+</span> Tambah User Baru
            </button>
        </div>
    </div>

    <!-- Quick Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="glass-panel rounded-2xl p-5 border border-slate-200">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase">Antrean Perizinan</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-500/10 text-blue-600 text-xs font-bold">{{ count($queues) }}</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ count($queues) }}</h3>
            <p class="text-[11px] text-blue-600 font-semibold mt-1">Menunggu Verifikasi Berkas</p>
        </div>

        <div class="glass-panel rounded-2xl p-5 border border-slate-200">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase">Validasi User Baru</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-500/10 text-amber-600 text-xs font-bold">{{ count($pendingUsers ?? []) }}</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ count($pendingUsers ?? []) }}</h3>
            <p class="text-[11px] text-amber-600 font-semibold mt-1">Akun Perlu Divalidasi</p>
        </div>

        <div class="glass-panel rounded-2xl p-5 border border-slate-200">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase">Pengajuan Profil</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-purple-500/10 text-purple-600 text-xs font-bold">{{ count($profileRequests ?? []) }}</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ count($profileRequests ?? []) }}</h3>
            <p class="text-[11px] text-purple-600 font-semibold mt-1">Permintaan Ubah Profil</p>
        </div>

        <div class="glass-panel rounded-2xl p-5 border border-slate-200">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase">Total User</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-600 text-xs font-bold">{{ $users->total() }}</span>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $users->total() }}</h3>
            <p class="text-[11px] text-emerald-600 font-semibold mt-1">Pengguna Terdaftar</p>
        </div>
    </div>

    <!-- Main Navigation Tabs -->
    <div class="flex border-b border-slate-200 mb-8 gap-6 overflow-x-auto pb-px">
        <button onclick="switchTab('tab-queues')" id="btn-tab-queues" class="tab-btn pb-3 text-sm font-bold border-b-2 transition border-emerald-500 text-slate-900 whitespace-nowrap flex items-center gap-2">
            📋 Antrean Verifikasi Perizinan
            <span class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700 font-bold">{{ count($queues) }}</span>
        </button>
        
        <button onclick="switchTab('tab-pending-users')" id="btn-tab-pending-users" class="tab-btn pb-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-900 transition whitespace-nowrap flex items-center gap-2">
            🔑 Validasi User Baru (Pendaftaran)
            @if(count($pendingUsers ?? []) > 0)
                <span class="px-2 py-0.5 rounded-full text-[10px] bg-amber-100 text-amber-700 font-bold animate-pulse">{{ count($pendingUsers) }}</span>
            @endif
        </button>

        <button onclick="switchTab('tab-all-users')" id="btn-tab-all-users" class="tab-btn pb-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-900 transition whitespace-nowrap flex items-center gap-2">
            👥 Daftar Semua Pengguna
        </button>

        <button onclick="switchTab('tab-profile-requests')" id="btn-tab-profile-requests" class="tab-btn pb-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-900 transition whitespace-nowrap flex items-center gap-2">
            📝 Pengajuan Ubah Profil ({{ count($profileRequests ?? []) }})
        </button>

        <button onclick="switchTab('tab-audit-logs')" id="btn-tab-audit-logs" class="tab-btn pb-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-900 transition whitespace-nowrap flex items-center gap-2">
            🛡️ Audit Log Akses
        </button>
    </div>

    <!-- ================= TAB 1: ANTREAN PERIZINAN ================= -->
    <div id="tab-queues" class="tab-pane">
        <div class="glass-panel rounded-2xl overflow-hidden mb-10">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-base">Antrean Verifikasi Administrasi Dokumen ({{ count($queues) }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                            <th class="px-6 py-4">Tanggal Pengajuan</th>
                            <th class="px-6 py-4">Pemohon</th>
                            <th class="px-6 py-4">Jenis Layanan</th>
                            <th class="px-6 py-4">Status Alur</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($queues as $q)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-xs font-medium text-slate-500">
                                    {{ $q->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 text-sm">{{ $q->pemohon->name }}</div>
                                    @if($q->pemohon->nama_lembaga)
                                        <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $q->pemohon->nama_lembaga }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs font-semibold text-slate-700">
                                    @if($q->jenis_layanan === 'ugb') Undian Gratis Berhadiah (UGB)
                                    @elseif($q->jenis_layanan === 'pub') Pengumpulan Uang/Barang (PUB)
                                    @elseif($q->jenis_layanan === 'lks') Izin Operasional LKS
                                    @elseif($q->jenis_layanan === 'adopsi') Rekomendasi Adopsi Anak
                                    @endif
                                    <div class="text-[10px] text-slate-400 mt-0.5">ID: #{{ $q->id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-blue-500/10 text-blue-600 ring-1 ring-blue-500/20">
                                        MENUNGGU VERIFIKASI VERIFIKATOR
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('perizinan.show', $q->id) }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-4 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition shadow-sm">
                                        🔍 Ulas &amp; Proses
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-xs text-slate-400">
                                    Antrean kosong. Semua dokumen perizinan telah diverifikasi secara administrasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= TAB 2: VALIDASI USER BARU ================= -->
    <div id="tab-pending-users" class="tab-pane hidden">
        <div class="glass-panel rounded-2xl overflow-hidden mb-10">
            <div class="px-6 py-4 border-b border-slate-200 bg-amber-500/10 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-amber-900 text-base">Permohonan Registrasi Akun Baru Menunggu Validasi ({{ count($pendingUsers ?? []) }})</h3>
                    <p class="text-xs text-amber-700 mt-0.5">Verifikator wajib memeriksa keabsahan identitas KTP/KK/Akta sebelum menyetujui akun baru.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nama Pengguna / Lembaga</th>
                            <th class="px-6 py-4">Tipe Akun</th>
                            <th class="px-6 py-4">Kontak &amp; Email</th>
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-right">Aksi Validasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pendingUsers ?? [] as $pu)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-xs font-semibold text-slate-400">#{{ $pu->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 text-sm">{{ $pu->isLembaga() ? $pu->nama_lembaga : $pu->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $pu->isLembaga() ? 'PJ: ' . $pu->name : 'NIK: ' . ($pu->nik ?? '-') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold uppercase {{ $pu->isLembaga() ? 'bg-purple-100 text-purple-700' : 'bg-teal-100 text-teal-700' }}">
                                        {{ $pu->isLembaga() ? 'Lembaga (' . $pu->jenis_lembaga_label . ')' : 'Masyarakat' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600">
                                    <div>{{ $pu->email }}</div>
                                    <div class="text-slate-400 text-[11px]">{{ $pu->kontak ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $pu->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button onclick="openUserDetailModal({{ json_encode($pu) }}, {{ json_encode($pu->validationLogs) }})"
                                        class="inline-flex items-center justify-center rounded-lg bg-amber-500 text-slate-950 px-3.5 py-1.5 text-xs font-bold hover:bg-amber-400 transition shadow-sm">
                                        ⚡ Periksa &amp; Validasi
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-xs text-slate-400">
                                    Tidak ada pendaftaran pengguna baru yang membutuhkan validasi saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= TAB 3: DAFTAR SEMUA PENGGUNA ================= -->
    <div id="tab-all-users" class="tab-pane hidden space-y-6">
        <!-- Search & Filter Bar -->
        <div class="glass-panel rounded-2xl p-5 border border-slate-200">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-96 relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama atau email..." 
                        class="block w-full rounded-xl bg-white border border-slate-300 pl-4 pr-10 py-2 text-sm text-slate-900 placeholder-slate-400 focus:border-emerald-500 focus:outline-none transition">
                    @if(request('search'))
                        <a href="{{ route('admin.users.index', request()->except('search')) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 text-xs">Clear</a>
                    @endif
                </div>

                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-semibold text-slate-500 uppercase">Peran:</label>
                        <select name="role" onchange="this.form.submit()" 
                            class="rounded-xl bg-white border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Peran</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin (Super)</option>
                            <option value="sekretariat" {{ request('role') === 'sekretariat' ? 'selected' : '' }}>Sekretariat / Operator</option>
                            <option value="verifikator" {{ request('role') === 'verifikator' ? 'selected' : '' }}>Verifikator Administrasi</option>
                            <option value="dinsos_wilayah" {{ request('role') === 'dinsos_wilayah' ? 'selected' : '' }}>Dinsos Kab/Kota</option>
                            <option value="bidang_pemberdayaan" {{ request('role') === 'bidang_pemberdayaan' ? 'selected' : '' }}>Bidang Pemberdayaan</option>
                            <option value="bidang_linjamsos" {{ request('role') === 'bidang_linjamsos' ? 'selected' : '' }}>Bidang Linjamsos</option>
                            <option value="kadinas" {{ request('role') === 'kadinas' ? 'selected' : '' }}>Kepala Dinas</option>
                            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User (Standard)</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="text-xs font-semibold text-slate-500 uppercase">Tipe Akun:</label>
                        <select name="account_type" onchange="this.form.submit()" 
                            class="rounded-xl bg-white border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Tipe</option>
                            <option value="masyarakat" {{ request('account_type') === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                            <option value="lembaga"    {{ request('account_type') === 'lembaga'    ? 'selected' : '' }}>Lembaga / Instansi</option>
                        </select>
                    </div>

                    @if(request('search') || request('role') || request('account_type'))
                        <a href="{{ route('admin.users.index') }}" class="text-xs text-rose-600 hover:text-rose-800 font-bold ml-2">Reset Filter</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- User Table -->
        <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Peran</th>
                            <th class="px-6 py-4">Status Validasi</th>
                            <th class="px-6 py-4">Dibuat Pada</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $u)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-xs font-semibold text-slate-400">#{{ $u->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 text-sm">{{ $u->name }}</div>
                                    @if($u->nama_lembaga)
                                        <div class="text-[10px] text-purple-600 font-semibold">{{ $u->nama_lembaga }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600">{{ $u->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($u->validation_status === 'validated')
                                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            ✓ Validated
                                        </span>
                                    @elseif($u->validation_status === 'rejected')
                                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-rose-100 text-rose-800">
                                            ✗ Rejected
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-amber-100 text-amber-800">
                                            ⏳ Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-400">{{ $u->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                    <button onclick="openUserDetailModal({{ json_encode($u) }}, {{ json_encode($u->validationLogs) }})"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                        Detail
                                    </button>
                                    <button onclick="openEditModal({{ json_encode($u) }})"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition">
                                        Edit
                                    </button>
                                    @if($u->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-400 text-xs">
                                    Tidak ada pengguna ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- ================= TAB 4: PENGAJUAN UBAH PROFIL ================= -->
    <div id="tab-profile-requests" class="tab-pane hidden">
        <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200 mb-10">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-base">Permintaan Perubahan Profil Pengguna ({{ count($profileRequests ?? []) }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Field yang Diubah</th>
                            <th class="px-6 py-4">Tanggal Pengajuan</th>
                            <th class="px-6 py-4 text-right">Aksi Persetujuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($profileRequests ?? [] as $req)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 text-sm">{{ $req->user->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $req->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($req->requested_changes as $key => $val)
                                            <li><span class="font-semibold text-slate-800">{{ $key }}:</span> {{ is_array($val) ? json_encode($val) : $val }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $req->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.profile-requests.handle', $req->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="action" value="approved">
                                        <button type="submit" onclick="return confirm('Setujui perubahan profil ini?')"
                                            class="px-3 py-1.5 text-xs font-bold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition">
                                            ✓ Setujui
                                        </button>
                                    </form>
                                    <button onclick="openProfileRejectModal({{ $req->id }})"
                                        class="px-3 py-1.5 text-xs font-bold rounded-lg bg-rose-600 text-white hover:bg-rose-700 transition">
                                        ✗ Tolak
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-xs">
                                    Tidak ada permintaan perubahan profil pengguna yang pending.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= TAB 5: AUDIT LOG AKSES ================= -->
    <div id="tab-audit-logs" class="tab-pane hidden">
        <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200 mb-10">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-base">Audit Log Akses &amp; Aktivitas Petugas</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                            <th class="px-6 py-4">Petugas</th>
                            <th class="px-6 py-4">Pengguna Target</th>
                            <th class="px-6 py-4">Aksi</th>
                            <th class="px-6 py-4">Detail Catatan</th>
                            <th class="px-6 py-4">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($accessAuditLogs ?? [] as $log)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $log->admin->name ?? 'System' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $log->targetUser->name ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $log->details }}</td>
                                <td class="px-6 py-4 text-slate-400">{{ $log->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-xs">
                                    Belum ada catatan log audit.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ================= CREATE USER MODAL ================= -->
<div id="create-modal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl relative">
        <button onclick="closeModal('create-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 text-lg">&times;</button>
        <h3 class="text-xl font-extrabold text-slate-900 mb-6">Tambah Pengguna Baru</h3>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label for="create_name" class="block text-xs font-bold text-slate-700 uppercase">Nama Lengkap</label>
                <input id="create_name" name="name" type="text" required class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900">
            </div>
            <div class="space-y-1.5">
                <label for="create_email" class="block text-xs font-bold text-slate-700 uppercase">Alamat Email</label>
                <input id="create_email" name="email" type="email" required class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900">
            </div>
            <div class="space-y-1.5">
                <label for="create_password" class="block text-xs font-bold text-slate-700 uppercase">Kata Sandi</label>
                <input id="create_password" name="password" type="password" required minlength="8" class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900" placeholder="Minimal 8 karakter">
            </div>
            <div class="space-y-1.5">
                <label for="create_role" class="block text-xs font-bold text-slate-700 uppercase">Hak Peran</label>
                <select id="create_role" name="role" required class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900">
                    <option value="user">User (Standard)</option>
                    <option value="admin">Admin (Super)</option>
                    <option value="sekretariat">Sekretariat / Operator</option>
                    <option value="verifikator">Verifikator Administrasi</option>
                    <option value="dinsos_wilayah">Dinsos Kab/Kota</option>
                    <option value="bidang_pemberdayaan">Bidang Pemberdayaan</option>
                    <option value="bidang_linjamsos">Bidang Linjamsos</option>
                    <option value="kadinas">Kepala Dinas</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                <button type="button" onclick="closeModal('create-modal')" class="rounded-xl bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-200">Batal</button>
                <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700 shadow-md">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT USER MODAL ================= -->
<div id="edit-modal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl relative">
        <button onclick="closeModal('edit-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 text-lg">&times;</button>
        <h3 class="text-xl font-extrabold text-slate-900 mb-6">Ubah Informasi Pengguna</h3>
        <form id="edit-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label for="edit_name" class="block text-xs font-bold text-slate-700 uppercase">Nama Lengkap</label>
                <input id="edit_name" name="name" type="text" required class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900">
            </div>
            <div class="space-y-1.5">
                <label for="edit_email" class="block text-xs font-bold text-slate-700 uppercase">Alamat Email</label>
                <input id="edit_email" name="email" type="email" required class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900">
            </div>
            <div class="space-y-1.5">
                <label for="edit_password" class="block text-xs font-bold text-slate-700 uppercase">Kata Sandi Baru (Opsional)</label>
                <input id="edit_password" name="password" type="password" minlength="8" class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900" placeholder="Kosongkan jika tidak diubah">
            </div>
            <div class="space-y-1.5">
                <label for="edit_role" class="block text-xs font-bold text-slate-700 uppercase">Hak Peran</label>
                <select id="edit_role" name="role" required class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900">
                    <option value="user">User (Standard)</option>
                    <option value="admin">Admin (Super)</option>
                    <option value="sekretariat">Sekretariat / Operator</option>
                    <option value="verifikator">Verifikator Administrasi</option>
                    <option value="dinsos_wilayah">Dinsos Kab/Kota</option>
                    <option value="bidang_pemberdayaan">Bidang Pemberdayaan</option>
                    <option value="bidang_linjamsos">Bidang Linjamsos</option>
                    <option value="kadinas">Kepala Dinas</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                <button type="button" onclick="closeModal('edit-modal')" class="rounded-xl bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-200">Batal</button>
                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-indigo-700 shadow-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= USER DETAIL & VALIDATION MODAL ================= -->
<div id="user-detail-modal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-2xl p-6 shadow-2xl relative" style="max-height:90vh; overflow-y:auto;">
        <button onclick="closeModal('user-detail-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 text-lg">&times;</button>

        <h3 id="detail_title" class="text-xl font-extrabold text-slate-900 mb-1">Detail Pengguna</h3>
        <p id="detail_subtitle" class="text-xs text-slate-500 mb-6">Informasi profil, status verifikasi akun, dan validasi data terpadu oleh Verifikator</p>

        <!-- Common Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 mb-6">
            <div class="flex justify-between gap-4 py-2 border-b border-slate-100 md:col-span-2">
                <span id="detail_name_label" class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lengkap</span>
                <span id="detail_name" class="text-xs text-slate-900 font-medium text-right">-</span>
            </div>

            <!-- Lembaga Specific Fields -->
            <div id="section_lembaga" class="space-y-3 md:col-span-2 hidden">
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lembaga</span>
                    <span id="detail_nama_lembaga" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Jenis Lembaga</span>
                    <span id="detail_jenis" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">No. Akta Pendirian</span>
                    <span id="detail_no_akta" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">NPWP</span>
                    <span id="detail_npwp" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat Lembaga</span>
                    <span id="detail_alamat_lembaga" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Dokumen Legalitas</span>
                    <a id="detail_dokumen_link" href="#" target="_blank" class="text-xs text-indigo-600 hover:underline font-bold">📄 Lihat Dokumen Legalitas</a>
                </div>
            </div>

            <!-- Masyarakat Specific Fields -->
            <div id="section_masyarakat" class="space-y-3 md:col-span-2 hidden">
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">NIK</span>
                    <span id="detail_nik" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nomor KK</span>
                    <span id="detail_no_kk" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Kontak</span>
                    <span id="detail_kontak" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat Domisili</span>
                    <span id="detail_alamat" class="text-xs text-slate-900 font-medium text-right">-</span>
                </div>
            </div>

            <div class="flex justify-between gap-4 py-2 border-b border-slate-100 md:col-span-2">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Status Validasi Akun</span>
                <span id="detail_status" class="text-xs text-right">-</span>
            </div>
        </div>

        <!-- Integrated Systems Test Buttons -->
        <div class="mb-6 p-4 rounded-xl bg-slate-50 border border-slate-200">
            <h4 class="text-xs font-bold text-slate-700 uppercase mb-2">Simulasi Validasi Database Terpadu</h4>
            <div id="validation_buttons" class="flex flex-wrap gap-2"></div>
        </div>

        <!-- Validation Logs -->
        <div class="mb-6">
            <h4 class="text-xs font-bold text-slate-700 uppercase mb-2">Riwayat Log Validasi</h4>
            <div id="validation_logs_list" class="space-y-2 max-h-40 overflow-y-auto"></div>
        </div>

        <!-- Verification Action Form -->
        <form id="action-verifikasi-form" method="POST" class="pt-4 border-t border-slate-200 space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label for="validation_note" class="block text-xs font-bold text-slate-700 uppercase">Catatan Verifikator</label>
                <textarea id="validation_note" name="validation_note" rows="2" class="block w-full rounded-xl bg-white border border-slate-300 px-3 py-2 text-xs text-slate-900" placeholder="Berikan catatan persetujuan atau alasan penolakan..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="submit" name="validation_action" value="rejected" onclick="return confirm('Tolak pendaftaran akun pengguna ini?')" class="rounded-xl bg-rose-600 px-4 py-2 text-xs font-bold text-white hover:bg-rose-700 shadow-sm">
                    ✗ Tolak Akun
                </button>
                <button type="submit" name="validation_action" value="validated" onclick="return confirm('Setujui dan aktifkan akun pengguna ini?')" class="rounded-xl bg-emerald-600 px-5 py-2 text-xs font-bold text-white hover:bg-emerald-700 shadow-sm">
                    ✓ Setujui &amp; Aktifkan Akun
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= PROFILE REJECT MODAL ================= -->
<div id="profile-reject-modal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-2xl relative">
        <button onclick="closeModal('profile-reject-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 text-lg">&times;</button>
        <h3 class="text-lg font-extrabold text-slate-900 mb-4">Penolakan Permintaan Profil</h3>
        <form id="profile-reject-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="action" value="rejected">
            <div class="space-y-1.5">
                <label for="rejection_reason" class="block text-xs font-bold text-slate-700 uppercase">Alasan Penolakan</label>
                <textarea id="rejection_reason" name="rejection_reason" required rows="3" class="block w-full rounded-xl bg-white border border-slate-300 px-3 py-2 text-xs text-slate-900" placeholder="Berikan alasan penolakan..."></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeModal('profile-reject-modal')" class="rounded-xl bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-600">Batal</button>
                <button type="submit" class="rounded-xl bg-rose-600 px-4 py-2 text-xs font-bold text-white hover:bg-rose-700 shadow-sm">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('border-emerald-500', 'text-slate-900');
            el.classList.add('border-transparent', 'text-slate-500');
        });

        document.getElementById(tabId).classList.remove('hidden');
        const activeBtn = document.getElementById('btn-' + tabId);
        if (activeBtn) {
            activeBtn.classList.add('border-emerald-500', 'text-slate-900');
            activeBtn.classList.remove('border-transparent', 'text-slate-500');
        }
    }

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function openEditModal(user) {
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        document.getElementById('edit_password').value = '';

        const form = document.getElementById('edit-form');
        form.action = `/admin/users/${user.id}`;

        openModal('edit-modal');
    }

    function openProfileRejectModal(requestId) {
        const form = document.getElementById('profile-reject-form');
        form.action = `/admin/profile-requests/${requestId}`;
        openModal('profile-reject-modal');
    }

    function openUserDetailModal(user, logs = []) {
        const statusMap = {
            'pending': '<span class="font-bold text-amber-600">⏳ Menunggu Verifikasi</span>',
            'validated': '<span class="font-bold text-emerald-600">✓ Terverifikasi / Aktif</span>',
            'rejected': '<span class="font-bold text-rose-600">✗ Ditolak</span>',
        };

        const verifikasiForm = document.getElementById('action-verifikasi-form');
        if (verifikasiForm) verifikasiForm.action = `/admin/users/${user.id}`;

        document.getElementById('detail_name').textContent = user.name;
        document.getElementById('detail_status').innerHTML = statusMap[user.validation_status] || '-';
        document.getElementById('validation_note').value = user.validation_note || '';

        const validationBtnContainer = document.getElementById('validation_buttons');
        validationBtnContainer.innerHTML = '';

        const logsContainer = document.getElementById('validation_logs_list');
        logsContainer.innerHTML = '';

        if (logs.length === 0) {
            logsContainer.innerHTML = '<div class="text-slate-400 italic text-xs">Belum ada riwayat validasi.</div>';
        } else {
            logs.forEach(log => {
                const date = new Date(log.created_at).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'});
                const statusBadge = log.status === 'matched' 
                    ? '<span class="text-emerald-700 font-bold bg-emerald-100 px-1 py-0.5 rounded text-[10px]">MATCH</span>'
                    : '<span class="text-rose-700 font-bold bg-rose-100 px-1 py-0.5 rounded text-[10px]">MISMATCH</span>';
                
                const logItem = document.createElement('div');
                logItem.className = 'border-b border-slate-100 pb-2 text-[11px]';
                logItem.innerHTML = `
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-slate-800">${log.source}</span>
                        ${statusBadge}
                    </div>
                    <div class="text-slate-600 mb-0.5">${log.notes}</div>
                    <div class="text-[9px] text-slate-400 flex justify-between">
                        <span>Verifikator ID: ${log.checked_by}</span>
                        <span>${date}</span>
                    </div>
                `;
                logsContainer.appendChild(logItem);
            });
        }

        if (user.account_type === 'lembaga') {
            document.getElementById('detail_title').textContent = 'Detail Validasi Akun Lembaga';
            document.getElementById('detail_subtitle').textContent = 'Informasi legalitas dan validasi data lembaga oleh Verifikator';
            document.getElementById('detail_name_label').textContent = 'Penanggung Jawab';

            document.getElementById('section_lembaga').classList.remove('hidden');
            document.getElementById('section_masyarakat').classList.add('hidden');

            const jenisMap = {
                'perusahaan': 'Perusahaan',
                'lks': 'Lembaga Kesejahteraan Sosial (LKS)',
                'instansi_pemerintah': 'Instansi Pemerintah',
                'organisasi_sosial': 'Organisasi Sosial',
            };
            document.getElementById('detail_nama_lembaga').textContent = user.nama_lembaga || '-';
            document.getElementById('detail_jenis').textContent = jenisMap[user.jenis_lembaga] || '-';
            document.getElementById('detail_no_akta').textContent = user.no_akta || '-';
            document.getElementById('detail_npwp').textContent = user.npwp || '-';
            document.getElementById('detail_alamat_lembaga').textContent = user.alamat_lembaga || '-';

            const docLink = document.getElementById('detail_dokumen_link');
            if (user.dokumen_legalitas) {
                docLink.href = `/storage/${user.dokumen_legalitas}`;
                docLink.style.display = 'inline';
            } else {
                docLink.style.display = 'none';
            }

            ['AHU', 'OSS', 'NPWP'].forEach(src => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.onclick = () => submitValidation(user.id, src);
                btn.className = 'bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1.5 px-3 rounded-lg text-[10px] transition shadow-sm';
                btn.innerHTML = `🔍 Cek Database ${src}`;
                validationBtnContainer.appendChild(btn);
            });
        } else {
            document.getElementById('detail_title').textContent = 'Detail Validasi Akun Masyarakat';
            document.getElementById('detail_subtitle').textContent = 'Informasi profil diri dan validasi kependudukan oleh Verifikator';
            document.getElementById('detail_name_label').textContent = 'Nama Lengkap';

            document.getElementById('section_lembaga').classList.add('hidden');
            document.getElementById('section_masyarakat').classList.remove('hidden');

            document.getElementById('detail_nik').textContent = user.nik || '-';
            document.getElementById('detail_no_kk').textContent = user.no_kk || '-';
            document.getElementById('detail_kontak').textContent = user.kontak || '-';
            document.getElementById('detail_alamat').textContent = user.alamat || '-';

            ['Dukcapil', 'SIKS-NG'].forEach(src => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.onclick = () => submitValidation(user.id, src);
                btn.className = 'bg-teal-600 hover:bg-teal-700 text-white font-bold py-1.5 px-3 rounded-lg text-[10px] transition shadow-sm';
                btn.innerHTML = `🔍 Cek Database ${src}`;
                validationBtnContainer.appendChild(btn);
            });
        }

        openModal('user-detail-modal');
    }

    function submitValidation(userId, source) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/users/${userId}/validate`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        const srcInput = document.createElement('input');
        srcInput.type = 'hidden';
        srcInput.name = 'source';
        srcInput.value = source;
        form.appendChild(srcInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
