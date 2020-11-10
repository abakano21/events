<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal;
use App\Models\Comments\Comment;
use App\Exceptions\TransformerException;

class CommentsTransformer extends Fractal\TransformerAbstract
{
    public static function transformSingleCommentFull(Comment $comment)
    {
        try {
            return [
                'id'                    => (int)    $comment->id,
                'title'                 => (string) $comment->title,
                'content'               => (string) $comment->content,
                'is_active'             => (int) $comment->is_active,
            ];
        }
        catch (\Exception $exception) {
            throw new TransformerException('SINGLE_COMMENT');
        }
    }
    
    public static function transform($items)
    {
        try {
            return $items->map(function($item) {
                return self::transformSingleCommentFull($item);
            });
        }
        catch (\Exception $exception) {
            throw new TransformerException('COMMENTS');
        }
    }

    public static function statusUpdated($item)
    {
        try {
            return [
                'is_active' => (int) $item->is_active,
            ];
        }
        catch (\Exception $exception) {
            throw new TransformerException('COMMENTS');
        }
    }

}
