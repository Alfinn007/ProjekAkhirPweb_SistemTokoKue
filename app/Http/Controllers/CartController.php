<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('customer.cart', compact('carts'));
    }

    public function addToCart(Request $request, $productId)
    {
        $user_id = Auth::id();
        $existingCart = Cart::where('user_id', $user_id)->where('product_id', $productId)->first();

        if ($existingCart) {
            $existingCart->quantity += 1;
            $existingCart->save();
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Produk masuk keranjang! 🛒');
    }

    public function destroy($id)
    {
        Cart::find($id)->delete();
        return redirect()->back()->with('success', 'Item dihapus.');
    }

    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        DB::transaction(function () use ($user_id, $total, $carts) {

            $order = Order::create([
                'user_id' => $user_id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $total,
                'status' => 'pending'
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'total' => $cart->product->price * $cart->quantity,
                ]);
            }
        Cart::where('user_id', $user_id)->delete();
        });

        return redirect()->route('customer.dashboard')->with('success', 'Checkout Berhasil! Pesanan dibuat.');
    }

    public function checkoutPage()
    {
        $user_id = Auth::id();
        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $subtotal = 0;
        foreach($carts as $cart) {
            $subtotal += $cart->product->price * $cart->quantity;
        }

        $shippingCost = 15000;
        $grandTotal = $subtotal + $shippingCost;

        return view('customer.checkout', compact('carts', 'subtotal', 'shippingCost', 'grandTotal'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if ($carts->isEmpty()) return back();

        $subtotal = 0;
        foreach($carts as $cart) {
            $subtotal += $cart->product->price * $cart->quantity;
        }
        $shippingCost = 15000;
        $grandTotal = $subtotal + $shippingCost;

        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return redirect()->back()->with('error', 'Stok untuk produk ' . $cart->product->name . ' tidak mencukupi.');
            }
        }

        DB::transaction(function () use ($user_id, $request, $carts, $grandTotal, $shippingCost) {

            $order = Order::create([
                'user_id' => $user_id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $grandTotal,
                'shipping_cost' => $shippingCost,
                'grand_total' => $grandTotal,
                'status' => 'pending',
                'delivery_address' => $request->address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'total' => $cart->product->price * $cart->quantity,
                ]);

                $cart->product->decrement('stock', $cart->quantity);
            }

            Cart::where('user_id', $user_id)->delete();
        });

        return redirect()->route('customer.dashboard')->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi.');
    }

}
