<?php
namespace App\Repositories\Team;

use App\Models\Team;
use App\Repositories\BaseRepository;
use App\Repositories\Employee\EmployeeRepository;
use Illuminate\Support\Facades\DB;

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
        $sortDirection = $request->session()->get('sortDirection', 'asc');
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


        $sortDirection = $sortDirection == 'desc' ? 'asc': 'desc';
        session()->put('sortDirection', $sortDirection);

        return $data;
    }

    public function softDelete($team_id)
    {
        DB::transaction(function () use ($team_id) {
            $data = $this->model->find($team_id);
            if($data->del_flag == config('constants.DELETE_OFF')) {
                $data->update(['del_flag'=>config('constants.DELETE_ON')]);
                DB::table('m_employees')->where('team_id',$team_id)->update(['team_id' => NULL]);
            }else {
                $data->delete($team_id);
                DB::table('m_employees')->where('team_id',$team_id)->update(['team_id' => NULL]);
            }
        });
    }
}

