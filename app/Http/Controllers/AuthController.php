<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Anda telah berhasil keluar.');
    }

    // =========================================================================
    // REGISTRASI LEMBAGA / PERUSAHAAN / INSTANSI (Subproses 1.2)
    // =========================================================================

    /**
     * Show the lembaga registration form.
     */
    public function showRegisterLembagaForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register-lembaga');
    }

    /**
     * Handle the lembaga registration request.
     * Stores all lembaga data and sets validation_status to 'pending'.
     */
    public function registerLembaga(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'nama_lembaga'      => ['required', 'string', 'max:255'],
            'jenis_lembaga'     => ['required', 'in:perusahaan,lks,instansi_pemerintah,organisasi_sosial'],
            'no_akta'           => ['required', 'string', 'max:100'],
            'npwp'              => ['required', 'digits:16'],
            'alamat_lembaga'    => ['required', 'string', 'max:1000'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'dokumen_legalitas' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'terms'             => ['accepted'],
        ], [
            'name.required'              => 'Nama penanggung jawab wajib diisi.',
            'nama_lembaga.required'      => 'Nama lembaga wajib diisi.',
            'jenis_lembaga.required'     => 'Jenis lembaga wajib dipilih.',
            'jenis_lembaga.in'           => 'Jenis lembaga tidak valid.',
            'no_akta.required'           => 'Nomor akta pendirian wajib diisi.',
            'npwp.required'              => 'NPWP wajib diisi.',
            'npwp.digits'                => 'NPWP harus terdiri dari 16 digit angka.',
            'alamat_lembaga.required'    => 'Alamat lembaga wajib diisi.',
            'email.required'             => 'Alamat email wajib diisi.',
            'email.email'                => 'Format alamat email tidak valid.',
            'email.unique'               => 'Alamat email ini sudah terdaftar.',
            'password.required'          => 'Kata sandi wajib diisi.',
            'password.min'               => 'Kata sandi minimal 8 karakter.',
            'password.confirmed'         => 'Konfirmasi kata sandi tidak cocok.',
            'dokumen_legalitas.required' => 'Dokumen legalitas wajib diunggah.',
            'dokumen_legalitas.mimes'    => 'Dokumen harus berformat PDF, JPG, atau PNG.',
            'dokumen_legalitas.max'      => 'Ukuran dokumen maksimal 5MB.',
            'terms.accepted'             => 'Anda harus menyetujui syarat & ketentuan.',
        ]);

        // Store uploaded document
        $dokumenPath = $request->file('dokumen_legalitas')->store('legalitas', 'public');

        // Create user with lembaga account_type and pending validation
        User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'password'          => Hash::make($validated['password']),
            'role'              => 'user',
            'account_type'      => 'lembaga',
            'nama_lembaga'      => $validated['nama_lembaga'],
            'jenis_lembaga'     => $validated['jenis_lembaga'],
            'no_akta'           => $validated['no_akta'],
            'npwp'              => $validated['npwp'],
            'alamat_lembaga'    => $validated['alamat_lembaga'],
            'dokumen_legalitas' => $dokumenPath,
            'validation_status' => 'pending',
            'validation_note'   => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran lembaga berhasil! Akun Anda sedang menunggu verifikasi oleh admin. Kami akan menghubungi Anda melalui email setelah proses verifikasi selesai.');
    }

    // =========================================================================
    // REGISTRASI MASYARAKAT (Subproses 1.1)
    // =========================================================================

    /**
     * Show the masyarakat registration form.
     */
    public function showRegisterMasyarakatForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register-masyarakat');
    }

    /**
     * Handle the masyarakat registration request.
     */
    public function registerMasyarakat(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'nik'      => ['required', 'digits:16', 'unique:users,nik'],
            'no_kk'    => ['required', 'digits:16'],
            'kontak'   => ['required', 'string', 'max:20'],
            'alamat'   => ['required', 'string', 'max:1000'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms'    => ['accepted'],
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'nik.required'       => 'NIK wajib diisi.',
            'nik.digits'         => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique'         => 'NIK ini sudah terdaftar.',
            'no_kk.required'     => 'Nomor Kartu Keluarga wajib diisi.',
            'no_kk.digits'       => 'Nomor Kartu Keluarga harus terdiri dari 16 digit angka.',
            'kontak.required'    => 'Nomor kontak wajib diisi.',
            'alamat.required'    => 'Alamat wajib diisi.',
            'email.required'     => 'Alamat email wajib diisi.',
            'email.email'        => 'Format alamat email tidak valid.',
            'email.unique'       => 'Alamat email ini sudah terdaftar.',
            'password.required'  => 'Kata sandi wajib diisi.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'terms.accepted'     => 'Anda harus menyetujui syarat & ketentuan.',
        ]);

        User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'password'          => Hash::make($validated['password']),
            'role'              => 'user',
            'account_type'      => 'masyarakat',
            'nik'               => $validated['nik'],
            'no_kk'             => $validated['no_kk'],
            'kontak'            => $validated['kontak'],
            'alamat'            => $validated['alamat'],
            'validation_status' => 'pending',
            'validation_note'   => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran akun masyarakat berhasil! Akun Anda sedang menunggu verifikasi oleh admin. Kami akan menghubungi Anda setelah proses verifikasi selesai.');
    }

    /**
     * Show the pending status view.
     */
    public function showPendingStatus()
    {
        return view('auth.status-pending');
    }

    /**
     * Show the rejected status view.
     */
    public function showRejectedStatus()
    {
        return view('auth.status-rejected');
    }

    /**
     * Handle registration resubmission for rejected accounts.
     */
    public function resubmitRegistration(Request $request)
    {
        $user = Auth::user();

        if ($user->isLembaga()) {
            $validated = $request->validate([
                'name'              => ['required', 'string', 'max:255'],
                'nama_lembaga'      => ['required', 'string', 'max:255'],
                'jenis_lembaga'     => ['required', 'in:perusahaan,lks,instansi_pemerintah,organisasi_sosial'],
                'no_akta'           => ['required', 'string', 'max:100'],
                'npwp'              => ['required', 'digits:16'],
                'alamat_lembaga'    => ['required', 'string', 'max:1000'],
                'dokumen_legalitas' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            ], [
                'name.required'           => 'Nama penanggung jawab wajib diisi.',
                'nama_lembaga.required'   => 'Nama lembaga wajib diisi.',
                'jenis_lembaga.required'  => 'Jenis lembaga wajib dipilih.',
                'no_akta.required'        => 'Nomor akta pendirian wajib diisi.',
                'npwp.required'           => 'NPWP wajib diisi.',
                'npwp.digits'             => 'NPWP harus terdiri dari 16 digit angka.',
                'alamat_lembaga.required' => 'Alamat lembaga wajib diisi.',
                'dokumen_legalitas.mimes' => 'Dokumen harus berformat PDF, JPG, atau PNG.',
                'dokumen_legalitas.max'   => 'Ukuran dokumen maksimal 5MB.',
            ]);

            $updateData = [
                'name'              => $validated['name'],
                'nama_lembaga'      => $validated['nama_lembaga'],
                'jenis_lembaga'     => $validated['jenis_lembaga'],
                'no_akta'           => $validated['no_akta'],
                'npwp'              => $validated['npwp'],
                'alamat_lembaga'    => $validated['alamat_lembaga'],
                'validation_status' => 'pending',
                'validation_note'   => null,
            ];

            if ($request->hasFile('dokumen_legalitas')) {
                $dokumenPath = $request->file('dokumen_legalitas')->store('legalitas', 'public');
                $updateData['dokumen_legalitas'] = $dokumenPath;
            }

            $user->update($updateData);

        } else {
            $validated = $request->validate([
                'name'   => ['required', 'string', 'max:255'],
                'nik'    => ['required', 'digits:16', 'unique:users,nik,' . $user->id],
                'no_kk'  => ['required', 'digits:16'],
                'kontak' => ['required', 'string', 'max:20'],
                'alamat' => ['required', 'string', 'max:1000'],
            ], [
                'name.required'   => 'Nama lengkap wajib diisi.',
                'nik.required'    => 'NIK wajib diisi.',
                'nik.digits'      => 'NIK harus terdiri dari 16 digit angka.',
                'nik.unique'      => 'NIK ini sudah terdaftar.',
                'no_kk.required'  => 'Nomor Kartu Keluarga wajib diisi.',
                'no_kk.digits'    => 'Nomor Kartu Keluarga harus terdiri dari 16 digit angka.',
                'kontak.required' => 'Nomor kontak wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',
            ]);

            $user->update([
                'name'              => $validated['name'],
                'nik'               => $validated['nik'],
                'no_kk'             => $validated['no_kk'],
                'kontak'            => $validated['kontak'],
                'alamat'            => $validated['alamat'],
                'validation_status' => 'pending',
                'validation_note'   => null,
            ]);
        }

        return redirect()->route('account.pending')
            ->with('success', 'Data perbaikan pendaftaran berhasil dikirim. Akun Anda sedang kembali dalam proses verifikasi.');
    }
}

