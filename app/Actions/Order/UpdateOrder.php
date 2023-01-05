<?php

namespace App\Actions\Order;

use App\Actions\Product\CreateOrderProducts;
use App\Models\Order;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateOrder
{
    use AsAction;

    public function handle(array $data, Order $order)
    {
        try {
            DB::beginTransaction();

            $order->client->update([
                'name' => $data['client'],
                'address' => $data['address']
            ]);
            
            $order->orderProducts()->delete();
            
            CreateOrderProducts::run($data['product_id'], $data['quantity'], $order);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
