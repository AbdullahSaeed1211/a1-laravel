<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model;

class PageSEO extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'pageseos';

    protected $fillable = [
        'slug', 'title', 'description', 'title_es', 'description_es',
        'keywords', 'keywords_es', 'titleTemplate', 'canonicalUrl',
        'siteName', 'ogTitle', 'ogDescription', 'ogTitle_es', 'ogDescription_es',
        'ogType', 'twitterCard', 'twitterTitle', 'twitterDescription',
        'twitterTitle_es', 'twitterDescription_es',
    ];
}
