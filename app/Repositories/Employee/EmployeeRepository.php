<?php

namespace App\Repositories\Employee;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Team::class;
    }
}
