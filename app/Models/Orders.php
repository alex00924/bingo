<?php

namespace App\Models;

use App\Livewire\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bingoCard() {
        return $this->belongsTo(BingoCards::class, 'bingo_card_id', 'id');
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }
}
