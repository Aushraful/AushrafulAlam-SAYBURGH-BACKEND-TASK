<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'image', 'tags', 'created_by'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
