<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ijin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'student_id',
        'class',
        'reason',
        'attachment_link',
        'date_pick',
        'date_return',
        'returned_at',
        'medic_attachment_link',
        'return_attachment_link',
    ];

    /**
     * Get the student that owns the ijin.
    */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the user that owns the ijin.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
