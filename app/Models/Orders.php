<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bingoCard() {
        return $this->belongsTo(BingoCards::class, 'bingo_card_id', 'id');
    }
}
