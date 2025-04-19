<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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
        $this->order = $order;
    }

    /**
     * Costruisci il messaggio email.
     */
    public function build()
    {
        if (!$this->order->user) {
            throw new \Exception("L'ordine non è associato a un utente valido.");
        }

        return $this->to($this->order->user->email)
                    ->subject('Il tuo ordine è stato confermato!')
                    ->markdown('emails.orders.confirmed')
                    ->with(['order' => $this->order]);
    }
}
