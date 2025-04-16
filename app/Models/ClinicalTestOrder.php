<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalTestOrder extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_id', 'doctor_id', 'status'];

    // Một phiếu chỉ định thuộc về một hồ sơ bệnh án
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    // Một phiếu chỉ định được tạo bởi một bác sĩ
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Một phiếu chỉ định có nhiều xét nghiệm
    public function details()
    {
        return $this->hasMany(ClinicalTestOrderDetail::class);
    }

    public function patient()
    {
        return $this->hasOneThrough(
            Patient::class, // Model cần lấy
            MedicalRecord::class, // Model trung gian
            'id', // Khóa chính của MedicalRecord
            'id', // Khóa chính của Patient
            'medical_record_id', // FK ở bảng ClinicalTestOrder
            'medical_book_id' // FK ở bảng MedicalRecord liên kết đến MedicalBook
        );
    }

    public function hospitalFees()
    {
        return $this->hasMany(HospitalFee::class);
    }

    public function clinicalTest()
    {
        return $this->belongsTo(ClinicalTest::class);
    }
}
