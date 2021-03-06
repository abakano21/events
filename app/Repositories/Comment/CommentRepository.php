<?php

namespace App\Repositories\Comment;

use App\Models\Comments\Comment;
use App\Models\Entities\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CommentRepository implements CommentInterface
{
    protected $model;

    public function __construct(Comment $item)
    {
        $this->model = $item;
    }

    /**
     * retrieves the Comment by id
     *
     * @param  int $itemId
     * @return int
     */
    public function getById(int $itemId)
    {
        return $this->model->find($itemId);
    }

    /**
     * creates a new item with the given data
     *
     * @param array $itemData
     * @return Model
     */
    public function saveItem(array $itemData)
    {
        return $this->model->create($itemData);
    }

    /**
     * Edit item
     *
     * @param Comment $item
     * @param array $itemData
     * @return bool
     */
    public function editItem(Comment $item, array $itemData)
    {
        return $item->update($itemData);
    }

    /**
     * @param Comment $item
     * @return bool|null
     * @throws \Exception
     */
    public function deleteItem(Comment $item)
    {
        return $item->delete();
    }

    /**
     * Get all active items
     *
     * @return mixed
     */
    public function getActiveItemsLatestFirst() {
        return $this->model
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->get()
        ;
    }

    /**
     * Change the active status
     *
     * @param Comment $item
     * @return bool
     */
    public function updateActiveStatus(Comment $item)
    {
        return $item->update(['is_active' => !$item->is_active]);
    }

    public function getCommentsByEvent(Event $event)
    {
        $result = $this->model
            ->whereHas('events', function (Builder $query) use($event) {
                $query->where('event_id', $event->id);
            })
            ->get()
        ;
        dd($result);
    }

}
