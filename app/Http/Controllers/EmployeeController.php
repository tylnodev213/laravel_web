<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Models\Employee;
use App\Models\Team;
use App\Repositories\Team\TeamRepository;
use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class EmployeeController extends Controller
{
    protected $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->teams = Team::query()->pluck('name','id');
    }

    public function index(Request $request)
    {
        $employees = $this->repository->show($request);

        return view('Employee.index', [
            'employees' => $employees,
            'teams'=>$this->teams,
        ]);
    }

    public function create()
    {
        return view('Employee.create', [
            'teams'=>$this->teams,
        ]);
    }

    public function create_confirm(Request $request)
    {
        $data = $request->except('avatar');

        $avatar = storeFile($request);

        $data = array_merge($data, [
            'avatar' => $avatar,
        ]);

        $employee = new Employee($data);

        return view('Employee.create_confirm', [
            'employee'=>$employee,
            'teams'=>$this->teams,
        ]);
    }

    public function store(Request $request)
    {
        if($request->get('submit')== 'Back') {
            return redirect()->route('Employee.create')->withInput($request->input());
        }

        try{
            $employees = $this->repository->create($request);
        }catch (Exception $e) {
            Log::info('Create employee fail.', ['id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Employee.search')->withError(config('constants.message_create_fail'));
        }

        return redirect()->route('Employee.search')->with('message_successful', config('constants.message_create_successful'));
    }

    public function edit(Employee $employee)
    {
        return view('Employee.edit', [
            'employee' => $employee,
            'teams' => $this->teams,
        ]);
    }

    public function edit_confirm(Request $request, Employee $employee)
    {
        $data = $request->except('avatar');

        $avatar = $this->storeFile($request);

        $data = array_merge($data, [
            'avatar' => $avatar,
        ]);
        $employee_upd = new Employee($data);
        $employee_upd->id = $employee->id;

        return view('Employee.edit_confirm', [
            'employee' => $employee_upd,
            'teams' => $this->teams,
        ]);
    }

    public function update(Request $request, $id)
    {
        if($request->get('submit')== 'Back') {
            return redirect()->route('Employee.edit',$id)->withInput($request->input());
        }

        try{
            $teams = $this->repository->update($id, $request);
        }catch (Exception $e) {
            Log::info('Update employee fail.', ['id'=>$id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Employee.search')->withError(config('constants.message_update_fail'));
        }

        return redirect()->route('Employee.search')->with('message_successful',config('constants.message_update_successful'));
    }

    public function destroy(Request $request, $id)
    {
        try{
            $data=$this->repository->softDelete($id);
        }catch (Exception $e) {
            Log::info('Delete employee fail.', ['id'=>$id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Employee.search')->withError(config('constants.message_delete_fail'));
        }

        return redirect()->route('Employee.search')->with('message_successful',config('constants.message_delete_successful'));
    }

    function exportFile() {
        return Excel::download(new EmployeesExport(), 'employees.csv');
    }
}
