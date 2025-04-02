<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'doctor_id',
        'notes',
        'total_price'
    ];

    public function details() {
        return $this->hasMany(PrescriptionDetail::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    // Mối quan hệ với bảng hospital_fees (một đơn thuốc có thể có nhiều viện phí)
    public function hospitalFees()
    {
        return $this->hasMany(HospitalFee::class);
    }
}
