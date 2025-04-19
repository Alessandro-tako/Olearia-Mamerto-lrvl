<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class OrderPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;  // Aggiungi questa proprietà per memorizzare l'ordine

    /**
     * Crea una nuova istanza del messaggio.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;  // Memorizza l'ordine nella proprietà
    }

    /**
     * Costruisci il messaggio.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->to($this->order->user->email)  // Utilizza la proprietà $order
                    ->subject('Grazie per il tuo acquisto!')
                    ->markdown('emails.orders.paid')
                    ->with(['order' => $this->order]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Grazie per il tuo acquisto!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.paid',
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
