<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["shop_product_id", "pegi"];

    /**
     * Returns the relationship between this and ShopProduct model.
     */
    public function shopProduct()
    {
        return $this->belongsTo(ShopProduct::class);
    }
}
