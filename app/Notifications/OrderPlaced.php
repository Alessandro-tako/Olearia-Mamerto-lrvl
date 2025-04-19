<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderPlaced extends Notification
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Conferma del tuo ordine')
                    ->view('emails.orders.paid', [
                        'order' => $this->order,
                    ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'total_amount' => $this->order->total_amount,
        ];
    }
}
