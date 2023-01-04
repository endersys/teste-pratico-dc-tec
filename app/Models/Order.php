<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'price',
        'status',
        'user_id',
        'client_id',
        'payment_id'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getTotalPriceAttribute()
    {
        $price = 0.0;
        
        foreach($this->orderProducts as $item) {
            $price += $item->quantity * $item->product->price;
        }
        
        $this->price = $price;

        return $this->price;
    }
}
