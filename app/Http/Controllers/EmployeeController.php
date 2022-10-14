<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Jobs\SendEmail;
use App\Models\Employee;
use App\Models\Team;
use App\Repositories\Team\TeamRepository;
use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class EmployeeController extends Controller
{
    protected $repository;
    protected $teams;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, TeamRepository $teamRepository)
    {
        $this->repository = $employeeRepository;
        $this->teams = $teamRepository->get(['id', 'name']);
    }

    public function index(Request $request)
    {
        $this->removeAvatarWhenReset();

        $employees = $this->repository->show($request);

        return view('Employee.index', [
            'employees' => $employees,
            'teams'=>$this->teams,
        ]);
    }

    public function create()
    {
        $this->removeAvatarWhenReset();
        return view('Employee.create', [
            'teams'=>$this->teams,
        ]);
    }

    public function createConfirm(Request $request)
    {
        $data = $request->except('avatar','old_avatar');

        $avatar = storeFile($request);

        if(empty($avatar)) {
            $avatar = $request->get('old_avatar');
        }

        removeFile($request->get('old_avatar'));

        $data = array_merge($data,[
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
            session()->put('old_avatar',$request->get('avatar'));
            return redirect()->route('Employee.create')->withInput($request->input());
        }

        try{
            $data = $request->all();

            $new_employee = $this->repository->create($data);
        }catch (Exception $e) {
            Log::error('Create employee fail.', ['id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);
            return redirect()->route('Employee.search')->withError(config('constants.message_create_fail'));
        }

        $this->sendEmail($new_employee);

        return redirect()->route('Employee.search')->with('message_successful', config('constants.message_create_successful'));
    }

    public function edit(Employee $employee)
    {
        if(session('removeFile')) {
            $this->removeAvatarWhenReset();
        }
        session(['removeFile' => true,]);
        return view('Employee.edit', [
            'employee' => $employee,
            'teams' => $this->teams,
        ]);
    }

    public function editConfirm(Request $request, Employee $employee)
    {
        $data = $request->except('avatar','old_avatar');

        $avatar = storeFile($request);

        if(empty($avatar)) {
            $avatar = $request->get('old_avatar');
        }
        session([
            'old_avatar' => $avatar,
            'removeFile' => false,
        ]);

        $data = array_merge($data,[
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
            $data = $request->all();

            $upd_employee = $this->repository->update($id, $data);
        }catch (Exception $e) {
            Log::error('Update employee fail.', ['id'=>$id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);

            return redirect()->route('Employee.search')->withError(config('constants.message_update_fail'));
        }

        $this->sendEmail($upd_employee);

        return redirect()->route('Employee.search')->with('message_successful',config('constants.message_update_successful'));
    }

    public function destroy(Request $request, $id)
    {
        try{
            $data=$this->repository->softDelete($id);
        }catch (Exception $e) {
            Log::error('Delete employee fail.', ['id'=>$id, 'id_admin' => session()->get('id_admin'), 'exception'=>$e->getMessage()]);

            return redirect()->route('Employee.search')->withError(config('constants.message_delete_fail'));
        }

        return redirect()->route('Employee.search')->with('message_successful',config('constants.message_delete_successful'));
    }

    public function exportFile(Request $request) {
        return Excel::download(new EmployeesExport($request->all()), 'employees.csv');
    }

    public function sendEmail($new_employee) {
        $message = [
            'fullName' => $new_employee->fullName,
        ];
        SendEmail::dispatch($message, $new_employee)->delay(now()->addMinute(1));
    }

    public function removeAvatarWhenReset(){
        removeFile(session()->get('old_avatar'));
        session()->pull('old_avatar');
    }
}
