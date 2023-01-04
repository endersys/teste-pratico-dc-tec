<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\{Enum\Enum, Enum\Attributes\Description};

final class OrderStatus extends Enum
{
    #[Description('Aguardando Pagamento')]
    const PendingPayment = "pendingPayment";
    #[Description('Pago')]
    const Paid = "paid";
}
