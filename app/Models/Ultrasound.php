<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ultrasound extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'price'];

    public function details()
    {
        return $this->hasMany(ClinicalTestOrderDetail::class, 'ultrasound_id');
    }
}
