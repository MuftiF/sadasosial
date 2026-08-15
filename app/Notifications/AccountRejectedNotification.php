<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountRejectedNotification extends Notification
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
            ->subject('[SadaSosial] Pemberitahuan Status Verifikasi Akun')
            ->greeting('Yth. ' . $name . ',')
            ->line('Mohon maaf, pendaftaran akun Anda pada sistem SadaSosial **belum dapat disetujui** setelah dilakukan pemeriksaan data oleh tim verifikator.');

        if (!empty($this->note)) {
            $mailMessage->line('**Alasan / Catatan Penolakan:** ' . $this->note);
        } else {
            $mailMessage->line('**Alasan / Catatan Penolakan:** Berkas atau identitas belum memenuhi persyaratan yang ditentukan.');
        }

        return $mailMessage
            ->line('Anda dapat masuk ke akun Anda untuk memperbarui dan mengunggah ulang kelengkapan data pendaftaran.')
            ->action('Perbaiki Data Pendaftaran', $loginUrl)
            ->line('Terima kasih atas perhatian Anda.');
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
            'status' => 'rejected',
            'note' => $this->note,
        ];
    }
}
