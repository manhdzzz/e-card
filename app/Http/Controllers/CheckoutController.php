<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderNotification;
use App\Helpers\MailHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^(0|\+84)[3|5|7|8|9][0-9]{8}$/',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'note' => 'nullable|string',
        ]);

        try {
            $data = $validated;
            if (auth()->check()) {
                $data['email'] = auth()->user()->email;
            }
            $order = Order::create($data);

            // Send confirmation email
            try {
                MailHelper::setMailConfig();
                Mail::to($order->email)->send(new OrderNotification($order, 'confirmation'));
            } catch (\Exception $e) {
                Log::channel('smtp')->error('Lỗi gửi mail xác nhận đơn hàng #' . $order->id . ': ' . $e->getMessage());
            }

            return redirect()->route('checkout.success', ['order' => $order->id]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
