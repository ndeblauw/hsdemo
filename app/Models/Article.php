<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\Conversions\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['title', 'content', 'user_id'];

    // Model relations -------------------------------------------
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Business logic for model -----------------------------------
    public function isAllowedToEdit(User $user): bool
    {
        if($user->superadmin) {
            return true;
        }

        return $user->id == $this->user_id;
    }

    // Custom methods ----------------------------------------------
    public function getCardImageUrl()
    {
        if($this->media->first() === null) {
            return '/img/default-article-image.jpg';
        }

        return $this->media->first()?->getUrl('card');
    }

    public function getFeaturedImageUrl()
    {
        if($this->media->first() === null) {
            return '/img/default-article-image.jpg';
        }

        return $this->media->first()?->getUrl('features');
    }

    // Media library logic -----------------------------------------
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 50, 50)
            ->nonQueued();
        $this
            ->addMediaConversion('card')
            ->fit(FIT::Crop, 400, 100)
            ->nonQueued();
        $this
            ->addMediaConversion('features')
            ->fit(FIT::Crop, 400, 300)
            ->nonQueued();

    }


}
