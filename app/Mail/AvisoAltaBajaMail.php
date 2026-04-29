<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AvisoAltaBajaMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $accion
    ) {}

    public function envelope(): Envelope
    {
        $asunto = $this->accion === 'alta'
            ? 'Tu cuenta ha sido activada — Aureus'
            : 'Tu cuenta ha sido desactivada — Aureus';

        return new Envelope(subject: $asunto);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.aviso_alta_baja',
        );
    }
}