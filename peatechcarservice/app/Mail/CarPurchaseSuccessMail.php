<?php 

namespace App\Mail;

use App\Models\CarPurchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarPurchaseSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public CarPurchase $purchase;

    public function __construct(CarPurchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function build()
    {
        return $this
            ->subject('Car Purchase Confirmation')
            ->view('emails.car-purchase-success');
    }
}
