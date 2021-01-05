<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PenyediaKerja;
use App\Models\User;

class PerusahaanBaru extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $perusahaan,$user,$message;
    public function __construct(PenyediaKerja $perusahaan,User $user)
    {
        $this->perusahaan = $perusahaan;
        $this->user = $user;
        $this->message = "{$user->username} mengajukan perusahaan {$perusahaan->nama_perusahaan}, segera validasi!";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'username' => $this->user->username,
            'nama_perusahaan' => $this->perusahaan->nama_perusahaan,
            'message' => $this->message
        ];
    }
}
