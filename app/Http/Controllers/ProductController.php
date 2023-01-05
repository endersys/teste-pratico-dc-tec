<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $product = Product::create($data);

        notify()->success("$product->name salvo com sucesso!");

        return to_route('orders.create');
    }
}
