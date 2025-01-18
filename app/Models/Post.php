<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'descripton', 'image', 'author',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'email');
    }
}
