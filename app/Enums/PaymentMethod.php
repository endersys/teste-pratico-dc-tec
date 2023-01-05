<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\{Enum\Enum, Enum\Attributes\Description};

final class PaymentMethod extends Enum
{
    #[Description('À vista')]
    const InCash = "inCash";
    #[Description('Parcelado')]
    const Installments = "installments";
}
