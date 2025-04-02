<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalTestOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['clinical_test_order_id', 'clinical_test_id', 'ultrasound_id', 'diagnostic_imaging_id', 'status'];

    // Một chi tiết thuộc về một phiếu chỉ định
    public function order()
    {
        return $this->belongsTo(ClinicalTestOrder::class, 'clinical_test_order_id');
    }

    // Một chi tiết liên kết với một loại xét nghiệm
    public function clinicalTest()
    {
        return $this->belongsTo(ClinicalTest::class, 'clinical_test_id');
    }

    public function ultrasound()
    {
        return $this->belongsTo(Ultrasound::class, 'ultrasound_id');
    }

    public function diagnosticImaging()
    {
        return $this->belongsTo(DiagnosticImaging::class, 'diagnostic_imaging_id');
    }

    public function testResult() {
        return $this->hasOne(ClinicalTestResult::class, 'clinical_test_order_detail_id');
    }
}