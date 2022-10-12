<?php
namespace App\Repositories\Team;

use App\Models\Team;
use App\Repositories\BaseRepository;
use App\Repositories\Employee\EmployeeRepository;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
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
        DB::beginTransaction();
        try {
            $this->update($team_id,[
                'del_flag'=>config('constants.DELETE_ON')
            ]);
            DB::table('m_employees')->where('team_id',$team_id)
                ->update([
                    'team_id' => NULL,
                    'upd_id'=>session()->get('id_admin'),
                    'upd_datetime'=>date('Y-m-d H:i:s'),
                    ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception(config('constants.message_delete_fail'));
        }
    }
}

