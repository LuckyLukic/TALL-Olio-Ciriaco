<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'country',
        'city',
        'province',
        'postal_code',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
