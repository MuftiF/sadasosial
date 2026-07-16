@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Top Header & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Manajemen Pengguna</h1>
            <p class="text-sm text-slate-400 mt-1">Kelola data pengguna, perbarui kata sandi, dan atur tingkat otorisasi peran.</p>
        </div>
        <div>
            <button onclick="openModal('create-modal')" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-sm font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                <span class="mr-1.5 font-black">+</span> Tambah User Baru
            </button>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="glass-panel rounded-2xl p-5 mb-8">
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
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
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
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold {{ $u->isAdmin() ? 'bg-indigo-400/10 text-indigo-400 ring-1 ring-inset ring-indigo-400/20' : 'bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($u->isLembaga())
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-violet-400/10 text-violet-400 ring-1 ring-inset ring-violet-400/20 w-fit">
                                            Lembaga
                                        </span>
                                        {{-- Validation status badge --}}
                                        @if($u->validation_status === 'pending')
                                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-amber-400/10 text-amber-400 ring-1 ring-inset ring-amber-400/20 w-fit">
                                                Pending
                                            </span>
                                        @elseif($u->validation_status === 'validated')
                                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20 w-fit">
                                                ✓ Terverifikasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-rose-400/10 text-rose-400 ring-1 ring-inset ring-rose-400/20 w-fit">
                                                ✗ Ditolak
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-sky-400/10 text-sky-400 ring-1 ring-inset ring-sky-400/20">
                                        Masyarakat
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $u->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex gap-2">
                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ json_encode($u) }})" class="inline-flex items-center justify-center rounded-lg bg-slate-800 px-3 py-1.5 text-xs font-bold text-slate-200 hover:bg-slate-700 hover:text-white transition">
                                        Edit
                                    </button>

                                    @if($u->isLembaga())
                                        <!-- View Lembaga Detail -->
                                        <button onclick="openLembagaDetailModal({{ json_encode($u) }})" class="inline-flex items-center justify-center rounded-lg bg-violet-500/10 px-3 py-1.5 text-xs font-bold text-violet-400 hover:bg-violet-500/20 transition">
                                            Detail
                                        </button>
                                    @endif

                                    <!-- Delete Form -->
                                    @if($u->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-rose-500/10 px-3 py-1.5 text-xs font-bold text-rose-400 hover:bg-rose-500/20 transition">
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

<!-- ================= CREATE USER MODAL ================= -->
<div id="create-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="glass-panel w-full max-w-lg rounded-2xl p-6 glow-emerald shadow-2xl relative animate-scale-up">
        <!-- Close Button -->
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
                    <option value="admin">Admin (Full Access)</option>
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
        <!-- Close Button -->
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
                    <option value="admin">Admin (Full Access)</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-900 mt-6">
                <button type="button" onclick="closeModal('edit-modal')" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 transition">Batal</button>
                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-xs font-bold text-white shadow-md hover:bg-indigo-500 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= LEMBAGA DETAIL MODAL ================= -->
<div id="lembaga-detail-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="glass-panel w-full max-w-lg rounded-2xl p-6 shadow-2xl relative animate-scale-up border border-violet-500/20" style="max-height:90vh; overflow-y:auto;">
        <!-- Close Button -->
        <button onclick="closeModal('lembaga-detail-modal')" class="absolute top-4 right-4 text-slate-400 hover:text-white text-lg">&times;</button>

        <h3 class="text-xl font-extrabold text-white mb-1">Detail Lembaga</h3>
        <p class="text-xs text-slate-500 mb-6">Informasi legalitas dan status verifikasi akun lembaga</p>

        <!-- Info Grid -->
        <div class="space-y-3 mb-6">
            <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Penanggung Jawab</span>
                <span id="detail_penanggung" class="text-xs text-white font-medium text-right">-</span>
            </div>
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
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat</span>
                <span id="detail_alamat" class="text-xs text-white font-medium text-right max-w-xs">-</span>
            </div>
            <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Dokumen Legalitas</span>
                <a id="detail_dokumen_link" href="#" target="_blank" class="text-xs text-emerald-400 hover:underline font-medium hidden">
                    Lihat Dokumen ↗
                </a>
            </div>
            <div class="flex justify-between gap-4 py-2 border-b border-slate-800/60">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Status Verifikasi</span>
                <span id="detail_status" class="text-xs font-medium text-right">-</span>
            </div>
            <div class="py-2">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide block mb-1">Catatan Admin</span>
                <span id="detail_note" class="text-xs text-slate-400 italic">-</span>
            </div>
        </div>

        <!-- Validation Actions -->
        <div class="flex flex-wrap gap-3 pt-4 border-t border-slate-900">
            <form id="validate-form" method="POST" class="inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="validation_action" value="validated">
                <button type="submit" onclick="return confirm('Setujui dan aktifkan akun lembaga ini?')"
                    class="rounded-xl bg-emerald-500/10 px-4 py-2 text-xs font-bold text-emerald-400 ring-1 ring-emerald-500/30 hover:bg-emerald-500/20 transition">
                    ✓ Setujui & Aktifkan
                </button>
            </form>
            <form id="reject-form" method="POST" class="inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="validation_action" value="rejected">
                <button type="submit" onclick="return confirm('Tolak pendaftaran lembaga ini?')"
                    class="rounded-xl bg-rose-500/10 px-4 py-2 text-xs font-bold text-rose-400 ring-1 ring-rose-500/30 hover:bg-rose-500/20 transition">
                    ✗ Tolak Pendaftaran
                </button>
            </form>
            <button type="button" onclick="closeModal('lembaga-detail-modal')"
                class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-400 ring-1 ring-slate-800 hover:bg-slate-800 transition ml-auto">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
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
        document.getElementById('edit_password').value = ''; // clear password input

        // Update form action dynamically
        const form = document.getElementById('edit-form');
        form.action = `/admin/users/${user.id}`;

        openModal('edit-modal');
    }

    function openLembagaDetailModal(user) {
        const jenisMap = {
            'perusahaan': 'Perusahaan',
            'lks': 'Lembaga Kesejahteraan Sosial (LKS)',
            'instansi_pemerintah': 'Instansi Pemerintah',
            'organisasi_sosial': 'Organisasi Sosial',
        };
        const statusMap = {
            'pending': '<span class="font-bold text-amber-400">⏳ Menunggu Verifikasi</span>',
            'validated': '<span class="font-bold text-emerald-400">✓ Terverifikasi</span>',
            'rejected': '<span class="font-bold text-rose-400">✗ Ditolak</span>',
        };
        document.getElementById('detail_penanggung').textContent = user.name;
        document.getElementById('detail_nama_lembaga').textContent = user.nama_lembaga || '-';
        document.getElementById('detail_jenis').textContent = jenisMap[user.jenis_lembaga] || '-';
        document.getElementById('detail_no_akta').textContent = user.no_akta || '-';
        document.getElementById('detail_npwp').textContent = user.npwp || '-';
        document.getElementById('detail_alamat').textContent = user.alamat_lembaga || '-';
        document.getElementById('detail_status').innerHTML = statusMap[user.validation_status] || '-';
        document.getElementById('detail_note').textContent = user.validation_note || 'Tidak ada catatan.';

        // Validate form action
        const validateForm = document.getElementById('validate-form');
        const rejectForm   = document.getElementById('reject-form');
        if (validateForm) validateForm.action = `/admin/users/${user.id}`;
        if (rejectForm)   rejectForm.action   = `/admin/users/${user.id}`;

        // Show/hide document link
        const docLink = document.getElementById('detail_dokumen_link');
        if (user.dokumen_legalitas) {
            docLink.href = `/storage/${user.dokumen_legalitas}`;
            docLink.classList.remove('hidden');
        } else {
            docLink.classList.add('hidden');
        }

        openModal('lembaga-detail-modal');
    }
</script>
@endsection
