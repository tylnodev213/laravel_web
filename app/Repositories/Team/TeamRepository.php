<?php
namespace App\Repositories\Team;

use App\Models\Team;
use App\Repositories\BaseRepository;
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

        $data = $this->model->orderBy($sort,$sortDirection)->where('name','LIKE','%'.$name.'%')->paginate(config('constants.pagination_records'));

        $sortDirection = $sortDirection == 'desc' ? 'asc': 'desc';

        $request->session()->put('sortDirection', $sortDirection);

        return $data;
    }

    public function create($attributes = [])
    {
        $attributes = $attributes->except([
            '_token',
            'save',
        ]);;

        $attributes = array_merge($attributes, [
            'ins_id'=> session()->get('id_admin'),
            'ins_datetime' => date('Y-m-d H:i:s'),
        ]);

        return parent::create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $attributes = $attributes->except([
            '_token',
            '_method',
            'save',
        ]);

        $attributes = array_merge($attributes, [
            'upd_id'=> session()->get('id_admin'),
            'upd_datetime' => date('Y-m-d H:i:s'),
        ]);

        return parent::update($id, $attributes);
    }

    public function softDelete($id)
    {
        DB::transaction(function () use ($id) {
            $data = $this->model->find($id);
            if($data->del_flag == '0') {
                $data->update(['del_flag'=>'1']);
                DB::table('m_employees')->where('team_id',$id)->update(['team_id' => NULL]);
            }else {
                $data->delete($id);
                DB::table('m_employees')->where('team_id',$id)->update(['team_id' => NULL]);
            }
        });
    }
}

