<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticImaging extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'price'];

    public function clinicalTestOrderDetails()
    {
        return $this->hasMany(ClinicalTestOrderDetail::class, 'diagnostic_imaging_id');
    }
}
