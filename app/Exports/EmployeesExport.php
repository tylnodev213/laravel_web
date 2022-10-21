<?php

namespace App\Exports;

use App\Models\Employee;
use App\Repositories\Employee\EmployeeRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromView
{

    use Exportable;

    protected $team_id;
    protected $name;
    protected $email;
    protected $sort;
    protected $sortDirection;
    protected $employeeRepository;

    public function __construct($condition = [])
    {
        $this->team_id = $condition['team_id'] ?? '';
        $this->name = $condition['name'] ?? '';
        $this->email = $condition['email'] ?? '';
        $this->sort = $condition['sort'] ?? 'id';
        $this->sortDirection = $condition['sortDirection'] ?? 'asc';
    }

    public function view(): View
    {
        return view('exports.employees', [
            'employees' => $this->collection()
        ]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $team_id = $this->team_id;
        $name = $this->name;
        $email = $this->email;
        $sortDirection = $this->sortDirection;
        $sort = $this->sort;
        $this->employeeRepository = \App::make(EmployeeRepository::class);
        return $this->employeeRepository->model
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
            ->get();
    }
}
