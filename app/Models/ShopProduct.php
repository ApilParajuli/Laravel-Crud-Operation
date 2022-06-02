<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["user_id", "product_type", "first_name", "main_name", "title", "price"];

    /**
     * Returns the relationship between this and User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the relationship between this and GameProduct model.
     */
    public function gameProduct()
    {
        return $this->hasOne(GameProduct::class);
    }

    /**
     * Returns the relationship between this and CdProduct model.
     */
    public function cdProduct()
    {
        return $this->hasOne(CdProduct::class);
    }

    /**
     * Returns the relationship between this and BookProduct model.
     */
    public function bookProduct()
    {
        return $this->hasOne(BookProduct::class);
    }
}
