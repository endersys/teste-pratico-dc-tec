<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\{Enum\Enum, Enum\Attributes\Description};

final class PaymentMethod extends Enum
{
    #[Description('Dinheiro')]
    const Money = "money";
    #[Description('Cartão')]
    const Card = "card";
}
