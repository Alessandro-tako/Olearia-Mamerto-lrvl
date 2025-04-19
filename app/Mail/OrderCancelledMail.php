<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;  // La proprietà per memorizzare l'ordine

    /**
     * Crea una nuova istanza del messaggio.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;  // Memorizza l'ordine
    }

    /**
     * Costruisci il messaggio.
     *
     * @return $this
     */
    
    public function build()
    {
        return $this->to($this->order->user->email)  // Utilizza la proprietà $order
                    ->subject('Il tuo ordine è stato concellato!')
                    ->markdown('emails.orders.cancelled')
                    ->with(['order' => $this->order]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Il tuo ordine è stato concellato!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
