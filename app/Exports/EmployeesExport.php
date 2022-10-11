<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    public function headings(): array
    {
        return ["ID", "Team", "Fullname", "Email"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::get(['id','team_id','first_name', 'last_name', 'email']);
    }
}
