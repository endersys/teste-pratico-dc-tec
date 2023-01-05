<?php

namespace App\Http\Controllers;

use App\Actions\Order\{ UpdateOrder, StoreOrder, PayOrder };
use App\Enums\OrderStatus;
use App\Http\Requests\{PayOrderRequest, StoreOrderRequest, UpdateOrderRequest };
use App\Models\{ Order, Product };

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

    public function store(StoreOrderRequest $request)
    {
        StoreOrder::run($request->validated());  
        
        notify()->success('Pedido cadastrado com sucesso!');

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

    public function update(UpdateOrderRequest $request, Order $order)
    {
        UpdateOrder::run($request->validated(), $order);    

        notify()->success('Pedido atualizado com sucesso!');

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

    public function payOrder(PayOrderRequest $request, Order $order)
    {
        PayOrder::run($request->validated(), $order);

        notify()->success('Pagamento efetuado com sucesso!');

        return to_route('orders.index');
    }
}
