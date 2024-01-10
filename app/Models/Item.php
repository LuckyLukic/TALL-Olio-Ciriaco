<?php

namespace App\Models;


use App\Models\Image;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_type',
        'liters',
        'description',
        'price',
        'quantity'
    ];

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }


}
