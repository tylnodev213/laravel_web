<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $data = $request->except([
            '_token',
            'submit',
        ]);;

        $data = array_merge($data, [
            'ins_id'=> session()->get('id_admin'),
            'ins_datetime' => date('Y-m-d H:i:s'),
        ]);

        //... Validation here

        $teams = $this->repository->create($data);

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
        $data = $request->except([
            '_token',
            '_method',
            'submit',
        ]);

        //... Validation here

        $teams = $this->repository->update($id, $data);

        return redirect()->route('Employee.search');
    }

    public function destroy($id)
    {
        $this->repository->softDelete($id);

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
}
