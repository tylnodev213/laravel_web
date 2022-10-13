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
            ->select(['id', 'team_id', 'first_name', 'last_name', 'email', 'avatar',])
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

    public function create($attributes = [])
    {
        $attributes['avatar'] = storeFile($attributes['avatar']);

        return parent::create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $attributes['avatar'] = storeFile($attributes['avatar']);

        return parent::update($id, $attributes);
    }


}
