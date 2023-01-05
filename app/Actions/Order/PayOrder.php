<?php

namespace App\Actions\Order;

use App\Enums\{OrderStatus, PaymentMethod};
use App\Models\{Order, Payment};
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class PayOrder
{
    use AsAction;

    public function handle(array $data, Order $order)
    {
        $paymentType = PaymentMethod::getDescription(PaymentMethod::InCash);

        if (count($data['value']) > 2) {
            $paymentType = PaymentMethod::getDescription(PaymentMethod::Installments);
        }

        try {
            DB::beginTransaction();

            $payment = Payment::create([
                'method' => $paymentType,
                'date' => Carbon::now()
            ]);

            foreach (array_filter($data['value']) as $installment => $value) {
                $payment->installments()->create([
                    'date' => Carbon::now(),
                    'price' => $value
                ]);
            }

            if (!is_null($payment->date)) {
                $order->update([
                    'payment_id' => $payment->id,
                    'status' => OrderStatus::Paid
                ]);
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
