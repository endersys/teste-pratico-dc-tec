<?php

namespace App\Actions\Product;

use App\Models\Order;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOrderProducts
{
    use AsAction;

    public function handle(array $arr1, array $arr2, Order $order)
    {
        $products = array_combine($arr1, $arr2);

        try {
            DB::beginTransaction();

            foreach($products as $product => $value)
            {
                $order->orderProducts()->create([
                    'product_id' => $product,
                    'quantity' => $value
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
