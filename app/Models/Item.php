<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'type', 'price', 'quantity_in_stock', 'sub_category_id'];
    public $timestamps = false;
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}