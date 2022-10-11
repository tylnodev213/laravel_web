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

    public function show($request)
    {
        //sort
        $sortDirection = $request->session()->get('sortDirection', 'asc');
        $sort = $request->get('sort','id');

        //search
        $team_id = $request->get('team_id');
        $name = $request->get('name');
        $email = $request->get('email');


        $data = $this->model
            ->select(['id', 'team_id', 'first_name', 'last_name', 'email', 'avatar',])
            ->when (!empty($team_id) , function ($query) use($team_id){
                return $query->where('team_id', $team_id);
            })
            ->when (!empty($name) , function ($query) use($name){
                return $query->where('first_name', 'LIKE', '%'.$name.'%')
                    ->where('last_name', 'LIKE', '%'.$name.'%');
            })
            ->when (!empty($email) , function ($query) use($email){
                return $query->where('email', 'LIKE', '%'.$email.'%');
            })
            ->orderBy($sort, $sortDirection)
            ->paginate(config('constants.pagination_records'));

        $sortDirection = $sortDirection == 'desc' ? 'asc': 'desc';

        $request->session()->put('sortDirection', $sortDirection);

        return $data;
    }

    public function softDelete($id)
    {
        $data = $this->model->find($id);

        if($data->del_flag == config('constants.DELETE_OFF')) {
            $data->update(['del_flag'=>config('constants.DELETE_ON')]);
        }else {
            $data->delete($id);
        }
    }


}
