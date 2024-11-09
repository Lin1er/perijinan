<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'student_class_id',
        'name',
        'born_date',
        'address',
        'username',
        'gender'
    ];

    protected $casts = [
        'born_date' => 'datetime',
    ];
    

    public function ijins(): HasMany
    {
        return $this->hasMany(Ijin::class);
    }

    public function studentClass(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function getGenderLabelAttribute()
    {
        return match ($this->gender) {
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
            default => 'Tidak Diketahui',  
        };
    }
}
