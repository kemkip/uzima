<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->patient_number = 'PO-' . str_pad(static::max('id') + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}
