<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalTest extends Model
{
    use HasFactory;

    protected $fillable = ['test_code', 'test_name', 'category', 'price'];

    public function details()
    {
        return $this->hasMany(ClinicalTestOrderDetail::class, 'clinical_test_id');
    }
}
