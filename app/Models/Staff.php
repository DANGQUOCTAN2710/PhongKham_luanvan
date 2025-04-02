<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clinic_id',
        'position',
        'phone',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
}
