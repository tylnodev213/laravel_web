<?php

namespace App\Http\Controllers;

use App\Enums\Employee\GenderEnum;
use App\Enums\Employee\PositionEnum;
use App\Enums\Employee\StatusEnum;
use App\Enums\Employee\TypeOfWorkEnum;
use App\Exports\EmployeesExport;
use App\Http\Requests\Employee\DeleteRequest;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Jobs\SendEmail;
use App\Models\Employee;
use App\Models\Team;
use App\Repositories\Team\TeamRepository;
use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class EmployeeController extends Controller
{
    protected $repository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, TeamRepository $teamRepository)
    {
        $this->repository = $employeeRepository;
        $teams = $teamRepository->get(['id', 'name']);
        $gender = GenderEnum::getArrayView();
        $position = PositionEnum::getArrayView();
        $status = StatusEnum::getArrayView();
        $typeOfWork = TypeOfWorkEnum::getArrayView();
        View::share('teams', $teams);
        View::share('gender', $gender);
        View::share('position', $position);
        View::share('status', $status);
        View::share('typeOfWork', $typeOfWork);
    }

    public function index(Request $request)
    {
        $employees = $this->repository->show($request);

        return view('Employee.index', [
            'employees' => $employees,
        ]);
    }

    public function createConfirm(StoreRequest $request)
    {
        $data = $request->safe()->except('avatar');
        $avatar = $request->get('old_avatar');

        $data = array_merge($data, [
            'avatar' => $avatar,
        ]);
        $employee = new Employee($data);

        return view('Employee.create_confirm', [
            'employee' => $employee,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->get('submit') == 'Back') {
            return redirect()->route('Employee.create')->withInput($request->input());
        }

        try {
            $data = $request->except('old_avatar');

            $new_employee = $this->repository->create($data);
        } catch (Exception $e) {
            Log::error('Create employee fail.',
                ['id_admin' => session()->get('id_admin'), 'exception' => $e->getMessage()]);
            return redirect()->route('Employee.search')->withErrors(config('constants.message_create_fail'));
        }

        $this->sendEmail($new_employee);

        return redirect()->route('Employee.search')->with('message_successful',
            config('constants.message_create_successful'));
    }

    public function create()
    {
        return view('Employee.create');
    }

    public function sendEmail($new_employee)
    {
        $message = [
            'fullName' => $new_employee->fullName,
        ];
        SendEmail::dispatch($message, $new_employee)->delay(now()->addMinute(1));
    }

    public function edit($id)
    {
        $employee = $this->repository->findbyField('id', $id)->first();

        if (is_null($employee)) {
            return redirect()->route('Employee.search')->withErrors(config('constants.data_not_exist'));
        }

        return view('Employee.edit', [
            'employee' => $employee,
        ]);
    }

    public function editConfirm(UpdateRequest $request, Employee $employee)
    {
        $data = $request->safe()->except('avatar');
        $avatar = $request->get('old_avatar');

        $data = array_merge($data, [
            'avatar' => $avatar,
        ]);

        $employee_upd = new Employee($data);
        $employee_upd->id = $employee->id;

        return view('Employee.edit_confirm', [
            'employee' => $employee_upd,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->get('submit') == 'Back') {
            return redirect()->route('Employee.edit', $id)->withInput($request->input());
        }

        try {
            $data = $request->except('old_avatar');

            $upd_employee = $this->repository->update($id, $data);
        } catch (Exception $e) {
            Log::error('Update employee fail.',
                ['id' => $id, 'id_admin' => session()->get('id_admin'), 'exception' => $e->getMessage()]);

            return redirect()->route('Employee.search')->withErrors(config('constants.message_update_fail'));
        }

        $checkEmailExist = $this->repository->findByField('email', $data['email']);
        if (!$checkEmailExist->count()) {
            $this->sendEmail($upd_employee);
        }

        return redirect()->route('Employee.search')->with('message_successful',
            config('constants.message_update_successful'));
    }

    public function destroy(DeleteRequest $request)
    {
        $id = $request->get('id');

        try {
            $data = $this->repository->softDelete($id);
        } catch (Exception $e) {
            Log::error('Delete employee fail.',
                ['id' => $id, 'id_admin' => session()->get('id_admin'), 'exception' => $e->getMessage()]);

            return redirect()->route('Employee.search')->withErrors(config('constants.message_delete_fail'));
        }

        return redirect()->route('Employee.search')->with('message_successful',
            config('constants.message_delete_successful'));
    }

    public function exportFile(Request $request)
    {
        return Excel::download(new EmployeesExport($request->all()), 'employees.csv');
    }

}
