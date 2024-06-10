<?php

namespace App\Models;

use App\Base\Interfaces\HasNewsCategories;
use App\Base\Interfaces\HasNewsImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model implements HasNewsImages, HasNewsCategories
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
        'image',
        'thumbnail',
    ];

    protected $table = 'news';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'char';

    /**
     * newsImages
     *
     * @return HasMany
     */
    public function newsImages(): HasMany
    {
        return $this->hasMany(NewsImage::class);
    }

    /**
     * newsCategories
     *
     * @return HasMany
     */
    public function newsCategories(): HasMany
    {
        return $this->hasMany(NewsCategory::class);
    }
}
