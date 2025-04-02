<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalFee extends Model
{
    protected $fillable = [
        'prescription_id',
        'clinical_test_order_id',
        'examination_fee',
        'medicine_fee',
        'clinical_fee',
        'total_fee'
    ];

    // Quan hệ với prescription
    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    // Quan hệ với clinical_test_order (nếu có)
    public function clinicalTestOrder()
    {
        return $this->belongsTo(ClinicalTestOrder::class);
    }

}
