<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model;

class BlogPost extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'blogs';

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        '_id', 'title', 'slug', 'author', 'content', 'coverImage',
        'coverImageAlt', 'published', 'language', 'seo',
    ];

    protected $casts = [
        'published' => 'boolean',
        'content' => 'array',
        'seo' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeForLocale($query, string $locale)
    {
        if ($locale === 'es') {
            return $query->where(function ($q) {
                $q->where('language', 'es')->orWhere('language', 'en');
            });
        }

        return $query->where('language', 'en');
    }
}
