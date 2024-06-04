<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComingSoonProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function CategoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
