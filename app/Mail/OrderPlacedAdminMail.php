<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Crea una nuova istanza del messaggio.
     *
     * @param Order $order
     * @return void
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
        return $this->to('admin@example.com')
                    ->subject('Nuovo ordine ricevuto')
                    ->markdown('emails.orders.admin.placed')
                    ->with(['order' => $this->order]);
    }
}
