<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisitAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'clinic_id',
        'revisit_date',
        'status'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function clinic() {
        return $this->belongsTo(Clinic::class);
    }
}
