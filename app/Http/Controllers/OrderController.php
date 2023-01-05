<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Client;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::whereStatus(OrderStatus::PendingPayment)->get(),
            'orderStatuses' => OrderStatus::asSelectArray()
        ]);
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
            'user_id' => auth()->user()->id,
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

    public function payment(Order $order)
    {
        return view('orders.payment', compact('order'));
    }

    public function payOrder(Request $request, Order $order)
    {
        $data = $request->validate([
            'date' => 'required',
            'value' => 'required',
        ]);
        
        $paymentType = PaymentMethod::getDescription(PaymentMethod::InCash);

        if (count($data['value']) > 2)
        {
            $paymentType = PaymentMethod::getDescription(PaymentMethod::Installments);
        }

        $payment = Payment::create([
            'method' => $paymentType,
            'date' => Carbon::now()
        ]);

        foreach(array_filter($data['value']) as $installment => $value)
        {
            $payment->installments()->create([
                'date' => Carbon::now(),
                'price' => $value
            ]);
        }

        if (!is_null($payment->date))
        {
            $order->update([
                'payment_id' => $payment->id,
                'status' => OrderStatus::Paid
            ]);
        }

        return to_route('orders.index');
    }
}
