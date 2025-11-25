<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        $totalCustomers = User::where('role', 'user')->count();

        return view('admin.home', compact(
            'totalProducts', 'totalOrders', 'totalRevenue', 'totalCustomers'
        ));
    }
}
