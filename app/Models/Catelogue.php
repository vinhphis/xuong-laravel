<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catelogue extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $fillable = [
        'name',
        'cover',
        'is_active',
    ];

//    dùng để chuyển đổi dữ liệu
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
