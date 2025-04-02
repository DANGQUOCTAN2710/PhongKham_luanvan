<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'address', 
        'phone', 
        'email',
        'user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }

    public function staff(){
        return $this->hasMany(Staff::class);
    }

    public function clinicTests()
    {
        return $this->hasMany(ClinicalTest::class);
    }

    public function medicalRecord(){
        return $this->hasMany(MedicalRecord::class);
    }
}
