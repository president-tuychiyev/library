<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        Order::where('status', '!=', 2)->where('getBack', '<', now())->update(['status' => 3]);
        $orders = Order::orderByDesc('created_at')->with(['user', 'recUser'])->with(['book' => function ($query) {
            $query->with('cover');
        }])->paginate(100);
        return view('interfaces.admin.orders', compact('orders'));
    }

    public function update($id, $status)
    {
        Order::where('id', $id)->update([ 'status' => $status, 'returned' => now() ]);
        return redirect()->back()->with('msg', __('lang.update.success'));
    }
}
