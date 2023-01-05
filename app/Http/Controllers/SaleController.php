<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Enums\OrderStatus;
use App\Models\Order;

class SaleController extends Controller
{
    public function index()
    {
        return view('sales.index', [
            'sales' => Order::whereStatus(OrderStatus::Paid)->get(),
            'saleStatuses' => OrderStatus::asSelectArray()
        ]);
    }

    public function generatePDF(Order $order)
    {
        $pdf = Pdf::loadView('sales.pdf', compact('order'));

        return $pdf->download('sales.pdf');
    }
}
