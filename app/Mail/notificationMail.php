<?php

namespace App\Mail;

use App\Models\Gimnasta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class notificationMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $nombreGimnasta;
    public $action;
    /**
     * Create a new message instance.
     */
    public function __construct(string $nombreGimnasta, string $action)
    {
        $this->nombreGimnasta = $nombreGimnasta;
        $this->action = $action; //inicializa la variable con los parámetros asignados
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Actualización en tabla gimnastas',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.notificationMail',
            with: [
                'nombreGimnasta' => $this->nombreGimnasta,
                'action' => $this->action,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
