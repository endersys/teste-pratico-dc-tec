<?php

namespace App\Actions\Order;

use App\Actions\Product\CreateOrderProducts;
use App\Models\{Client, Order};
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrder
{
    use AsAction;

    public function handle(array $data)
    {
        try {
            DB::beginTransaction();

            $client = Client::create([
                'name' => $data['client'],
                'address' => $data['address']
            ]);

            $order = Order::create([
                'date' => Carbon::now(),
                'client_id' => $client->id,
                'user_id' => auth()->user()->id,
            ]);

            CreateOrderProducts::run($data['product_id'], $data['quantity'], $order);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
