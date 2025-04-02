<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ingredient', 'manufacturer', 'dosage', 'unit', 'instructions', 'price', 'stock', 'status'
    ];

    public function updateStock($quantity)
    {
        $this->stock -= $quantity;
        $this->status = $this->stock > 0 ? 'Còn hàng' : 'Hết hàng';
        $this->save();
    }
}
