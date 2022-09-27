<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia, Buyable
{
    use HasFactory, Sluggable, InteractsWithMedia, CanBeBought;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGalleryAttribute()
    {
        return $this->getMedia('gallery');
    }

    public function getMediaPhoto()
    {
        return $this->media('photo');
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
}
