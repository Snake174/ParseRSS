<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'link', 'description', 'published', 'author'
    ];

    protected $casts = [
        'published' => 'datetime:d.m.Y H:i:s',
    ];

    public function photos()
    {
        return $this->hasMany(Photos::class)->get();
    }
}
