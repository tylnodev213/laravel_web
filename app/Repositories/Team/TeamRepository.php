<?php
namespace App\Repositories\Team;

use App\Models\Team;
use App\Repositories\BaseRepository;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Team::class;
    }

    public function deleteById($id)
    {
        $data = $this->model->find($id);
        if($data->del_flag == '0') {
            $data->update(['del_flag'=>'1']);
        }else {
            $data->delete($id);
        }
    }
}

