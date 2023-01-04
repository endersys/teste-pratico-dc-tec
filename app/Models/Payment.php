<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'method'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
