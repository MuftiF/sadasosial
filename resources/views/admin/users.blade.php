@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Top Header & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Manajemen Pengguna &amp; Verifikasi</h1>
            <p class="text-sm text-slate-400 mt-1">Kelola data pengguna, perbarui kata sandi, tinjau perubahan profil, dan validasi data terpadu.</p>
        </div>
        <div>
            <button onclick="openModal('create-modal')" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-sm font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                <span class="mr-1.5 font-black">+</span> Tambah User Baru
            </button>
        </div>
    </div>

    <!-- Client-side Tabs Navigation -->
    <div class="flex border-b border-slate-800 mb-8 gap-6 overflow-x-auto pb-px">
        <button onclick="switchTab('tab-users')" id="btn-tab-users" class="tab-btn pb-3 text-sm font-bold border-b-2 transition border-emerald-500 text-white whitespace-nowrap">
            Daftar Pengguna
        </button>
        <button onclick="switchTab('tab-profile-requests')" id="btn-tab-profile-requests" class="tab-btn pb-3 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-white transition whitespace-nowrap">
            Pengajuan Profil ({{ count($profileRequests) }})
        </button>
        <button onclick="switchTab('tab-audit-logs')" id="btn-tab-audit-logs" class="tab-btn pb-3 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-white transition whitespace-nowrap">
            Audit Log Akses
        </button>
    </div>

    <!-- ==================== TAB 1: USER LIST ==================== -->
    <div id="tab-users" class="tab-pane space-y-6">
        <!-- Search & Filter Bar -->
        <div class="glass-panel rounded-2xl p-5">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="w-full md:w-96 relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama atau email..." 
                        class="block w-full rounded-xl bg-slate-950 border border-slate-800 pl-4 pr-10 py-2.5 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200">
                    @if(request('search'))
                        <a href="{{ route('admin.users.index', request()->except('search')) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white text-xs">Clear</a>
                    @endif
                </div>

                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Peran:</label>
                        <select name="role" onchange="this.form.submit()" 
                            class="rounded-xl bg-slate-950 border border-slate-800 px-3 py-2 text-xs text-white focus:outline-none focus:border-emerald-500">
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
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Tipe Akun:</label>
                        <select name="account_type" onchange="this.form.submit()" 
                            class="rounded-xl bg-slate-950 border border-slate-800 px-3 py-2 text-xs text-white focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Tipe</option>
                            <option value="masyarakat" {{ request('account_type') === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                            <option value="lembaga"    {{ request('account_type') === 'lembaga'    ? 'selected' : '' }}>Lembaga / Instansi</option>
                        </select>
                    </div>

                    @if(request('search') || request('role') || request('account_type'))
                        <a href="{{ route('admin.users.index') }}" class="text-xs text-rose-400 hover:text-rose-300 font-bold ml-2">Reset Filter</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- User Data Table -->
        <div class="glass-panel rounded-2xl overflow-hidden glow-indigo">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 bg-slate-950/40 text-slate-400 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Peran</th>
                            <th class="px-6 py-4">Tipe Akun</th>
                            <th class="px-6 py-4">Dibuat Pada</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse($users as $u)
                            <tr class="hover:bg-slate-900/30 transition duration-150">
                                <td class="px-6 py-4 text-xs font-semibold text-slate-400">#{{ $u->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white text-sm">{{ $u->name }}</div>
                                    @if($u->isLembaga())
                                        <div class="text-xs text-slate-500 mt-0.5 font-medium">{{ $u->nama_lembaga }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-300 text-sm font-medium">{{ $u->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold {{ $u->isStaff() ? 'bg-indigo-400/10 text-indigo-400 ring-1 ring-inset ring-indigo-400/20' : 'bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20' }}">
                                        @if($u->role === 'dinsos_wilayah') Dinsos Wilayah
                                        @elseif($u->role === 'bidang_pemberdayaan') Bidang Pemberdayaan
                                        @elseif($u->role === 'bidang_linjamsos') Bidang Linjamsos
                                        @elseif($u->role === 'kadinas') Kepala Dinas
                                        @else {{ ucfirst($u->role) }}
                                        @endif
                                    </span>
                                 <td class="px-6 py-4">
                                     <div class="flex flex-col gap-1">
                                         @if($u->isLembaga())
                                             <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-violet-400/10 text-violet-400 ring-1 ring-inset ring-violet-400/20 w-fit">
                                                 Lembaga
                                             </span>
                                         @else
                                             <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-sky-400/10 text-sky-400 ring-1 ring-inset ring-sky-400/20 w-fit">
                                                 Masyarakat
                                             </span>
                                         @endif

                                         @if(!$u->isAdmin())
                                             {{-- Validation status badge --}}
                                             @if($u->validation_status === 'pending')
                                                 <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-amber-400/10 text-amber-400 ring-1 ring-inset ring-amber-400/20 w-fit">
                                                     Pending
                                                 </span>
                                             @elseif($u->validation_status === 'validated')
                                                 <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20 w-fit">
                                                     <x-heroicon-s-check class="w-3 h-3 inline-block" /> Terverifikasi
                                                 </span>
                                             @else
                                                 <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-rose-400/10 text-rose-400 ring-1 ring-inset ring-rose-400/20 w-fit">
                                                     ✗ Ditolak
                                                 </span>
                                             @endif
                                         @endif
                                     </div>
                                 </td>
                                 <td class="px-6 py-4 text-slate-400 text-xs">{{ $u->created_at->format('d M Y, H:i') }}</td>
                                 <td class="px-6 py-4 text-right">
                                     <div class="inline-flex gap-2">
                                         <!-- Edit Button -->
                                         <button onclick="openEditModal({{ json_encode($u) }})" class="inline-flex items-center justify-center rounded-lg bg-blue-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-blue-600 transition">
                                             Edit
                                         </button>

                                         @if(!$u->isAdmin())
                                             <!-- View Detail -->
                                             <button onclick="openUserDetailModal({{ json_encode($u) }}, {{ json_encode($u->validationLogs) }})" class="inline-flex items-center justify-center rounded-lg bg-emerald-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-emerald-600 transition">
                                                 Detail &amp; Validasi
                                             </button>
                                         @endif

                                        <!-- Delete Form -->
                                        @if($u->id !== Auth::id())
                                            <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-red-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-red-600 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-500 font-medium py-1.5 px-3 select-none">Diri Sendiri</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500 text-sm">
                                    Tidak ada pengguna ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-slate-800 bg-slate-950/20">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- ==================== TAB 2: PROFILE UPDATE REQUESTS ==================== -->
    <div id="tab-profile-requests" class="tab-pane hidden space-y-6">
        <div class="glass-panel rounded-2xl p-6 glow-indigo">
            <h3 class="text-lg font-bold text-white mb-2">Peninjauan Pemutakhiran Profil</h3>
            <p class="text-xs text-slate-400 mb-6">Daftar permohonan perubahan profil dari pengguna yang membutuhkan verifikasi.</p>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 text-slate-400 text-xs font-bold uppercase tracking-wider bg-slate-950/20">
                            <th class="px-6 py-3">Pengguna</th>
                            <th class="px-6 py-3">Tipe Akun</th>
                            <th class="px-6 py-3">Rincian Perubahan (Data Lama → Baru)</th>
                            <th class="px-6 py-3">Diajukan Pada</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @forelse($profileRequests as $req)
                            <tr class="hover:bg-slate-900/10">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white text-sm">{{ $req->user->name }}</div>
                                    <div class="text-xs text-slate-500 font-mono">{{ $req->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs font-semibold text-slate-300">
                                    {{ ucfirst($req->user->account_type) }}
                                </td>
                                <td class="px-6 py-4 space-y-2">
                                    @foreach($req->requested_changes as $field => $newValue)
                                        <div class="text-xs">
                                            <span class="font-bold text-slate-400 uppercase tracking-wide text-[9px]">{{ str_replace('_', ' ', $field) }}:</span>
                                            <span class="text-slate-500 font-mono line-through block sm:inline mr-1">{{ $req->user->$field ?? 'Kosong' }}</span>
                                            <span class="text-indigo-400 font-bold block sm:inline">
                                                @if($field === 'dokumen_legalitas')
                                                    <a href="/storage/{{ $newValue }}" target="_blank" class="underline">File Baru ↗</a>
                                                @else
                                                    {{ $newValue }}
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-xs">{{ $req->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <!-- Approve Form -->
                                        <form action="{{ route('admin.profile-requests.handle', $req) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda menyetujui pemutakhiran data profil ini?')">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="action" value="approved">
                                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-emerald-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-emerald-600 transition">
                                                Setujui
                                            </button>
                                        </form>

                                        <!-- Reject Trigger -->
                                        <button onclick="openProfileRejectModal({{ $req->id }})" class="inline-flex items-center justify-center rounded-lg bg-red-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-red-600 transition">
                                            Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500 text-sm">
                                    Tidak ada pengajuan pemutakhiran profil pending saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 3: AUDIT LOGS ==================== -->
    <div id="tab-audit-logs" class="tab-pane hidden space-y-6">
        <div class="glass-panel rounded-2xl p-6 glow-indigo">
            <h3 class="text-lg font-bold text-white mb-2">Riwayat Audit Hak Akses</h3>
            <p class="text-xs text-slate-400 mb-6">Mencatat riwayat perubahan peran, hak akses, dan status registrasi pengguna.</p>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 text-slate-400 text-xs font-bold uppercase tracking-wider bg-slate-950/20">
                            <th class="px-6 py-3">Administrator</th>
                            <th class="px-6 py-3">Target Pengguna</th>
                            <th class="px-6 py-3">Aksi</th>
                            <th class="px-6 py-3">Keterangan</th>
                            <th class="px-6 py-3">IP &amp; User Agent</th>
                            <th class="px-6 py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/40 text-xs text-slate-300">
                        @forelse($accessAuditLogs as $log)
                            <tr class="hover:bg-slate-900/10">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $log->admin->name ?? 'System' }}</div>
                                    <div class="text-[10px] text-slate-500 font-mono">{{ $log->admin->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $log->targetUser->name ?? '-' }}</div>
                                    <div class="text-[10px] text-slate-500 font-mono">{{ $log->targetUser->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-1.5 py-0.5 text-[10px] font-bold uppercase {{ str_contains($log->action, 'reject') ? 'bg-rose-500/10 text-rose-400' : (str_contains($log->action, 'approve') || str_contains($log->action, 'create') ? 'bg-emerald-500/10 text-emerald-400' : 'bg-blue-500/10 text-blue-400') }}">
                                        {{ str_replace('_', ' ', $log->action) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-300 leading-relaxed max-w-xs truncate" title="{{ $log->details }}">
                                    {{ $log->details }}
                                </td>
                                <td class="px-6 py-4 font-mono text-[10px] text-slate-500">
                                    <div>IP: {{ $log->ip_address }}</div>
                                    <div class="truncate w-32" title="{{ $log->user_agent }}">{{ $log->user_agent }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $log->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-slate-500 text-sm">
                                    Belum ada catatan log audit hak akses.
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
<div id="create-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="glass-panel w-full max-w-lg rounded-2xl p-6 glow-emerald shadow-2xl relative animate-scale-up">
        <button onclick="closeModal('create-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-white text-lg">&times;</button>
        <h3 class="text-xl font-extrabold text-white mb-6">Tambah Pengguna Baru</h3>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label for="create_name" class="block text-xs font-bold text-slate-300 uppercase">Nama Lengkap</label>
                <input id="create_name" name="name" type="text" required
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>
            <div class="space-y-1.5">
                <label for="create_email" class="block text-xs font-bold text-slate-300 uppercase">Alamat Email</label>
                <input id="create_email" name="email" type="email" required
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>
            <div class="space-y-1.5">
                <label for="create_password" class="block text-xs font-bold text-slate-300 uppercase">Kata Sandi</label>
                <input id="create_password" name="password" type="password" required minlength="8"
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                    placeholder="Minimal 8 karakter">
            </div>
            <div class="space-y-1.5">
                <label for="create_role" class="block text-xs font-bold text-slate-300 uppercase">Hak Peran</label>
                <select id="create_role" name="role" required
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500">
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
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-900 mt-6">
                <button type="button" onclick="closeModal('create-modal')" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 transition">Batal</button>
                <button type="submit" class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-5 py-2.5 text-xs font-bold text-slate-950 shadow-md transition">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT USER MODAL ================= -->
<div id="edit-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="glass-panel w-full max-w-lg rounded-2xl p-6 glow-indigo shadow-2xl relative animate-scale-up">
        <button onclick="closeModal('edit-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-white text-lg">&times;</button>
        <h3 class="text-xl font-extrabold text-white mb-6">Ubah Informasi Pengguna</h3>
        <form id="edit-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label for="edit_name" class="block text-xs font-bold text-slate-300 uppercase">Nama Lengkap</label>
                <input id="edit_name" name="name" type="text" required
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div class="space-y-1.5">
                <label for="edit_email" class="block text-xs font-bold text-slate-300 uppercase">Alamat Email</label>
                <input id="edit_email" name="email" type="email" required
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div class="space-y-1.5">
                <label for="edit_password" class="block text-xs font-bold text-slate-300 uppercase">Kata Sandi Baru (Opsional)</label>
                <input id="edit_password" name="password" type="password" minlength="8"
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
                    placeholder="Kosongkan jika tidak ingin diubah">
            </div>
            <div class="space-y-1.5">
                <label for="edit_role" class="block text-xs font-bold text-slate-300 uppercase">Hak Peran</label>
                <select id="edit_role" name="role" required
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500">
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
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-900 mt-6">
                <button type="button" onclick="closeModal('edit-modal')" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 transition">Batal</button>
                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-bold text-white shadow-md hover:bg-indigo-500 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= USER DETAIL & VALIDATION MODAL ================= -->
<div id="user-detail-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="glass-panel w-full max-w-2xl rounded-2xl p-6 shadow-2xl relative animate-scale-up border border-violet-500/20" style="max-height:90vh; overflow-y:auto;">
        <button onclick="closeModal('user-detail-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-white text-lg">&times;</button>

        <h3 id="detail_title" class="text-xl font-extrabold text-white mb-1">Detail Pengguna</h3>
        <p id="detail_subtitle" class="text-xs text-slate-500 mb-6">Informasi profil, status verifikasi akun, dan validasi data terpadu</p>

        <!-- Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 mb-6">
            <!-- Common Fields -->
            <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60 md:col-span-2">
                <span id="detail_name_label" class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lengkap</span>
                <span id="detail_name" class="text-xs text-white font-medium text-right">-</span>
            </div>

            <!-- Lembaga Specific Fields -->
            <div id="section_lembaga" class="space-y-3 md:col-span-2 hidden">
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lembaga</span>
                    <span id="detail_nama_lembaga" class="text-xs text-white font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Jenis Lembaga</span>
                    <span id="detail_jenis" class="text-xs text-white font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">No. Akta Pendirian</span>
                    <span id="detail_no_akta" class="text-xs text-white font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">NPWP</span>
                    <span id="detail_npwp" class="text-xs text-white font-mono text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat Lembaga</span>
                    <span id="detail_alamat_lembaga" class="text-xs text-white font-medium text-right max-w-xs">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Dokumen Legalitas</span>
                    <a id="detail_dokumen_link" href="#" target="_blank" class="text-xs text-emerald-400 hover:underline font-medium">
                        Lihat Dokumen ↗
                    </a>
                </div>
            </div>

            <!-- Masyarakat Specific Fields -->
            <div id="section_masyarakat" class="space-y-3 md:col-span-2 hidden">
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">NIK (No. Induk Kependudukan)</span>
                    <span id="detail_nik" class="text-xs text-white font-mono text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nomor Kartu Keluarga</span>
                    <span id="detail_no_kk" class="text-xs text-white font-mono text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Nomor Telepon</span>
                    <span id="detail_kontak" class="text-xs text-white font-medium text-right">-</span>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat</span>
                    <span id="detail_alamat" class="text-xs text-white font-medium text-right max-w-xs">-</span>
                </div>
            </div>

            <!-- Validation Status -->
            <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60 md:col-span-2">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Status Verifikasi</span>
                <span id="detail_status" class="text-xs font-medium text-right">-</span>
            </div>
        </div>

        <!-- ==================== SUBPROSES 1.5: DATA VALIDATION PANEL ==================== -->
        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 mb-6">
            <h4 class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-3">🛠️ Validasi Sumber Data Terpadu</h4>
            
            <div id="validation_buttons" class="flex flex-wrap gap-2.5 mb-4">
                <!-- Validation buttons will be shown here via JS based on account_type -->
            </div>

            <div class="text-xs text-slate-400">
                <h5 class="font-bold text-slate-300 mb-1.5 uppercase tracking-wide text-[10px]">Log Validasi Akun Ini:</h5>
                <div class="max-h-36 overflow-y-auto border border-slate-800 rounded-lg bg-slate-950 p-2 space-y-2" id="validation_logs_list">
                    <!-- Logs list generated dynamically -->
                </div>
            </div>
        </div>

        <!-- Verification Form / Note -->
        <form id="action-verifikasi-form" method="POST" class="space-y-4 pt-4 border-t border-slate-900">
            @csrf
            @method('PUT')
            
            <div class="space-y-1.5">
                <label for="validation_note" class="block text-xs font-bold text-slate-400 uppercase tracking-wide">Catatan Verifikasi Admin</label>
                <textarea id="validation_note" name="validation_note" rows="2" placeholder="Masukkan alasan jika menolak pendaftaran..." class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2 text-xs text-white focus:outline-none focus:border-indigo-500 resize-none"></textarea>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" name="validation_action" value="validated" onclick="return confirm('Setujui dan aktifkan akun ini?')"
                    class="rounded-xl bg-emerald-500 px-4 py-2 text-xs font-bold text-slate-950 shadow-md hover:opacity-95 transition">
                    <x-heroicon-s-check class="w-3 h-3 inline-block" /> Setujui &amp; Aktifkan Akun
                </button>
                <button type="submit" name="validation_action" value="rejected" onclick="return confirm('Tolak pendaftaran akun ini?')"
                    class="rounded-xl bg-rose-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-rose-500 transition">
                    ✗ Tolak / Perlu Perbaikan
                </button>
                <button type="button" onclick="closeModal('user-detail-modal')"
                    class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-400 ring-1 ring-slate-800 hover:bg-slate-800 transition ml-auto">
                    Tutup
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= PROFILE REJECT MODAL ================= -->
<div id="profile-reject-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="glass-panel w-full max-w-md rounded-2xl p-6 shadow-2xl relative animate-scale-up border border-rose-500/20">
        <button onclick="closeModal('profile-reject-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-white text-lg">&times;</button>
        
        <h3 class="text-lg font-bold text-white mb-2">Tolak Perubahan Profil</h3>
        <p class="text-xs text-slate-400 mb-4">Berikan alasan mengapa permohonan pemutakhiran profil ini ditolak.</p>

        <form id="profile-reject-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="action" value="rejected">
            
            <div class="space-y-1.5">
                <label for="rejection_reason" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alasan Penolakan</label>
                <textarea id="rejection_reason" name="rejection_reason" required rows="3" class="block w-full rounded-xl bg-slate-950 border border-slate-850 px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-rose-500 resize-none" placeholder="Contoh: Dokumen Legalitas tidak terbaca..."></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-900">
                <button type="button" onclick="closeModal('profile-reject-modal')" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 transition">Batal</button>
                <button type="submit" class="rounded-xl bg-rose-600 px-5 py-2.5 text-xs font-bold text-white shadow-md hover:bg-rose-500 transition">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tab switching logic
    function switchTab(tabId) {
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('border-emerald-500', 'text-white');
            el.classList.add('border-transparent', 'text-slate-400');
        });

        document.getElementById(tabId).classList.remove('hidden');
        const activeBtn = document.getElementById('btn-' + tabId);
        activeBtn.classList.add('border-emerald-500', 'text-white');
        activeBtn.classList.remove('border-transparent', 'text-slate-400');
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
            'pending': '<span class="font-bold text-amber-400"><x-heroicon-o-clock class="w-5 h-5 inline-block mr-1" /> Menunggu Verifikasi</span>',
            'validated': '<span class="font-bold text-emerald-400"><x-heroicon-s-check class="w-3 h-3 inline-block" /> Terverifikasi</span>',
            'rejected': '<span class="font-bold text-rose-400">✗ Ditolak</span>',
        };

        // Set action routes
        const verifikasiForm = document.getElementById('action-verifikasi-form');
        if (verifikasiForm) verifikasiForm.action = `/admin/users/${user.id}`;

        document.getElementById('detail_name').textContent = user.name;
        document.getElementById('detail_status').innerHTML = statusMap[user.validation_status] || '-';
        document.getElementById('validation_note').value = user.validation_note || '';

        // Handle validation buttons
        const validationBtnContainer = document.getElementById('validation_buttons');
        validationBtnContainer.innerHTML = ''; // reset

        // Populate validation logs list
        const logsContainer = document.getElementById('validation_logs_list');
        logsContainer.innerHTML = '';

        if (logs.length === 0) {
            logsContainer.innerHTML = '<div class="text-slate-500 italic p-1">Belum ada riwayat validasi.</div>';
        } else {
            logs.forEach(log => {
                const date = new Date(log.created_at).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'});
                const statusBadge = log.status === 'matched' 
                    ? '<span class="text-emerald-400 font-bold bg-emerald-400/10 px-1 py-0.5 rounded text-[10px]">MATCH</span>'
                    : '<span class="text-rose-400 font-bold bg-rose-400/10 px-1 py-0.5 rounded text-[10px]">MISMATCH</span>';
                
                const logItem = document.createElement('div');
                logItem.className = 'border-b border-slate-900 pb-2 text-[11px]';
                logItem.innerHTML = `
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-slate-300">${log.source}</span>
                        ${statusBadge}
                    </div>
                    <div class="text-slate-400 mb-0.5">${log.notes}</div>
                    <div class="text-[9px] text-slate-500 flex justify-between">
                        <span>Petugas: ${log.checked_by ? 'Admin' : 'System'}</span>
                        <span>${date}</span>
                    </div>
                `;
                logsContainer.appendChild(logItem);
            });
        }

        if (user.account_type === 'lembaga') {
            document.getElementById('detail_title').textContent = 'Detail Lembaga';
            document.getElementById('detail_subtitle').textContent = 'Informasi legalitas dan validasi data lembaga';
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

            // Validation Buttons for Lembaga (AHU, OSS, NPWP)
            ['AHU', 'OSS', 'NPWP'].forEach(src => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.onclick = () => submitValidation(user.id, src);
                btn.className = 'bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-1.5 px-3 rounded-lg text-[10px] transition flex items-center gap-1';
                btn.innerHTML = `<x-heroicon-o-magnifying-glass class="w-5 h-5 inline-block mr-1" /> Cek ${src}`;
                validationBtnContainer.appendChild(btn);
            });
        } else {
            document.getElementById('detail_title').textContent = 'Detail Masyarakat';
            document.getElementById('detail_subtitle').textContent = 'Informasi profil diri dan validasi kependudukan';
            document.getElementById('detail_name_label').textContent = 'Nama Lengkap';

            document.getElementById('section_lembaga').classList.add('hidden');
            document.getElementById('section_masyarakat').classList.remove('hidden');

            document.getElementById('detail_nik').textContent = user.nik || '-';
            document.getElementById('detail_no_kk').textContent = user.no_kk || '-';
            document.getElementById('detail_kontak').textContent = user.kontak || '-';
            document.getElementById('detail_alamat').textContent = user.alamat || '-';

            // Validation Buttons for Masyarakat (Dukcapil, SIKS-NG)
            ['Dukcapil', 'SIKS-NG'].forEach(src => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.onclick = () => submitValidation(user.id, src);
                btn.className = 'bg-teal-600 hover:bg-teal-500 text-slate-950 font-bold py-1.5 px-3 rounded-lg text-[10px] transition flex items-center gap-1';
                btn.innerHTML = `<x-heroicon-o-magnifying-glass class="w-5 h-5 inline-block mr-1" /> Cek ${src}`;
                validationBtnContainer.appendChild(btn);
            });
        }

        openModal('user-detail-modal');
    }

    // JS helper to dynamically post validation checks
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
