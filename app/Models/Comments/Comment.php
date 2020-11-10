<?php

namespace App\Models\Comments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'is_active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function events()
    {
        return $this->belongsToMany('App\Models\Entities\Event')->using('App\Models\CommentEvent');
        
    }
}
