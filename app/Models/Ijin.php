<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijin extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id',
        'reason',
        'date_pick',
        'date_return',
        'date_returned',
        'status',
        'attachments',
        'notes',
    ];

    protected $casts = [
        'attachments' => 'json',
        'date_pick' => 'datetime',
        'date_return' => 'datetime',
        'date_returned' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk menampilkan label status.
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'wait_approval' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'picked_up' => 'Telah Dijemput',
            'returned' => 'Sudah Kembali',
            'done' => 'Selesai',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Accessor untuk menampilkan catatan jika tidak ada nilai.
     */
    public function getNotesAttribute($value)
    {
        return $value ?: 'Tidak ada catatan';
    }
}
