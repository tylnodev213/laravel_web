<?php
namespace App\Repositories\Employee;

use App\Repositories\RepositoryInterface;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function show($request);
    public function softDelete($id);
}
