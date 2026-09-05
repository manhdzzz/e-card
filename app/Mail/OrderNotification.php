<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $type; // 'confirmation' or 'update'

    public function __construct(Order $order, $type = 'confirmation')
    {
        $this->order = $order;
        $this->type = $type;
    }

    public function envelope(): Envelope
    {
        $subject = $this->type === 'confirmation' 
            ? 'Xác nhận đơn hàng #' . $this->order->id
            : 'Cập nhật trạng thái đơn hàng #' . $this->order->id;

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.notification',
        );
    }
}
