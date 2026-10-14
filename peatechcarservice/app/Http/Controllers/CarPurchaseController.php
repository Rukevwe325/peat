<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CarPurchaseSuccessMail;

use App\Models\Car;
use App\Models\CarPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CarPurchaseController extends Controller
{
    public function initiate(Car $car)
    {
        $user = Auth::user();

        $ticketId = 'CAR-' . strtoupper(Str::random(10));

        $purchase = CarPurchase::create([
            'ticket_id' => $ticketId,
            'user_id' => $user->id,
            'amount' => $car->price * 100, // Paystack expects kobo
            'car_details' => [
                'admin_id' => $car->admin_id ?? null,
                'model' => $car->model,
                'year' => $car->year,
                'price' => $car->price,
                'car_id' => $car->id,
            ],
        ]);

        $response = Http::withToken(config('services.paystack.secret'))
            ->post(config('services.paystack.url') . '/transaction/initialize', [
                'email' => $user->email,
                'amount' => $purchase->amount,
                'reference' => $ticketId,
                'callback_url' => route('payment.callback'),
                'metadata' => [
                    'purchase_id' => $purchase->id,
                ],
            ]);

        if (!$response->successful()) {
            return back()->with('error', 'Unable to initiate payment.');
        }

        return redirect($response['data']['authorization_url']);
    }

    public function callback(Request $request)
    {
        $reference = $request->reference;

        $verify = Http::withToken(config('services.paystack.secret'))
            ->get(config('services.paystack.url') . "/transaction/verify/{$reference}");

        if (!$verify->successful() || $verify['data']['status'] !== 'success') {
            CarPurchase::where('ticket_id', $reference)
                ->update(['status' => 'failed']);

            return redirect()->route('payment.failed');
        }

        CarPurchase::where('ticket_id', $reference)->update([
            'status' => 'paid',
            'paystack_reference' => $reference,
        ]);
        $purchase = CarPurchase::with('user')->where('ticket_id', $reference)->first();
        // Send confirmation email
        Mail::to($purchase->user->email)
            ->send(new CarPurchaseSuccessMail($purchase));

        return redirect()->route('payment.success');
    }
}
