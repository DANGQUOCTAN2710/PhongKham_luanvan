<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',    
        'idUser',
        'dob',
        'age',     
        'gender',
        'phone',   
        'address', 
    ];
    /**
     * Quan hệ với model User (một bệnh nhân thuộc về một user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicalBook()
    {
        return $this->hasOne(MedicalBook::class);
    }
}