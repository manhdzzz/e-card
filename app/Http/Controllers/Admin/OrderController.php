<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Mail\OrderNotification;
use App\Helpers\MailHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Search by ID or Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by Date
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'cancel_reason' => 'required_if:status,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->status = $request->status;
        if ($request->status === 'cancelled') {
            $order->cancel_reason = $request->cancel_reason;
        }
        $order->save();

        // Send notification email for specific statuses
        $targetStatuses = ['shipped', 'completed', 'cancelled'];
        if ($oldStatus !== $order->status && in_array($order->status, $targetStatuses)) {
            try {
                MailHelper::setMailConfig();
                Mail::to($order->email)->send(new OrderNotification($order, 'update'));
            } catch (\Exception $e) {
                Log::channel('smtp')->error('Lỗi gửi mail cập nhật trạng thái đơn hàng #' . $order->id . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng thành công.');
    }


}
