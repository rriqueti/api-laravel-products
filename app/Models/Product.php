<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    
    protected $fillable = 
    [
        "name",
        "user_id",
        "description",
        "price",
        "status",
        "stocky_quantity",
    ];

    public function getStatusAttribute($value)
    {
        $statusMapping = [
            0 => 'Indisponível',
            1 => 'Disponível',
        ];

        return $statusMapping[$value] ?? 'Desconhecido';
    }


    
}
