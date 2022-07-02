<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Car extends Model
{
    use HasFactory, Sortable;
    protected $table = 'cars';
    protected $fillable = ['name', 'plat', 'status', 'price'];
    // protected $guarded = [];
    public $sortable = ['id', 'name', 'plat', 'status', 'price'];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}