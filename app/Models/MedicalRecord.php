<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'medical_book_id',
        'doctor_id',
        'clinic_id',
        'exam_date',
        'reason',
        'status',
        'diagnosis',
        'main_disease',
        'sub_disease',
        'treatment_type',  
        'notes',
        'weight',
        'height',
        'bmi',
        'temperature',
        'pulse',
        'spo2',
    ];


    // Mỗi hồ sơ khám bệnh thuộc về một sổ bệnh
    public function medicalBook()
    {
        return $this->belongsTo(MedicalBook::class);
    }

    // Mỗi hồ sơ khám bệnh do một bác sĩ thực hiện
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Mỗi hồ sơ khám bệnh thuộc về một phòng khám
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}
