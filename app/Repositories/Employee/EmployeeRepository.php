<?php
namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use http\Env\Request;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    public function getModel()
    {
        return Employee::class;
    }

    public function getAll()
    {
        return  $this->model->join('m_teams', 'm_teams.id', '=', 'm_employees.team_id')
            ->orderBy('id', 'asc')
            ->get(['m_employees.*', 'm_teams.name as team_name']);
    }


}
