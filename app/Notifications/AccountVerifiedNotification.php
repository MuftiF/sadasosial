<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountVerifiedNotification extends Notification
{
    use Queueable;

    public User $user;
    public ?string $note;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, ?string $note = null)
    {
        $this->user = $user;
        $this->note = $note;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $name = $this->user->isLembaga() ? $this->user->nama_lembaga : $this->user->name;
        $loginUrl = route('login');

        $mailMessage = (new MailMessage)
            ->subject('[SadaSosial] Akun Anda Telah Berhasil Diverifikasi')
            ->greeting('Yth. ' . $name . ',')
            ->line('Selamat! Pendaftaran akun Anda pada sistem SadaSosial telah **berhasil diverifikasi** oleh tim verifikator.')
            ->line('Akun Anda telah diaktifkan dan **siap digunakan** untuk mengakses seluruh layanan dan fasilitas perizinan sosial.');

        if (!empty($this->note)) {
            $mailMessage->line('**Catatan Verifikator:** ' . $this->note);
        }

        return $mailMessage
            ->action('Masuk ke Akun Anda', $loginUrl)
            ->line('Terima kasih telah mendaftar dan menggunakan sistem SadaSosial.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'status' => 'validated',
            'note' => $this->note,
        ];
    }
}
