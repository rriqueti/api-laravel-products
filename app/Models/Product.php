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
        "description",
        "price",
        "status",
        "stocky_quantity",
    ];

    public function status_alias($value)
    {
        $status_alias = [
            0 => 'Indisponível',
            1 => 'Disponível',
        ];

        return $status_alias[$value] ?? 'Desconhecido';
    }
    
}
