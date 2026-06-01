<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
