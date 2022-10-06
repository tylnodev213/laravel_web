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

    public function deleteById($id)
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

