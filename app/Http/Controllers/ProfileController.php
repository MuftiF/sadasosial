<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the profile and log changes.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kontak' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        $changesToLog = [];

        foreach (['name', 'kontak', 'alamat'] as $field) {
            if ($user->$field !== $validated[$field]) {
                $changesToLog[] = [
                    'user_id' => $user->id,
                    'field_changed' => $field,
                    'old_value' => $user->$field,
                    'new_value' => $validated[$field],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($changesToLog)) {
            // Update user
            $user->update($validated);

            // Log changes
            DB::table('profile_changes')->insert($changesToLog);
        }

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
}
