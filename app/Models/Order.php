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
        'client_id',
        'payment_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function seller()
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
}
