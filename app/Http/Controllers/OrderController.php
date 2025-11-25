<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where ('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('customer.order', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.order')->with('error', 'Anda tidak memiliki akses');
        }
        return view('customer.show', compact('order'));
    }
}
