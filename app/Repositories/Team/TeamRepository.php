<?php
namespace App\Repositories\Team;

use App;
use App\Models\Team;
use App\Repositories\BaseRepository;
use App\Repositories\Employee\EmployeeRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->setModel();
    }

    //lấy model tương ứng
    public function getModel()
    {
        return Team::class;
    }

    public function show($request)
    {
        //sort
        $sortDirection = $request->get('sortDirection','asc');
        $sort = $request->get('sort','id');
        //search
        $name = $request->get('name','');

        $data = $this->model
            ->select(['id','name'])
            ->when (!empty($name) , function ($query) use($name){
                return $query->where('name','LIKE','%'.$name.'%');
            })
            ->orderBy($sort,$sortDirection)
            ->paginate(config('constants.pagination_records'), ['id'], 'teams');

        return $data;
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function softDelete($team_id)
    {
        DB::beginTransaction();
        try {
            $this->update($team_id, [
                'del_flag' => config('constants.DELETE_ON'),
            ]);
            $employees = $this->employeeRepository->findByField('team_id', $team_id);
            if ($employees->count()) {
                $employees->toQuery()->update([
                    'team_id' => null,
                ]);
            }
        } catch (Exception $e) {
            Log::error('Delete team fail.', ['id' => $team_id, 'id_admin' => session()->get('id_admin'), 'exception' => $e->getMessage()]);
            DB::rollback();
            throw $e;
        }
        DB::commit();
    }
}

