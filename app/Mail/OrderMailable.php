<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $user;
    public $order;

    public function __construct($order, $user)
    {
        $this->cart = session("cart");  // giỏ hàng đang session
        $this->user = $user;            // truyền trực tiếp user
        $this->order = $order;          // truyền trực tiếp order
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Xác nhận đơn hàng',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.order',
        );
    }

    public function attachments()
    {
        return [];
    }
}
