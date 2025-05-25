<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'content',
        'image_url',
        'scheduled_time',
        'status',
        'user_id',
    ];

    protected $casts = [
        'scheduled_time' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'post_platform')
            ->withPivot('platform_status')
            ->withTimestamps();
    }

    public function scopeFromDate($query, $date)
    {
        return $query->whereDate('scheduled_time', '>=', $date);
    }

    public function scopeToDate($query, $date)
    {
        return $query->whereDate('scheduled_time', '<=', $date);
    }
}
