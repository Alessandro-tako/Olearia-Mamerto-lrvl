<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPaidMail extends Mailable
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
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->user->email)
                    ->subject('Grazie per il tuo acquisto!')
                    ->markdown('emails.orders.paid')
                    ->with(['order' => $this->order]);
    }
}
