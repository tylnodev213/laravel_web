<?php
namespace App\Repositories\Team;

use App\Models\Team;
use App\Repositories\BaseRepository;
use App\Repositories\Employee\EmployeeRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    protected $employeeRepository;

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
            ->paginate(config('constants.pagination_records'));

        return $data;
    }


    public function softDelete($team_id)
    {
        $this->employeeRepository = \App::make(EmployeeRepository::class);
        DB::beginTransaction();
        try {
            $this->update($team_id,[
                'del_flag'=>config('constants.DELETE_ON')
            ]);
            $this->employeeRepository->findByField('team_id',$team_id)
                ->update([
                    'del_flag'=>config('constants.DELETE_ON')
                ]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error('Delete team fail.', ['id'=>$team_id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            DB::rollback();
        }
    }
}

