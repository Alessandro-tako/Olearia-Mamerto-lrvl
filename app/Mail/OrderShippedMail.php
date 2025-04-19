<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShippedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Crea una nuova istanza del messaggio.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;  // Salva l'oggetto ordine
    }

    /**
     * Imposta l'email.
     */
    public function build()
    {
        // Imposta il destinatario dell'email
        return $this->to($this->order->user->email)  // Assicurati che $this->order contenga i dati dell'ordine
                    ->subject('Il tuo ordine è stato spedito!')
                    ->view('emails.order_shipped')  // Vista dell'email
                    ->with(['order' => $this->order]);  // Passa i dati dell'ordine alla vista
    }

    /**
     * Ottieni la busta del messaggio.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Il tuo ordine è stato spedito!',
        );
    }

    /**
     * Ottieni la definizione del contenuto del messaggio.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.shipped',  // Usa una vista markdown per il corpo dell'email (se preferisci)
        );
    }

    /**
     * Ottieni gli allegati per il messaggio.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
