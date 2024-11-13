<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whacenter extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->default == 1) {
                self::where('default', 1)->where('id', '!=', $model->id)->update(['default' => 0]);
            }
        });
    }

    protected $fillable = [
        'name',
        'device_id',
        'default',
    ];

    public function getDefaultStatus()
    {
        return match ($this->default) {
            1 => 'Default',
            0 => 'Not Default',
        };
    }
}
