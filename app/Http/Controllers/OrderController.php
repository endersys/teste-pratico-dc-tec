<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(15);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create', [
            'products' => Product::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client' => 'required',
            'address' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $client = Client::create([
            'name' => $data['client'],
            'address' => $data['address']
        ]);

        $order = Order::create([
            'date' => Carbon::now(),
            'client_id' => $client->id,
            'user_id' => User::first()->id,
        ]);

        $products = array_combine($data['product_id'], $data['quantity']);

        foreach($products as $product => $value)
        {
            $order->orderProducts()->create([
                'product_id' => $product,
                'quantity' => $value
            ]);
        }

        return to_route('orders.index');
    }

    public function edit(Order $order)
    {
        $products = Product::all();

        return view('orders.edit', [
            'order' => $order,
            'products' => $products
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'client' => 'required',
            'address' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $order->client->update([
            'name' => $data['client'],
            'address' => $data['address']
        ]);

        $products = array_combine($data['product_id'], $data['quantity']);

        $order->orderProducts()->delete();

        foreach($products as $product => $value)
        {
            $order->orderProducts()->create([
                'product_id' => $product,
                'quantity' => $value
            ]);
        }

        return to_route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->orderProducts()->delete();

        $order->delete();

        return to_route('orders.index');
    }
}
