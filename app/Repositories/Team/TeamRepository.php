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

    public function getProduct()
    {
        return $this->model->select('product_name')->take(5)->get();
    }
}

