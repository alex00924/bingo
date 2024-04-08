<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPrice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getPrice() {
        $cardPrice = CardPrice::first();
        if (empty($cardPrice)) {
            return 10;
        }

        return $cardPrice->price;
    }

    public static function setPrice($price) {
        $cardPrice = CardPrice::first();
        if (empty($cardPrice)) {
            CardPrice::create([
                'price' => $price
            ]);
        } else {
            $cardPrice->price = $price;
            $cardPrice->save();
        }
    }
}
