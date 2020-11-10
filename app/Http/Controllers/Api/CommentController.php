<?php

namespace App\Http\Controllers\Api;

use App\Models\Comments\Comment;
use App\Models\Entities\Event;
use App\Services\Comment\CommentFacade;
use App\Transformers\CommentsTransformer;

class CommentController extends BaseController
{
    /**
     * Get all active comments
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     */
    public function getAll() {
        $items = CommentFacade::getActiveItemsLatestFirst();
        
        if($items->count())
            return $this->success(CommentsTransformer::transform($items));

        return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');
    }

    /**
     * Get Single comment
     *
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\TransformerException
     * 
     */
    public function getComment(Comment $comment) {
        
        if(!$comment->is_active)
            return $this->error('COMMENT_ERRORS', 'COMMENT_NOT_FOUND');

        return $this->success(CommentsTransformer::transformSingleCommentFull($comment));
    }

    public function store()
    {
        $item = CommentFacade::save(request()->all());
        if(!$item) 
            return $this->error('COMMENT_ERRORS', 'CANNOT_BE_STORED');

        return $this->success(CommentsTransformer::transformSingleCommentFull($item));
    }

    public function updateStatus(Comment $comment)
    {
        $item = CommentFacade::updateActiveStatus($comment);
        if(!$item) 
            return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');

        return $this->success(CommentsTransformer::statusUpdated($comment));
    }

    public function destroy(Comment $comment)
    {
        $item = CommentFacade::delete($comment);
        if(!$item) 
            return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');

        return $this->success(['data'=> ['deleted'=>1]]);
    }

    public function commentsByEvent(Event $event) {
        
        $items = CommentFacade::getCommentsByEvent($event);
        
        if($items->count())
            return $this->success(CommentsTransformer::transform($items));

        return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');
    }
}
