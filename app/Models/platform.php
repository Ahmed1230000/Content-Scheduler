<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class platform extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_platform')
            ->withPivot('platform_status')
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'platform_user')
            ->withPivot('active')
            ->withTimestamps();
    }
}
