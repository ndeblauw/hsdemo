<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // Model events -----------------------------------------------------------
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = $post->slug ?? $post->createUniqueSlug();
        });

        static::updated(function ($post) {
            Cache::forget('welcome.recent_news');
            Cache::forget('featured_news');
        });
    }

    // Model Relationships -----------------------------------------------------
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(User::class,'sponsor_id');
    }

    // Model attributes --------------------------------------------------------
    public function getThumbnailUrlAttribute(): string
    {
        return $this->getImageUrl('thumbnail');
    }

    public function getIsOldAttribute(): bool
    {
        if ($this->published_at === null) {
            return false;
        }

        return $this->published_at->lt(now()->subMonths(2));
    }

    public function getTimeSincePublishedAttribute(): string
    {
        if ($this->is_old) {
            return 'very old post';
        }

        return $this->published_at->diffForHumans();
    }

    // Model scopes -----------------------------------------------------------------
    public function scopeIsPublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    // Model method ------------------------------------------------------------------
    public function isSponsored()
    {
        return $this->sponsor_id !== null;
    }

    public function getImageUrl(string $conversion): string
    {
        return ($this->media->isNotEmpty())
            ? $this->media->first()->getUrl($conversion)
            : '/media/default/conversions/default-'.$conversion.'.jpg';
    }

    public function createUniqueSlug(): string
    {
        $nr = 0;
        do {
            $slug = ($nr === 0)
                ? Str::slug($this->title)
                : Str::slug($this->title).'-'.$nr;
            $nr++;
        } while (Post::where('slug', $slug)->where('id', '<>', $this->id)->count() > 0);

        return $slug;
    }

    // Medialibrary settings ----------------------------------------------------------
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 200)
            ->nonQueued();
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 50, 50)
            ->nonQueued();

    }
}
