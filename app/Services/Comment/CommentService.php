<?php

namespace App\Services\Comment;

use App\Models\Comments\Comment;
use App\Models\Entities\Event;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Comment\CommentInterface;

class CommentService
{
    protected $commentRepo;

    public function __construct(CommentInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * retrieves the item by id
     *
     * @param  int $itemId
     * @return Comment
     */
    public function get($itemId)
    {
        return $this->commentRepo->getById($itemId);
    }

    /**
     * creates an item with the given data
     *
     * @param array $data
     * @return Model
     */
    public function save(array $data)
    {
        return $this->commentRepo->saveItem($data);
    }

    /**
     * Update the item
     *
     * @param Comment $item
     * @param array $data
     * @return Model
     */
    public function edit(Comment $item, array $data)
    {
        return $this->commentRepo->editItem($item, $data);
    }

    /**
     * Remove the comment
     *
     * @param Comment $item
     * @return mixed
     */
    public function delete(Comment $item)
    {
        return $this->commentRepo->deleteItem($item);
    }

    /**
     * Get all active items
     *
     * @return mixed
     */
    public function getActiveItemsLatestFirst() {
        return $this->commentRepo->getActiveItemsLatestFirst();
    }

    /**
     * Change the active status
     *
     * @param Comment $item
     * @return bool
     */
    public function updateActiveStatus(Comment $item)
    {
        return $this->commentRepo->updateActiveStatus($item);
    }

    public function getCommentsByEvent(Event $event)
    {
        return $this->commentRepo->getCommentsByEvent($event);
    }
}
