<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_FIXED = 'fixed_price';
    const TYPE_PERCENTAGE = 'percentage_price';

    protected $fillable = [
        'name',
        'code',
        'discount',
        'quantity',
        'min_price',
        'total',
        'type',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
