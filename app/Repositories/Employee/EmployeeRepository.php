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

        if($request->has('team_id')){
            $data = $this->model
                ->orderBy($sort,$sortDirection)
                ->where('team_id',$team_id)
                ->where('first_name','LIKE','%'.$name.'%')
                ->where('last_name','LIKE','%'.$name.'%')
                ->where('email','LIKE','%'.$email.'%')
                ->paginate(5);
        }else {
            $data = $this->model->orderBy($sort,$sortDirection)->paginate(5);
        }

        $sortDirection = $sortDirection == 'desc' ? 'asc': 'desc';

        $request->session()->put('sortDirection', $sortDirection);

        return $data;
    }

    public function softDelete($id)
    {
        $data = $this->model->find($id);

        if($data->del_flag == '0') {
            $data->update(['del_flag'=>'1']);
        }else {
            $data->delete($id);
        }
    }


}
