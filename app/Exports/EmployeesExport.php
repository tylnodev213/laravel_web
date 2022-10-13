<?php

namespace App\Exports;

use App\Models\Employee;
use App\Repositories\Employee\EmployeeRepository;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromView
{

    use Exportable;

    protected $team_id;
    protected $name;
    protected $email;
    protected $employeeRepository;

    public function __construct($condition = [])
    {
        $this->team_id = $condition['team_id'] ?? '';
        $this->name = $condition['name'] ?? '';
        $this->email = $condition['email'] ?? '';
    }

    public function view(): View
    {
        $team_id = $this->team_id;
        $name = $this->name;
        $email = $this->email;
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
        $this->employeeRepository = \App::make(EmployeeRepository::class);
        return $this->employeeRepository->model
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
            ->get();
    }
}
