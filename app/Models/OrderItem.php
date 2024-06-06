<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public static function boot(): void
    {
        parent::boot();
        static::saving(function ($model) {
            $model->unit_price = $model->item->price;
            $model->total = $model->unit_price * $model->quantity - $model->discount;
        });
    }
}
