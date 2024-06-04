<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function galery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function faq()
    {
        return $this->hasMany(Faq::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function CategoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

}
