<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['gallery'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_product',
                'onUpdate' => true,
            ]
        ];
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getGalleryAttribute(){
        return $this->getMedia('gallery');
    }

}


