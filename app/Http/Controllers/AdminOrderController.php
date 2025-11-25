<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderController extends Controller
{
    public function exportPdf()
    {
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'user')->count();
        $orders = Order::with('user')->orderBy('created_at', 'desc')->take(20)->get();
        $pdf = Pdf::loadView('admin.pdf', compact(
            'totalRevenue', 'totalOrders', 'totalProducts', 'totalCustomers', 'orders'
        ));

        return $pdf->download('Laporan-Toko-Jajanyuk.pdf');
    }

    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.order', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->load('items.product');

        if ($request->status == 'cancelled' && $order->status != 'cancelled') {

            if ($order->items && $order->items->count() > 0) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }
        }

        $order->update([
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.dashboard_admin', compact('order'));
    }
}
