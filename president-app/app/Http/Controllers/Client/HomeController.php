<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        Order::where('status', '!=', 2)->where('getBack', '<', now())->update(['status' => 3]);
        $orders = Order::where('recUserId', session()->get('client')->id)->orderByDesc('created_at')->with(['user', 'recUser'])->with(['book' => function ($query) {
            $query->with('cover');
        }])->paginate(100);
        return view('interfaces.client.home', compact('orders'));
    }
}
