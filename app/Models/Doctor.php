<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clinic_id',
        'specialties',
        'type',
        'status',
        'license_number',
    ];

    /**
     * Quan hệ với model User (một bác sĩ thuộc về một user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function medicalRecord()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
