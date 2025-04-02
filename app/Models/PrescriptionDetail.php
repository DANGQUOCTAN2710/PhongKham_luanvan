<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{   
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'dosage',
        'quantity',
        'total_price'
    ];

    public function prescription() {
        return $this->belongsTo(Prescription::class);
    }

    public function medicine() {
        return $this->belongsTo(Medicine::class);
    }//
}
