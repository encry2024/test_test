<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Inventory\UnitType;

# Facades
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
# Models
use App\Models\UnitType\UnitType;
# Exceptions
use App\Exceptions\GeneralException;
# Repository
use App\Repositories\BaseRepository;
# Events
use App\Events\Backend\Inventory\UnitType\UnitTypeCreated;
use App\Events\Backend\Inventory\UnitType\UnitTypeUpdated;
use App\Events\Backend\Inventory\UnitType\UnitTypeRestored;
use App\Events\Backend\Inventory\UnitType\UnitTypePermanentlyDeleted;

/**
 * Class UnitTypeRepository.
 */
class UnitTypeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return UnitType::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedUnitType($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
     * @return UnitType
     */
    public function create(array $data) : UnitType
    {
        return DB::transaction(function () use ($data) {
            $unit_type = parent::create([
                'name'         =>  $data['name'],
                'description'  =>  $data['description'],
            ]);

            if ($unit_type) {
                event(new UnitTypeCreated(Auth::user()->full_name, $unit_type->name));

                return $unit_type;
            }

            throw new GeneralException(__('exceptions.backend.inventories.create_error'));
        });
    }

    /**
     * @param UnitType  $unit_type
     * @param array $data
     *
     * @return UnitType
     */
    public function update(UnitType $unit_type, array $data) : UnitType
    {
        return DB::transaction(function () use ($unit_type, $data) {
            if ($unit_type->update([
                'name'         =>  $data['name'],
                'description'  =>  $data['description'],
            ]))

            {
                event(new UnitTypeUpdated(Auth::user()->full_name, $unit_type->name));

                return $unit_type;
            }

            throw new GeneralException(__('exceptions.backend.inventories.update_error'));
        });
    }

    /**
     * @param UnitType $unit_type
     *
     * @return UnitType
     * @throws GeneralException
     */
    public function forceDelete(UnitType $unit_type) : UnitType
    {
        if (is_null($unit_type->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.delete_first'));
        }

        return DB::transaction(function () use ($unit_type) {

            if ($unit_type->forceDelete()) {
                event(new UnitTypePermanentlyDeleted(Auth::user()->full_name, $unit_type->name));

                return $unit_type;
            }

            throw new GeneralException(__('exceptions.backend.inventories.delete_error'));
        });
    }

    /**
     * @param item $unit_type
     *
     * @return item
     * @throws GeneralException
     */
    public function restore(UnitType $unit_type) : UnitType
    {
        if (is_null($unit_type->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.cant_restore'));
        }

        if ($unit_type->restore()) {
            event(new UnitTypeRestored(Auth::user()->full_name, $unit_type->name));

            return $unit_type;
        }

        throw new GeneralException(__('exceptions.backend.inventories.restore_error'));
    }
}
