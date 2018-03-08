<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Todo;

# Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
# Models
use App\Models\Todo\Todo;
# Exceptions
use App\Exceptions\GeneralException;
# Repository
use App\Repositories\BaseRepository;
# Events
use App\Events\Backend\Todo\TodoCreated;
use App\Events\Backend\Todo\TodoUpdated;
use App\Events\Backend\Todo\TodoRestored;
use App\Events\Backend\Todo\TodoPermanentlyDeleted;

/**
 * Class TodoRepository.
 */
class TodoRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Todo::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedTodo($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Todo
     */
    public function create(array $data) : Todo
    {
        return DB::transaction(function () use ($data) {
            $todo = parent::create([
                'user_id'        => auth()->id(),
                'title'          => strtoupper($data['title']),
                'description'    => strtoupper($data['description']),
                'priority_level' => strtoupper($data['priority_level'])
            ]);

            if ($todo) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';

                event(new TodoCreated($auth_link, $todo->title));

                return $todo;
            }

            throw new GeneralException(__('exceptions.backend.inventories.create_error'));
        });
    }

    /**
     * @param Todo  $todo
     * @param array $data
     *
     * @return Todo
     */
    public function update(Todo $todo, array $data) : Todo
    {
        return DB::transaction(function () use ($todo, $data) {
            if ($todo->update([
                'user'           => auth()->id,
                'title'          => strtoupper($data['title']),
                'description'    => strtoupper($data['description']),
                'priority_level' => strtoupper($data['priority_level'])
            ]))

            {
                
                
                event(new TodoUpdated($todo->title));

                return $todo;
            }

            throw new GeneralException(__('exceptions.backend.inventories.update_error'));
        });
    }

    /**
     * @param Todo $todo
     *
     * @return Todo
     * @throws GeneralException
     */
    public function forceDelete(Todo $todo) : Todo
    {
        if (is_null($todo->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.delete_first'));
        }

        return DB::transaction(function () use ($todo) {

            if ($todo->forceDelete()) {
                event(new TodoPermanentlyDeleted($todo->title));

                return $todo;
            }

            throw new GeneralException(__('exceptions.backend.inventories.delete_error'));
        });
    }

    /**
     * @param item $todo
     *
     * @return item
     * @throws GeneralException
     */
    public function restore(Todo $todo) : Todo
    {
        if (is_null($todo->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.cant_restore'));
        }

        if ($todo->restore()) {
            event(new TodoRestored($todo->title));

            return $todo;
        }

        throw new GeneralException(__('exceptions.backend.inventories.restore_error'));
    }
}
