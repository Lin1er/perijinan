<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'username',
        'full_name',
        'class'
    ];

    public function ijins(): HasMany
    {
        return $this->hasMany(Ijin::class);
    }
}
