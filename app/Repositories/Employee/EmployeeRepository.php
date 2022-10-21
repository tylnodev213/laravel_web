<?php
namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use Exception;
use http\Env\Request;
use Illuminate\Database\QueryException;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    public function getModel()
    {
        return Employee::class;
    }

    public function show($request)
    {
        //sort
        $sortDirection = $request->get('sortDirection','asc');
        $sort = $request->get('sort','id');

        //search
        $team_id = $request->get('team_id');
        $name = $request->get('name');
        $email = $request->get('email');


        $data = $this->model
            ->select(['m_employees.id as id', 'm_teams.name as teamName', 'm_employees.first_name as first_name', 'm_employees.last_name as last_name', 'm_employees.email as email', 'm_employees.avatar as avatar',])
            ->leftJoin('m_teams', 'm_teams.id', '=', 'm_employees.team_id')
            ->when (!empty($team_id) , function ($query) use($team_id){
                return $query->where('team_id', $team_id);
            })
            ->when (!empty($name) , function ($query) use($name){
                return $query->where('first_name', 'LIKE', '%'.$name.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$name.'%');
            })
            ->when (!empty($email) , function ($query) use($email){
                return $query->where('email', 'LIKE', '%'.$email.'%');
            })
            ->orderBy($sort, $sortDirection)
            ->paginate(config('constants.pagination_records'));

        return $data;
    }

    public function softDelete($id)
    {
        return $this->update($id, ['del_flag'=>config('constants.DELETE_ON')]);
    }


}
