<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'medical_history',
        'allergies',
        'family_history',
    ];

    // Mỗi sổ bệnh thuộc về một bệnh nhân
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Một sổ bệnh có nhiều hồ sơ khám bệnh
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
