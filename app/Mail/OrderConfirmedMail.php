<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmedMail extends Mailable
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
        if ($this->order->user) {
            return $this->to($this->order->user->email)
                        ->subject('Il tuo ordine è confermato!')
                        ->view('emails.order_confirmed')
                        ->with(['order' => $this->order]);
        } else {
            // Gestisci il caso in cui l'utente non esiste
            throw new \Exception("L'ordine non è associato a un utente valido.");
        }
    }
    

    /**
     * Ottieni la busta del messaggio.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Il tuo ordine è stato confermato!',
        );
    }

    /**
     * Ottieni la definizione del contenuto del messaggio.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.confirmed',  // Usa una vista markdown per il corpo dell'email (se preferisci)
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
