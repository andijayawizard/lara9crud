<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'rgks', 'ktrg', 'acak'
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}