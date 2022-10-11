<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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

        $avatar = $this->storeFile($request);

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

        $teams = $this->repository->create($request);

        $request->session()->put('message_successful','Create '.config('constants.message_successful'));

        return redirect()->route('Employee.search');
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

        $teams = $this->repository->update($id, $request);

        $request->session()->put('message_successful','Update '.config('constants.message_successful'));

        return redirect()->route('Employee.search');
    }

    public function destroy(Request $request, $id)
    {
        $this->repository->softDelete($id);

        $request->session()->put('message_successful','Delete '.config('constants.message_successful'));

        return redirect()->route('Employee.search');
    }

    function storeFile(Request $request)
    {
        $path = Storage::putFile(
            'avatars', $request->file('avatar')
        );

        return Str::of($path)->after(url('storage').'/app/');
    }

    function removeFile($file_name)
    {
        Storage::delete($file_name);
    }

    function exportFile() {
        return Excel::download(new EmployeesExport, 'employees.csv');
    }
}
