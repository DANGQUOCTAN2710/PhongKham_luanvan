<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalTestResult extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'clinical_test_order_detail_id', 
        'result', 
        'file', 
        'status', 
        'verified_at', 
        'verified_by'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // Kết quả xét nghiệm thuộc về một chi tiết xét nghiệm
    public function orderDetail()
    {
        return $this->belongsTo(ClinicalTestOrderDetail::class, 'clinical_test_order_detail_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
